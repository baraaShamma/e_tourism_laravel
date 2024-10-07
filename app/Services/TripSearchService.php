<?php
namespace App\Services;

use App\Models\TouristProgram;

class TripSearchService
{
    public function searchByProgramName($name)
    {
        // ابحث عن البرنامج السياحي بناءً على الاسم
        $program = TouristProgram::where('name', 'LIKE', "%{$name}%")->first();

        // إذا لم يتم العثور على برنامج
        if (!$program ) {
            return null;
        }

           $tripsWithProgram = $program->Trip()->with('touristProgram')->get();
           return $tripsWithProgram;
    }
}
