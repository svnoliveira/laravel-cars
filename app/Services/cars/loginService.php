<?php

namespace App\Services\owners;

use App\Exceptions\AppError;
use App\Models\Owner;


class loginService {
    public function excecute(array $data){
        if(!$token = auth()->attempt($data)){
            throw new AppError('Email ou senha incorretos', 401);
        }
        return $this->responseToken($token);
    }

    private function responseToken(string $token) {
        return response()->json([
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }
};