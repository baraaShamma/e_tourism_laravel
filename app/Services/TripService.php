<?php
namespace App\Services;

use App\Models\TouristTrip;
use Illuminate\Support\Facades\Log;

class TripService
{
    public function createTrip($data)
    {
        // Log::info('Creating trip with data:', $data);

        return TouristTrip::create($data);
    }
    

    public function getAllTrips()
    {
        return TouristTrip::all();
    }

    public function getTripsBetweenDates($startDate, $endDate)
    {
        return TouristTrip::whereBetween('trip_date', [$startDate, $endDate])->get();
    }

    public function registerForTrip($tripId, $userId)
    {
        $trip = TouristTrip::find($tripId);

        if ($trip->registrations->count() >= $trip->max_participants) {
            return false; // No more slots available
        }

        return $trip->registrations()->create(['user_id' => $userId]);
    }
}
