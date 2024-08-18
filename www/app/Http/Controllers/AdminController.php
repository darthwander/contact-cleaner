<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Reseller;
use Illuminate\View\View;


class AdminController extends Controller
{

    public function index(Request $request): View
    {
        $admins = (new Admin)->list($request);
        $resellers = (new Reseller)->list();

        return view('admin.configurations', compact('admins', 'resellers'));
    }
}
