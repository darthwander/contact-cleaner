<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyConfigs extends Model
{
    use HasFactory;

    // Define the table name if it is different from the plural form of the class name
    protected $table = 'company_configs';

    // Define which attributes are mass assignable
    protected $fillable = [
        'company_id',
        'delete_only_404',
        'only_200',
        'only_200_wp',
        '487_code',
        '487_code_wp',
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'delete_only_404' => 'boolean',
        'only_200'        => 'boolean',
        'only_200_wp'     => 'boolean',
        '487_code'        => 'boolean',
        '487_code_wp'     => 'boolean',
    ];

    // Define the relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
