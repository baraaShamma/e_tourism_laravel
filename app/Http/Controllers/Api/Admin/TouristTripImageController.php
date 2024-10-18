<?php 
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Requests\Admin\StoreTouristTripImageRequest;
use App\Services\TouristTripImageService;

class TouristTripImageController extends BaseController
{
    protected $touristTripImageService;

    public function __construct(TouristTripImageService $touristTripImageService)
    {
        $this->touristTripImageService = $touristTripImageService;
    }

    public function store(StoreTouristTripImageRequest $request)
    {
        $image = $this->touristTripImageService->addTripImage($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tourist trip image added successfully.',
            'data' => $image,
        ]);
    }
}
