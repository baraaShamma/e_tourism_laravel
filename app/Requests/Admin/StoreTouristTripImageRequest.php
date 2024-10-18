<?php 
namespace App\Requests\Admin;
use App\Requests\BaseRequestFormApi;


class StoreTouristTripImageRequest extends BaseRequestFormApi
{
 
    public function rules(): array
    {
        return [
            'tourist_trip_id' => 'required|exists:tourist_trips,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function authorize()
    {
        return true;
    }

}
