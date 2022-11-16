<?php

namespace App\Http\Requests;

class ResetPasswordRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'password' => ['required']
        ];
    }
}
