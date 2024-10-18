<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserServices{
    public function createUser(array $data): User {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    // خدمة تسجيل الدخول
    public function loginUser(array $credentials)
    {
        // محاولة التحقق من البريد الإلكتروني وكلمة المرور
        if (Auth::attempt($credentials)) {
            // المستخدم تم التحقق منه
            $user = Auth::user();
    
            $token = $user->createToken('authToken')->plainTextToken;
    
            // إرجاع التوكن ونوع المستخدم
            return [
                'token' => $token,
                'type_user' => $user->type_user,
            ];
        }
    
        return null;
    }
    

}
