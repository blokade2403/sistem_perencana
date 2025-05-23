<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            // Cek apakah rute saat ini adalah logout
            if ($request->is('logout')) {
                return redirect()->route('login'); // arahkan ke halaman login
            }

            return redirect()->guest(route('login')); // untuk rute lain, redirect ke login
        }

        return $next($request);
    }
}
