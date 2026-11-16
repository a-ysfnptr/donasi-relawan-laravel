<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(SecurityHeaders::class);
        $middleware->alias(['admin' => AdminMiddleware::class]);
        // Rate limiting login: 5 percobaan / menit per IP+email (lihat routes/web.php)
        $middleware->throttleApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Jangan bocorkan stack trace / detail server di production.
        $exceptions->render(function (Throwable $e, $request) {
            if (config('app.debug')) {
                return null;
            }
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
                return response()->view('errors.generic', [
                    'code' => $e->getStatusCode(),
                    'message' => 'Terjadi kesalahan. Silakan coba lagi.',
                ], $e->getStatusCode());
            }
            return null;
        });
    })->create();
