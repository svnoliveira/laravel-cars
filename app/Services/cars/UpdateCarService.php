<?php

namespace App\Services\cars;

use App\Exceptions\AppError;
use App\Models\Car;


class UpdateCarService {
    public function execute(Car $car, array $data){

        foreach ($data as $field => $value) {
            $car->$field = $value;
        };

        $car->save();
        return $car;
    }
}