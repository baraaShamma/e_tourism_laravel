<?php

namespace App\Services\Bus;

use App\Models\TouristBus;

class BusService
{
    public function createBus($data)
    {
        return TouristBus::create($data);
    }

    public function updateBusStatus($bus, $status)
    {
        $bus->update(['bus_status' => $status]);
        return $bus;
    }

    public function deleteBus($bus)
    {
        return $bus->delete();
    }
}
