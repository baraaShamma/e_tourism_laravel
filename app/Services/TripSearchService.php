<?php
namespace App\Services;

use App\Models\TouristProgram;

class TripSearchService
{
    public function searchByProgramName($name)
    {
        $program = TouristProgram::where('name', 'LIKE', "%{$name}%")->first();
        if (!$program ) {
            return null;
        }
           $tripsWithProgram = $program->Trip()->with('touristProgram')->get();
           return $tripsWithProgram;
    }
}
