<?php

namespace App\Http\Requests\cars;

use App\Exceptions\AppError;
use App\Models\Owner;
use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{
    private $owner;

    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        $ownerId = auth()->user()->id;
        $owner = Owner::find($ownerId);
        if (is_null($owner)) {
            throw new AppError('Usuário não autorizado.', 403);
        }
        $this->setOwner($owner);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'model'=> ['required'],
            'color' => ['required'],
            'year' => ['required', 'integer', 'gte:1000'],
            'brand' => ['required'],
            'price' => ['required', 'numeric', 'gte:0']
        ];
    }

    public function messages(): array {
        return [
            'model.required' => 'O modelo deve ser preenchido.',
            'color.required' => 'A cor deve ser preenchido.',
            'year.required' => 'O ano deve ser preenchido.',
            'year.integer' => 'O ano deve ser um número inteiro.',
            'year.gte' => 'O ano deve ter 4 dígitos.',
            'brand.required' => 'A Marca deve ser preenchido.',
            'price.required' => 'O preço deve ser preenchido.',
            'price.numeric' => 'O preço deve ser um número',
            'price.gte' => 'O preço deve ser positivo'
        ]; 
    }
}
