<?php 
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Requests\Admin\StoreAdRequest;
use App\Services\AdService;
use Illuminate\Http\Request;

class AdController extends BaseController
{
    protected $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }
    public function store(StoreAdRequest $request)
    {
        $data = $request->validated(); // تأكد أن الحقول صحيحة بناءً على قواعد التحقق
        $ad = $this->adService->storeAd($data);
    
        return $this->sendResponse($ad, 'Ad created successfully');
    }
    

    public function destroy($id)
    {
        $deleted = $this->adService->deleteAd($id);

        if ($deleted) {
            return response()->json(['message' => 'Ad deleted successfully']);
        }

        return response()->json(['message' => 'Ad not found'], 404);
    }

    public function index()
    {
        $ads = $this->adService->getAllAds();

        // نعيد كل إعلان مع رابط الصورة
        $adsWithImages = $ads->map(function ($ad) {
            $ad->image_url = url('storage/ads/' . $ad->image);
            return $ad;
        });

        return response()->json(['data' => $adsWithImages], 200);
    }
}
