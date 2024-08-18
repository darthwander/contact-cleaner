<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $this->captureUserId($request);

        if (!Auth::guard('admin')->check() || !isset($userId)) {
            Session::flush();
            return redirect()->route('admin.auth.login');
        }

        $this->putSessionData($request, $userId);

        return $next($request);
    }

    private function captureUserId(Request $request): int|null
    {
        foreach ($request->session()->all() as $key => $value) {
            if (Str::startsWith($key, 'login_')) {
                return $request->session()->get("{$key}");
            }
        }

        return null;
    }

    private function putSessionData(Request $request, int $userId): void
    {
        $request->session()->put([
            'entity'    => 'admin',
            'email'     => Auth::guard('admin')->user()->email,
            'name'      => Auth::guard('admin')->user()->name,
            'entity_id' => $userId
        ]);
    }
}
