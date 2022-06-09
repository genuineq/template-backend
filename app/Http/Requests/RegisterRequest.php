<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RegisterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'terms_and_conditions' => ['required'],
            'name' =>  ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required'],
            'password_confirm' => ['required', 'same:password'],
        ];
    }
}
