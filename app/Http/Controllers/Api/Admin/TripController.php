<?php
namespace App\Http\Controllers\Api\Admin;

use App\Services\TripService;
use App\Requests\Admin\StoreTripRequest;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TouristTrip;

class TripController extends BaseController
{
    private $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    public function destroy(TouristTrip $trip)
    {
        $this->tripService->deletetrip($trip);
        return $this->sendResponse([], 'trip deleted successfully.');

    }
    public function store(StoreTripRequest $request) {
        // التحقق من أن المستخدم Admin
        if (auth()->user()->type_user !== 'admin') {
            return $this->sendResponse(null, "Unauthorized", 403);
        }
    
        $validatedData = $request->validated();
    
        // // استدعاء الخدمة لإنشاء الرحلة
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
        if ($this->tripService->isUserAlreadyRegistered($tripId, auth()->id())) {
            return response()->json([
                'success' => false,
                'message' => 'أنت مسجل سابقا في هذه الرحلة  .',
            ], 200); // نعيد حالة خطأ 400
        }
        $result = $this->tripService->registerForTrip($tripId, auth()->id());

        if (!$result) {
            return response()->json([
                'state' => false,
                'message' => 'المعذرة لقد اكتمل العدد '
            ], 200);
                    }

        return  response()->json([
            'state' => true,
            'message' => 'تم التسجيل في الرحلة .'
        ], 200);
        
    }

    public function getRegisteredTrips(Request $request)
    {
        // استرجاع المستخدم من الـ token
        $user = Auth::user();

        // التحقق من وجود المستخدم
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // استدعاء الخدمة لجلب الرحلات بناءً على ID المستخدم
        $trips = $this->tripService->getTripsByUserId($user->id);

        // التحقق إذا كانت لا توجد رحلات
        if ($trips->isEmpty()) {
            return response()->json(['message' => 'No registered trips found'], 404);
        }
        return response()->json(['trips' => $trips], 200);

    }
       
}
