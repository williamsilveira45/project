<?php

use App\Configuration\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
    })
    ->withEvents(discover: [
        __DIR__.'/../app/Listeners',
        __DIR__.'/../app/Modules/Users/Listeners',
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
