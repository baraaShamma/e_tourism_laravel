<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Requests\SearchTripRequest;
use App\Services\TripSearchService;

class TripSearchController extends BaseController
{
    protected $tripSearchService;

    public function __construct(TripSearchService $tripSearchService)
    {
        $this->tripSearchService = $tripSearchService;
    }

    public function search(SearchTripRequest $request)
    {
        // استخدام get مباشرة للحصول على القيمة من البيانات المرسلة عبر POST
        $name = $request->request()->get('name');
      
        // تنفيذ عملية البحث باستخدام الاسم
        $trips = $this->tripSearchService->searchByProgramName($name);
    
        if ($trips->isEmpty()) {
            return response()->json([
                'state' => false,
                'message' => 'No trips found for the specified program name.'
            ], 400);
        }
    
        return $this->sendResponse($trips, "Trips found successfully.");
    }
    
}
