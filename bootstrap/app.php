<?php

use App\Exceptions\ResponseHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //Nenhum middleware global.
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //handler
        $responseHandler = new ResponseHandler();
        $exceptions->render(function (Throwable $error) use ($responseHandler) {
            return $responseHandler->handle($error);
        });
    })->create();
