<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Models\Company;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (empty($token)) {
            return response()->json(['message' => 'Unauthorized: Token not provided'], 401);
        }

        $company = (new Company)->findBy('api_token', $token);

        if (!$company) {
            return response()->json(['message' => 'Unauthorized: Invalid token'], 401);
        }

        Auth::login($company);

        return $next($request);
    }
}
