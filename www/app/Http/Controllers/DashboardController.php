<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Mailing;

class DashboardController extends Controller
{
    public function index()
    {
        $companies = Company::count();
        $mailings = Mailing::count();

        return view('admin.dashboard', compact('companies', 'mailings'));
    }
}
