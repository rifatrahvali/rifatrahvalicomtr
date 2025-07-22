<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // API rotalarını sisteme tanıtıyoruz.
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 2FA middleware'ini '2fa' adıyla kaydediyoruz.
        // Bu, rotalarda ->middleware('2fa') şeklinde kolayca kullanmamızı sağlar.
                $middleware->web(append: [
            \App\Http\Middleware\Google2FAMiddleware::class,
        ]);

        $middleware->alias([
            '2fa' => \App\Http\Middleware\Google2FAMiddleware::class,
        ]);
        // Sanctum'un SPA kimlik doğrulama middleware'ini ekliyoruz.
                // API rotaları için rate limiting (istek sınırlama) middleware'ini ekliyoruz.
        // Bu, 'api' middleware grubuna dahil olan tüm rotaları korur.
        // Varsayılan olarak, dakikada 60 istekle sınırlıdır.
        $middleware->throttle('api');

        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
