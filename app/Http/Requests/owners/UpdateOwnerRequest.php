<?php

namespace App\Http\Requests\owners;

use App\Exceptions\AppError;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        $ownerId = $this->route('id');
        if (auth()->user()->id != $ownerId){
            throw new AppError('Usuário não autorizado', 403);
        };
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'email'=> ['sometimes', 'email'],
            'name' => ['sometimes', 'min:4'],
            'password' => ['sometimes', 'min:4'],
            'age' => ['sometimes', 'integer', 'gte:18'],
        ];
    }

    public function messages(): array {
        return [
            'email.email' => 'Email deve ser um endereço válido',
            'name.min' => 'O nome deve ter ao menos 4 caracteres',
            'password.min' => 'A senha deve ter ao menos 4 caracteres',
            'age.integer' => 'A idade deve ser um número inteiro',
            'age.gte' => 'A idade deve ser ao menos 18 para ser dono de um carro.'
        ]; 
    }
}
