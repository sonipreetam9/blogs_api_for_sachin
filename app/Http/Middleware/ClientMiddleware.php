<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('client')->check()) {
            return $next($request);
        }

        return redirect()->route('client.login.page');
    }
}
