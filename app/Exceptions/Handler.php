<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     // Tampilkan halaman error 404 jika tabel tidak ditemukan
    //     if ($exception instanceof \Illuminate\Database\QueryException && $exception->getCode() === '42S02') {
    //         return response()->view('error.internal_error', [], 404);
    //     }

    //     return parent::render($request, $exception);
    // }
}
