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
        $name = $request->request()->get('name');

  
        $trips = $this->tripSearchService->searchByProgramName($name);
        // return [$trips];
        if (!$trips) {
            return response()->json([
                'state' => false,
                'message' => 'No trips found for the specified program name.'
            ], 400);
        }

        return $this->sendResponse($trips, "Trips found successfully.");

    }
}
