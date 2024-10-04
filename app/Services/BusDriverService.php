<?php

namespace App\Services;

use App\Models\User;
use App\Models\TouristBus;
use App\Models\BusDriver;

class BusDriverService
{
    // عرض المستخدمين من نوع driver
    public function getDrivers()
    {
        return User::where('type_user', 'driver')->get();
    }

    // عرض الباصات الذين لا يملكون سائقين
    public function getBusesWithoutDrivers()
    {
        return TouristBus::whereDoesntHave('busDriver')->get();
    }

    // إضافة سائق إلى باص
    public function assignDriverToBus($busId, $userId)
    {
        return BusDriver::create([
            'bus_id' => $busId,
            'user_id' => $userId,
        ]);
    }
}
