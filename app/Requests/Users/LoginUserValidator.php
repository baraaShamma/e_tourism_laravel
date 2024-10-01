<?php
// app/Request/Users/LoginUserValidator.php

namespace App\Requests\Users;

use App\Requests\BaseRequestFormApi;

class LoginUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
