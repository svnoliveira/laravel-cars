<?php

namespace App\Services\cars;

use App\Models\Car;

class RetrieveAllCarsService {
    public function execute(){
        $cars = Car::all();
        return $cars;
    }
}