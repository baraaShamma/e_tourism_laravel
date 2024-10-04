<?php

namespace App\Requests\Admin\Bus;

use App\Requests\BaseRequestFormApi;

class StoreBusRequest extends BaseRequestFormApi
{
    public function authorize()
    {
        return auth()->user()->type_user === 'admin'; // السماح فقط للمستخدمين من النوع Admin
    }

    public function rules(): array
    {
        return [
            'bus_number' => 'required|numeric|digits_between:1,6|unique:tourist_buses,bus_number',
            'bus_type' => 'required|string|max:50',
            'seat_count' => 'required|integer',
            'bus_status' => 'required|boolean', // حالة الحافلة 1 أو 0
        ];
    }
}
