<?php

namespace App\Http\Requests\owners;

use App\Exceptions\AppError;
use Illuminate\Foundation\Http\FormRequest;

class DeleteOwnerRequest extends FormRequest
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
}
