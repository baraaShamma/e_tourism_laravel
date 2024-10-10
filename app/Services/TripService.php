<?php
namespace App\Services;

use App\Models\TouristTrip;

class TripService
{
    public function createTrip($data)
    {

        return TouristTrip::create($data);
    }
    

    public function getAllTrips()
    {
        return TouristTrip::with('touristProgram')->get();
    }
    

    public function getTripsBetweenDates($startDate, $endDate)
    {
        return TouristTrip::whereBetween('trip_date', [$startDate, $endDate])->get();
    }

    public function registerForTrip($tripId, $userId)
    {
        $trip = TouristTrip::find($tripId);

        if ($trip->registrations->count() >= $trip->max_capacity) {
            return false; // No more slots available
        }

        return $trip->registrations()->create(['user_id' => $userId]);
    }
}
