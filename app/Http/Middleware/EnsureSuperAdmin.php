<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('auth_token');
        if (!$token) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken) {
            Session::forget('auth_token');
            return redirect()->route('login')->with('error', 'Session invalid.');
        }

        $user = $accessToken->tokenable;
        if (!$user || $user->role !== \App\Models\User::ROLE_SUPER_ADMIN) {
            abort(403, 'Access denied. Super admin only.');
        }

        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
