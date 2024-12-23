<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */    
    
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'manager') {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke halaman login
        return redirect()->route('login');
    }
}
