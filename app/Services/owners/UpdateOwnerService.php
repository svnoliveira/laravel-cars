<?php

namespace App\Services\owners;

use App\Exceptions\AppError;
use App\Models\Owner;


class UpdateOwnerService {
    public function execute(int $ownerId, array $data){
        if ($ownerId <= 0) {
            throw new AppError('Id de usuário inválido', 404);
        };

        $ownerFound = Owner::find($ownerId);
        if (is_null($ownerFound)){
            throw new AppError('Usuário não encontrado', 404);
        };

        foreach ($data as $field => $value) {
            $ownerFound->$field = $value;
        };

        $ownerFound->save();
        return $ownerFound;
    }
}