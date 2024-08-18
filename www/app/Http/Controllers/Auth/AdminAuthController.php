<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AdminAuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(AdminAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (isset($request->validator)) {
            return back()->withErrors($errors);
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()
                    ->intended(route('admin.dashboard'))
                    ->with('toastr', [
                        'msg'=>'Você está logado!',
                        'status'=>'success'
                    ]);
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
