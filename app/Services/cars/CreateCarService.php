<?php

namespace App\Services\cars;

use App\Models\Car;
use App\Models\Owner;

class CreateCarService {
    public function execute(Owner $owner, array $data){
        $data['owner_id'] = $owner->id;
        $newCar = Car::create($data);
        return $newCar;
    }
}