<?php
namespace App\Requests\Admin;

use App\Requests\BaseRequestFormApi;

class StoreTripRequest extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'tourist_program_id' => 'required|exists:tourist_programs,id',
            'bus_id' => 'required|exists:tourist_buses,id',
            'guide_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
            'max_capacity' => 'required|integer',
            'trip_date' => 'required|date',
        ];
    }

    
     public function authorized(): bool
    {
        return true;
    }
    
}
