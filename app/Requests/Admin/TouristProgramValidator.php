<?php

namespace App\Requests\Admin;

use App\Requests\BaseRequestFormApi;
use Illuminate\Foundation\Http\FormRequest;

class TouristProgramValidator extends FormRequest {
    public function rules(): array {
        return [
            'type' => 'required|max:50',
            'name' => 'required|max:100',
            'description' => 'required',
        ];
    }

    public function authorize(): bool {
        return true;
    }
}