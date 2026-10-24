<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

foreach ([
    __DIR__.'/cache',
    dirname(__DIR__).'/storage/app/private',
    dirname(__DIR__).'/storage/app/public',
    dirname(__DIR__).'/storage/framework/cache/data',
    dirname(__DIR__).'/storage/framework/sessions',
    dirname(__DIR__).'/storage/framework/testing',
    dirname(__DIR__).'/storage/framework/views',
    dirname(__DIR__).'/storage/logs',
] as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\DetectDeviceMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
