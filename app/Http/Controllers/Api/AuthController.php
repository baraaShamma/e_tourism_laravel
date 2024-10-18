<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Requests\Users\LoginUserValidator;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    protected $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        // تحقق من البيانات باستخدام Validator
        $validator = new LoginUserValidator($request);

        if (!$validator->isStatus()) {
            return $this->sendResponse($validator->getErrors(), "Validation Error", 422);
        }

        // استدعاء خدمة تسجيل الدخول
        $token = $this->userService->loginUser($request->only('email', 'password'));

        if ($token) {
            return $this->sendResponse([$token], "Login Successful");
        }

        return $this->sendResponse(['error' => 'Invalid Credentials'], "Unauthorized", 401);
    }
    public function logout(Request $request)
    {
        // التأكد من أن المستخدم مسجل الدخول وله توكن صالح
        $user = $request->user();
        
        if ($user && $user->currentAccessToken()) {
            // حذف التوكن الحالي
            $user->currentAccessToken()->delete();
            return $this->sendResponse(null, "Logout Successful");
        }
    
        return $this->sendResponse(null, "No active session", 400);
    }
    
}
