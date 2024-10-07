<?php 
namespace App\Requests;

use App\Requests\BaseRequestFormApi;

class SearchTripRequest extends BaseRequestFormApi
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
        ];
    }
}
