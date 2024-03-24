<?php

use App\Exceptions\AppError;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $error){
            //verifica se é um erro de validação de app/requests
            if ($error instanceof ValidationException) {
                return response()->json([
                    'errors' => $error->validator->errors()
                ], 422);
            };
            //verifica se o erro é criado pelo app
            if ($error instanceof AppError) {
                return response()->json([
                    'errors' => $error->getMessage()
                ], $error->getCode());
            };
    
            return response()->json([
                'message' => 'Ocorreu um erro interno do servidor.'
            ], 500);
        });
    })->create();
