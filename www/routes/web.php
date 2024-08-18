<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailingController;
use App\Http\Controllers\Auth\ResellerAuthController;
use App\Http\Controllers\ResellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SseController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\UserController;

/*=====================================================================================================================
||
||    LOGIN ROUTES
||
=======================================================================================================================
*/
// Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.auth.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.auth.submit');

// Reseller
Route::get('/reseller/login', [ResellerAuthController::class, 'showLogin'])->name('reseller.auth.login');
Route::post('/reseller/login', [ResellerAuthController::class, 'login'])->name('reseller.auth.submit');

// User
Route::get('/user/login', [UserAuthController::class, 'showLogin'])->name('user.auth.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.auth.submit');

/*=====================================================================================================================
||
||    AUTHENTICATED ROUTES
||
=======================================================================================================================
*/
Route::middleware('admin-auth')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //Route::get('admin/mailings', [MailingController::class, 'adminMailingList'])->name('admin.mailing.list');

    Route::get('admin/companies', [CompanyController::class, 'adminCompanyList'])->name('admin.company.list');
    Route::get('admin/companies/{id}', [CompanyController::class, 'show'])->name('admin.company.open');
    Route::post('admin/companies/{id}', [CompanyController::class, 'update'])->name('admin.company.edit');
    Route::post('admin/companies', [CompanyController::class, 'store'])->name('admin.company.store');
    Route::delete('admin/companies/{id}', [CompanyController::class, 'destroy'])->name('admin.company.destroy');

    Route::get('admin/companies/users/{id}', [CompanyController::class, 'userList'])->name('admin.company.users');
    Route::get('admin/user/{id}', [UserController::class, 'show'])->name('admin.user.open');
    Route::post('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.edit');
    Route::post('admin/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::delete('admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('admin/configurations', [AdminController::class, 'index'])->name('admin.configurations');

    Route::get('admin/reports/usage', [MailingController::class, 'usage'])->name('admin.report.usage');
    Route::get('admin/reports/unused', [MailingController::class, 'unused'])->name('admin.report.unused');
    Route::get('admin/reports/processing-queue', [MailingController::class, 'processingQueue'])->name('admin.report.queue');

    Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware('reseller-auth')->group(function () {
    Route::get('/reseller/dashboard', [ResellerController::class, 'dashboard'])->name('reseller.dashboard');
    Route::get('/reseller/companies', [CompanyController::class, 'list'])->name('reseller.company.list');
    Route::post('/reseller/logout', [ResellerAuthController::class, 'logout'])->name('reseller.logout');
});

Route::middleware(['user-auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // Route::get('/user/mailings', [MailingController::class, 'userMailingList'])->name('user.mailing.list');
    Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});

// Server Send Event
Route::get('/sse', [SseController::class, 'stream']);
