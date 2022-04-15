<?php

namespace App\Http\Requests;

class RecoverPasswordRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email' =>  ['required', 'email'],
        ];
    }
}
