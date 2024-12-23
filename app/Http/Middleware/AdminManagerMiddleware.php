<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna memiliki role 'admin'
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'manager'])) {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke halaman login
        return redirect()->route('login');
    }
}
