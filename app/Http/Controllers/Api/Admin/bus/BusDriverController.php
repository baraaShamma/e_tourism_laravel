<?php

namespace App\Http\Controllers\Api\Admin\Bus;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Requests\Admin\Bus\AssignDriverRequest;
use App\Services\BusDriverService;

class BusDriverController extends BaseController
{
    protected $busDriverService;

    public function __construct(BusDriverService $busDriverService)
    {
        $this->busDriverService = $busDriverService;
    }

    // عرض المستخدمين من نوع driver
    public function getDrivers()
    {
        $drivers = $this->busDriverService->getDrivers();
        return response()->json($drivers);
    }

    // عرض الباصات الذين لا يملكون سائقين
    public function getBusesWithoutDrivers()
    {
        $buses = $this->busDriverService->getBusesWithoutDrivers();
        return response()->json($buses);
    }

    // إضافة سائق إلى باص
    public function assignDriver(AssignDriverRequest $request)
    {
        // استخدام الدوال الجديدة للوصول إلى bus_id و user_id
        $driver = $this->busDriverService->assignDriverToBus($request->getBusId(), $request->getUserId());
        return response()->json($driver, 201);
    }
}
