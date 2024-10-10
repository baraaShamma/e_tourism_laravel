<?php

namespace App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\BaseController;
use App\Models\TouristProgram;
use App\Requests\Admin\TouristProgramValidator;
use App\Services\TouristProgramService;
class TouristProgramController extends BaseController {
    protected $touristProgramService;

    public function __construct(TouristProgramService $touristProgramService) {
        $this->touristProgramService = $touristProgramService;
        $this->middleware('auth:sanctum'); // التحقق من التوكن
    }

    public function store(TouristProgramValidator $request) 
        {
            if (auth()->user()->type_user !== 'admin') {
                return $this->sendResponse(null, "Unauthorized", 403);
            }
        
            $data = $request->all();
        
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('tourist_programs', 'public');
                $data['image'] = $imagePath;
            }
        
            $program = $this->touristProgramService->createProgram($data);
        
            return $this->sendResponse($program, "Tourist Program Created");
        }

    public function update(TouristProgramValidator $request, TouristProgram $program) {
        // التحقق من أن المستخدم Admin
        if (auth()->user()->type_user !== 'admin') {
            return $this->sendResponse(null, "Unauthorized", 403);
        }

        // استخدم $request->all() لجلب البيانات
        $program = $this->touristProgramService->updateProgram($program, $request->all());
        return $this->sendResponse($program, "Tourist Program Updated");
    }

    public function destroy(TouristProgram $program) {
        // التحقق من أن المستخدم Admin
        if (auth()->user()->type_user !== 'admin') {
            return $this->sendResponse(null, "Unauthorized", 403);
        }

        $this->touristProgramService->deleteProgram($program);
        return $this->sendResponse(null, "Tourist Program Deleted");
    }
}