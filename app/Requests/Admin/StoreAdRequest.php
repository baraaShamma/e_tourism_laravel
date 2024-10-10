<?php
namespace App\Requests\Admin;

use App\Requests\BaseRequestFormApi;

class StoreAdRequest extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // تحقق من نوع الصورة والحجم
        ];
    }
    
    
     public function authorized(): bool
    {
        return true;
    }
    
}
