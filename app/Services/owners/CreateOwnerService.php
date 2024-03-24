<?php

namespace App\Services\owners;

use App\Exceptions\AppError;
use App\Models\Owner;


class CreateOwnerService {
    public function excecute(array $data){
        $ownerFound = Owner::firstWhere('email', $data['email']);
        //user already exist?
        if (!is_null($ownerFound)){
            throw new AppError('Email já cadastrado', 400);
        }
        return Owner::create($data);
    }
}