<?php

namespace App\Http\Controllers;

use App\Http\Requests\cars\{
    CreateCarRequest,
    DeleteCarRequest,
    UpdateCarRequest
};
use App\Services\cars\{
    CreateCarService,
    DeleteCarByIdService,
    RetrieveAllCarsService,
    RetrieveCarsByIdService,
    UpdateCarService
};
use Illuminate\Support\Facades\Route;

class CarController extends Controller {
    public function create(CreateCarRequest $request){
        $owner = $request->getOwner();
        $createCarService = new CreateCarService;
        return $createCarService->execute($owner, $request->all());
    }

    public function update(UpdateCarRequest $request){
        $car = $request->getCar();
        $updateCarService = new UpdateCarService();
        return $updateCarService->execute($car, $request->all());
    }

    public function retrieve($id = null) {
        if (is_null($id)){
            $retrieveAllCarsService = new RetrieveAllCarsService();
            return $retrieveAllCarsService->execute();
        } else {
            $id = (int)$id;
            $retrieveCarByIdService = new RetrieveCarsByIdService();
            return $retrieveCarByIdService->execute($id);
        };
    }

    public function destroy(DeleteCarRequest $request) {
        $car = $request->getCar();
        $deleteCarByIdService = new DeleteCarByIdService();
        return $deleteCarByIdService->execute($car);
    }
};