<?php

namespace App\Http\Requests\cars;

use App\Exceptions\AppError;
use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest {
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'model'=> ['sometimes', 'min:1'],
            'color' => ['sometimes', 'min:1'],
            'year' => ['sometimes', 'integer', 'gte:1000'],
            'brand' => ['sometimes', 'min:1'],
            'price' => ['sometimes', 'numeric', 'gte:0'],
            // 'owner_id' => ['sometimes', 'integer'],
        ];
    }

    public function messages(): array {
        return [
            'model.min' => 'O modelo deve ter ao menos 1 caractere',
            'color.min' => 'A cor deve ter ao menos 1 caractere',
            'year.integer' => 'O ano deve ser um número inteiro.',
            'year.gte' => 'O ano deve ter 4 dígitos.',
            'brand.min' => 'A Marca deve ter ao menos 1 caractere',
            'price.numeric' => 'O preço deve ser um número',
            'price.gte' => 'O preço deve ser positivo'
        ]; 
    }
}
