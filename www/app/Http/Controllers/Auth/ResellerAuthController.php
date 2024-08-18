<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ResellerAuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ResellerAuthController extends Controller
{
    public function showLogin()
    {
        return view('reseller.auth.login');
    }

    public function login(ResellerAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (isset($request->validator)) {
            return back()->withErrors($errors);
        }

        if (Auth::guard('reseller')->attempt($credentials)) {
            return redirect()
                ->intended(route('reseller.dashboard'))
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
        Auth::guard('reseller')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/reseller/login');
    }
}
