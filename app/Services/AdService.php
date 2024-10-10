<?php 
namespace App\Services;

use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

class AdService
{
    public function storeAd($data)
    {
        $imagePath = $data['image']->store('ads', 'public');
        
        return Ad::create([
            'image' => $imagePath,
        ]);
    }

    public function deleteAd($adId)
    {
        $ad = Ad::find($adId);

        if ($ad) {
            // حذف الصورة من التخزين
            Storage::disk('public')->delete($ad->image);
            $ad->delete();
            return true;
        }

        return false;
    }

    public function getAllAds()
    {
        return Ad::all();
    }
}
