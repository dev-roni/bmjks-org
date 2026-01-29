<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'superadmin'=>App\Http\Middleware\SuperAdminMiddleware::class,
            'admin'=>App\Http\Middleware\AdminMiddleware::class,
            'cashier'=>App\Http\Middleware\CashierMiddleware::class,
            'contact'=>App\Http\Middleware\ContactMiddleware::class,
            'viewCount'=>App\Http\Middleware\ViewCountMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
