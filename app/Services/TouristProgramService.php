<?php

namespace App\Services;

use App\Models\TouristProgram;
use App\Models\TouristTrip;

class TouristProgramService {

    public function createProgram(array $data): TouristProgram {
        return TouristProgram::create($data);
    }

    public function updateProgram(TouristProgram $program, array $data): TouristProgram {
        $program->update($data);
        return $program;
    }

    public function deleteProgram(TouristProgram $program): bool {
        return $program->delete();
    }


    public function getAllPrograms()
    {
        return TouristProgram::all();
    }

    public function getProgramWithTripsStatus($id)
    {
        $program = TouristProgram::find($id);

        if (!$program) {
            return null; 
        }

        $hasTrips = TouristTrip::where('tourist_program_id', $id)->exists();

        // إضافة حالة الرحلات
        $program->has_trips = $hasTrips ? 1 : 0;

        return $program;
    }

    public function getTripsByProgramId($id)
    {
        $program = TouristProgram::find($id);
    
        if (!$program) {
            return null; 
        }
    
    
        $trips = TouristTrip::where('tourist_program_id', $id)
            ->with(['bus', 'guide', 'tripImages'])
            ->get();
    
        return $trips->map(function ($trip) {
            return [
                'id' => $trip->id,
                'tourist_program_id' => $trip->tourist_program_id,
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
    
}
