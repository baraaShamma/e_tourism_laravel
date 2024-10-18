<?php
namespace App\Services;

use App\Models\TouristTrip;
use App\Models\TripRegistration;

class TripService
{
    public function createTrip($data)
    {

        return TouristTrip::create($data);
    }
    
    public function deletetrip($trip)
    {
        return $trip->delete();
    }

    public function getAllTrips()
    {
    return TouristTrip::with(['touristProgram', 'tripImages'])->get();
    }
    
    public function getTripsByUserId($userId)
    {
        // جلب الرحلات التي قام المستخدم بالتسجيل عليها من جدول trip_registrations
        $trips = TouristTrip::whereHas('registrations', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with('touristProgram', 'bus', 'guide','tripImages')
        ->get();
          return $trips->map(function ($trip) {
            return [
                'id' => $trip->id,
                'tourist_program_id' => $trip->tourist_program_id,
                'description' => $trip->touristProgram->description,
                'name' => $trip->touristProgram->name,
                'type' => $trip->touristProgram->type,

                'bus_type' => $trip->bus->bus_type,
                'guide' => [
                    'fName' => $trip->guide->fName,  
                    'lName' => $trip->guide->lName,
                    'mobile' => $trip->guide->mobile 
                ],
                'price' => $trip->price,
                'max_capacity' => $trip->max_capacity,
                'trip_date' => $trip->trip_date,
                'images' => $trip->tripImages->pluck('image'),
  
            ];
        });
    }
    
    public function getTripsBetweenDates($startDate, $endDate)
    {
    
        $trips = TouristTrip::whereBetween('trip_date', [$startDate, $endDate])
         ->with(['bus', 'guide', 'tripImages','touristProgram'])
        ->get();
        return $trips->map(function ($trip) {
            return [
                'id' => $trip->id,
                'tourist_program_id' => $trip->tourist_program_id,
                'name' => $trip->touristProgram->name,
                'description' => $trip->touristProgram->description,
                'bus_type' => $trip->bus->bus_type,
                'guide' => [
                    'fName' => $trip->guide->fName,  
                    'lName' => $trip->guide->lName,
                    'mobile' => $trip->guide->mobile 
                ],
                'price' => $trip->price,
                'max_capacity' => $trip->max_capacity,
                'trip_date' => $trip->trip_date,
                'images' => $trip->tripImages->pluck('image'),
  
            ];
        });
    }
    public function isUserAlreadyRegistered($tripId, $userId)
    {
        return TripRegistration::where('trip_id', $tripId)
                                            ->where('user_id', $userId)
                                            ->exists();
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
