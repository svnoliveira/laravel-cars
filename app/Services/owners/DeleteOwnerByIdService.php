<?php

namespace App\Services\owners;

use App\Exceptions\AppError;
use App\Models\Owner;


class DeleteOwnerByIdService {
    public function execute(int $ownerId){
        if ($ownerId <= 0) {
            throw new AppError('Id de usuário inválido', 404);
        };

        $ownerFound = Owner::find($ownerId);
        if (is_null($ownerFound)){
            throw new AppError('Usuário não encontrado', 404);
        };

        $ownerFound->delete();
        return response()->noContent();
    }
}