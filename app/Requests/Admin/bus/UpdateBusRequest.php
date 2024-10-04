<?php

namespace App\Requests\Admin\Bus;

use App\Requests\BaseRequestFormApi;

class UpdateBusRequest extends BaseRequestFormApi
{
    public function authorize()
    {
        return auth()->user()->type_user === 'admin'; // السماح فقط للمستخدمين من النوع Admin
    }

    public function rules(): array
    {
        return [
            'bus_status' => 'required|boolean', // حالة الحافلة 1 أو 0
        ];
    }
}
