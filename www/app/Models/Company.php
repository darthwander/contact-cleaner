<?php

namespace App\Models;

use App\Http\Requests\Api\CompanyApiIndexRequest;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Observers\CompanyObserver;
use Laravel\Sanctum\ObservedBy;
use Illuminate\Http\Request;

class Company extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    // Define the table name if it is different from the plural form of the class name
    protected $table = 'companies';

    // Define which attributes are mass assignable
    protected $fillable = [
        'name',
        'cnpj',
        'email_verified_at',
        'webhook_url',
        'api_token',
        'active',
        'delete_only_404',
        'only_200',
        'only_200_wp',
        'code_487',
        'code_487_wp'
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        self::observe(CompanyObserver::class);
    }

    public function findBy(string $column, $token): Company|null
    {

        return $this->where($column, $token)->first();
    }

    public function list(CompanyApiIndexRequest|Request $request): object
    {
        $companiesQuery = Company::select('id', 'name', 'active', 'cnpj');

        if ($request->has('search')) {
            $companiesQuery->where('name', 'like', "%{$request->input('search')}%");
        }

        $companies = $companiesQuery->paginate(10); // 10 resultados por página

        $companies->getCollection()->transform(function ($company) {
            $company->cnpj = substr($company->cnpj, 0, 2) . '.' .
                substr($company->cnpj, 2, 3) . '.' .
                substr($company->cnpj, 5, 3) . '/' .
                substr($company->cnpj, 8, 4) . '-' .
                substr($company->cnpj, 12, 2);
            return $company;
        });

        return $companies;
    }

    public function hasUsers(): bool
    {
        return User::where('company_id', $this->id)->exists();
    }
}
