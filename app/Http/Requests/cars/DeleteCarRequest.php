<?php

namespace App\Http\Requests\cars;

use App\Exceptions\AppError;
use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCarRequest extends FormRequest {
    private $car;

    public function setCar(Car $car): void {
        $this->car = $car;
    }

    public function getCar(): ?Car {
        return $this->car;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        $carId = $this->route('id');
        $requestUserId = auth()->user()->id;
        $car = Car::find($carId);
        if (is_null($car)){
            throw new AppError('Carro não encontrado.', 404);
        }
        if ($car->owner_id != $requestUserId){
            throw new AppError('Usuário não autorizado.', 403);
        }

        $this->setCar($car);
        return true;
    }
}