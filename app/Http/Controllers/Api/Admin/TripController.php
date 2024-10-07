<?php
namespace App\Http\Controllers\Api\Admin;

use App\Services\TripService;
use App\Requests\Admin\StoreTripRequest;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class TripController extends BaseController
{
    private $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

  
    public function store(StoreTripRequest $request) {
        // التحقق من أن المستخدم Admin
        if (auth()->user()->type_user !== 'admin') {
            return $this->sendResponse(null, "Unauthorized", 403);
        }
    
        // التحقق من صحة البيانات باستخدام الـ Validator
        $validatedData = $request->validated();
    
        // استدعاء الخدمة لإنشاء الرحلة
        $trip = $this->tripService->createTrip($validatedData);
    
        return $this->sendResponse($trip, "Tourist Trip Created Successfully");
    }
    
    public function index()
    {
        $trips = $this->tripService->getAllTrips();
        return $this->sendResponse($trips, 'All trips retrieved successfully.');
    }

    public function getTripsBetweenDates(Request $request)
    {
        $trips = $this->tripService->getTripsBetweenDates($request->start_date, $request->end_date);
        return $this->sendResponse($trips, 'Trips retrieved successfully.');
    }

    public function register(Request $request, $tripId)
    {
        $result = $this->tripService->registerForTrip($tripId, auth()->id());

        if (!$result) {
            return response()->json([
                'state' => false,
                'message' => 'Some error occurred'
            ], 400);
                    }

        return $this->sendResponse($result, 'Successfully registered for the trip.');
    }
}
