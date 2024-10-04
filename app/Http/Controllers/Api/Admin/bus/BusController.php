<?php

namespace App\Http\Controllers\Api\Admin\Bus;

use App\Http\Controllers\Api\BaseController;
use App\Requests\Admin\Bus\StoreBusRequest;
use App\Requests\Admin\Bus\UpdateBusRequest;
use App\Models\TouristBus;
use App\Services\Bus\BusService;

class BusController extends BaseController
{
    protected $busService;

    public function __construct(BusService $busService)
    {
        $this->busService = $busService;
    }

    public function store(StoreBusRequest $request)
    {
        $bus = $this->busService->createBus($request->validated());
        return $this->sendResponse($bus, 'Bus created successfully.');
    }

    public function updateStatus(UpdateBusRequest $request, TouristBus $bus)
    {
        // استخدم validated للحصول على القيم الصحيحة من الطلب
        $validatedData = $request->validated();
    
        // تحديث حالة الحافلة باستخدام القيمة المستلمة من الطلب
        $bus = $this->busService->updateBusStatus($bus, $validatedData['bus_status']);
        
        return $this->sendResponse($bus, 'Bus status updated successfully.');
    }

    public function destroy(TouristBus $bus)
    {
        $this->busService->deleteBus($bus);
        return $this->sendResponse([], 'Bus deleted successfully.');
    }
}
