<?php

namespace App\Services\cars;

use App\Models\Car;


class DeleteCarByIdService {
    public function execute(Car $car){
        $car->delete();
        return response()->noContent();
    }
}