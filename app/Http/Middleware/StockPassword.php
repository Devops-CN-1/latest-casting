<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StockPassword
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('stock_password')) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }

        return $next($request);
    }
}
