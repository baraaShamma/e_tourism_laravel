<?php

namespace App\Requests\Users;

use App\Requests\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi {
    public function rules(): array
    {
        return [
            'fName' => 'required|max:50',
            'lName' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'type_user' => 'required|in:admin,tourist,guide,driver',
            'mobile' => 'nullable|max:20',
            'address' => 'nullable|max:255',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
