<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSuperAdminApi
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user || !$user->isSuperAdmin()) {
            return response()->json([
                'response_code' => 403,
                'status'        => 'error',
                'message'       => 'Access denied. Super admin only.',
            ], 403);
        }

        return $next($request);
    }
}
