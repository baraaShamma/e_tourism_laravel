<?php

namespace App\Services;

use App\Models\TouristProgram;

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
}
