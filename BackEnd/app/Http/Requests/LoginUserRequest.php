<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class LoginUserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'email' => 'email|required',
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];
    }
}
