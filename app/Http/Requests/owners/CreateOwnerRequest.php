<?php

namespace App\Http\Requests\owners;

use Illuminate\Foundation\Http\FormRequest;

class CreateOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'email'=> ['required', 'email'],
            'name' => ['required', 'min:4'],
            'password' => ['required', 'min:4'],
            'age' => ['sometimes', 'integer', 'gte:18'],
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email deve ser um endereço válido',
            'name.required' => 'Nome é obrigatório',
            'name.min' => 'O nome deve ter ao menos 4 caracteres',
            'password.required' => 'Senha é obrigatória',
            'password.min' => 'A senha deve ter ao menos 4 caracteres',
            'age.integer' => 'A idade deve ser um número inteiro',
            'age.gte' => 'A idade deve ser ao menos 18 para ser dono de um carro.'
        ]; 
    }
}
