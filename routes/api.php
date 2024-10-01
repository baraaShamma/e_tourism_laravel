<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
});
Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('logout', 'logout');

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
