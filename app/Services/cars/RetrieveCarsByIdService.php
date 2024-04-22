<?php

namespace App\Services\cars;

use App\Exceptions\AppError;
use App\Models\Car;

class RetrieveCarsByIdService {
    public function execute(int $carId){
        if (!is_numeric($carId) || $carId <= 0) {
            throw new AppError('Id do carro inválido', 404);
        };

        $carFound = Car::find($carId);

        if (is_null($carFound)){
            throw new AppError('Carro não encontrado', 404);
        };

        return $carFound;
    }
};