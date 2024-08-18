<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyObserver
{
    /**
     * Handle the Company "updated" event.
     */
    public function updated(Company $company): void
    {
        Log::info("A Empresa: {$company->name} foi atualizada.");
    }
}
