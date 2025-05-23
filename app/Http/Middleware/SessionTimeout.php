<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    protected $timeout = 900; // 15 minutes (900 seconds)

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity_time');
            $currentTime = time();

            // Periksa apakah sesi pengguna telah kedaluwarsa
            if ($lastActivity && ($currentTime - $lastActivity) > $this->timeout) {
                Auth::logout(); // Logout user
                session()->flush(); // Clear session data

                // Arahkan pengguna kembali ke halaman login dengan pesan error
                return redirect('/login')->with('error', 'Silahkan Login Kembali');
            }

            // Perbarui waktu aktivitas terakhir pengguna
            session(['last_activity_time' => $currentTime]);
        }

        return $next($request);
    }
}
