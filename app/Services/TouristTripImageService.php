<?php 
namespace App\Services;

use App\Models\TouristTripImage;
use Illuminate\Support\Facades\Storage;

class TouristTripImageService
{
    public function addTripImage($data)
    {
        // حفظ الصورة
        $path = $data['image']->store('tourist_trip_images', 'public');

        // إنشاء السجل في قاعدة البيانات
        return TouristTripImage::create([
            'tourist_trip_id' => $data['tourist_trip_id'],
            'image' => $path,
        ]);
    }
}
