<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\UserAuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function login(UserAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (isset($request->validator)) {
            return back()->withErrors($errors);
        }

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()
                    ->intended(route('user.dashboard'))
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
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/user/login');
    }
}