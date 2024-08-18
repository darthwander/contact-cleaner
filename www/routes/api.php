<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MailingApiController;
use App\Http\Controllers\Api\CompanyApiController;

Route::middleware('api-auth')->group(function () {
    Route::post('mailing/create', [MailingApiController::class, 'createMailing']);
    Route::get('/companies/list', [CompanyApiController::class, 'index']);
});
