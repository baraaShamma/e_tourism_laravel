<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Requests\Users\CreateUserValidator;
use App\Services\UserServices;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    protected $userService;

    public function __construct(UserServices $userService) {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        // تحقق من صحة البيانات
        $validator = new CreateUserValidator($request);
    
        if (!$validator->isStatus()) {
            return $this->sendResponse($validator->getErrors(), 'Validation Failed', 422);
        }
    
        // إنشاء المستخدم الجديد
        $user = $this->userService->createUser($request->all());
    
        // إنشاء Token باستخدام Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // إرجاع المستخدم مع الـ Token
        return $this->sendResponse([
            'user' => $user,
            'token' => $token
        ], 'User Created Successfully');
    }
    
}
