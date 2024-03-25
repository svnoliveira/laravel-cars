<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ResponseHandler {
    public function handle(Throwable $error)
    {
        // checa a exceção e retorna uma resposta em json.

        if ($error instanceof ValidationException) {
            return response()->json([
                'errors' => $error->validator->errors()
            ], 422);
        }

        if ($error instanceof AuthorizationException) {
            return response()->json([
                'errors' => 'Usuário não autorizado.'
            ], 403);
        }

        if ($error instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => 'Rota não encontrada'
            ], 404);
        }

        if ($error instanceof AppError) {
            return response()->json([
                'errors' => $error->getMessage()
            ], $error->getCode());
        }

        return response()->json([
            'message' => 'Ocorreu um erro interno do servidor.'
        ], 500);
    }
}
