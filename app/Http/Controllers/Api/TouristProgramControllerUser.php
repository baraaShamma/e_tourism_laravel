<?php 
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use App\Services\TouristProgramService;
use Illuminate\Http\Request;

class TouristProgramControllerUser extends BaseController
{
    protected $touristProgramService;

    public function __construct(TouristProgramService $touristProgramService)
    {
        $this->touristProgramService = $touristProgramService;
    }

    // 1- عرض جميع البرامج السياحية
    public function index()
    {
        $programs = $this->touristProgramService->getAllPrograms();
        return response()->json(['data' => $programs], 200);
    }

    // 2- عرض برنامج سياحي محدد وحالة وجود الرحلات
    public function show($id)
    {
        $program = $this->touristProgramService->getProgramWithTripsStatus($id);

        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        return response()->json(['data' => $program], 200);
    }

    public function getTripsByProgram($id)
    {
        $program = $this->touristProgramService->getTripsByProgramId($id);

        if (!$program) {
            return response()->json(['message' => 'Program or trips not found'], 404);
        }

        return response()->json(['data' => $program], 200);
    }
}
