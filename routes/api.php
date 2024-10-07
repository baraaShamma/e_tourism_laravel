<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\TouristProgramController;
use App\Http\Controllers\Api\Admin\Bus\BusController;
use App\Http\Controllers\Api\Admin\Bus\BusDriverController;
use App\Http\Controllers\Api\Admin\TripController;
use App\Http\Controllers\Api\TripSearchController;

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

Route::middleware('auth:sanctum')->group(function() {
    Route::post('tourist-programs', [TouristProgramController::class, 'store']);
    Route::put('tourist-programs/{program}', [TouristProgramController::class, 'update']);
    Route::delete('tourist-programs/{program}', [TouristProgramController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('buses', [BusController::class, 'store']);
    Route::patch('buses/{bus}/status', [BusController::class, 'updateStatus']);
    Route::delete('/buses/{bus}', [BusController::class, 'destroy']);
});

// Route for getting all drivers
Route::get('admin/drivers', [BusDriverController::class, 'getDrivers']);

// Route for getting buses without drivers
Route::get('admin/buses/without-drivers', [BusDriverController::class, 'getBusesWithoutDrivers']);

// Route for assigning a driver to a bus
Route::post('admin/buses/assign-driver', [BusDriverController::class, 'assignDriver']);


Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::post('admin/trips', [TripController::class, 'store']); // إضافة رحلة جديدة
});

// مسارات لعرض الرحلات وحجزها
Route::middleware('auth:api')->group(function () {
    Route::get('trips', [TripController::class, 'index']); // عرض جميع الرحلات
    Route::get('trips/dates', [TripController::class, 'getTripsBetweenDates']); // عرض الرحلات بين تاريخين

    // حجز الرحلة للمستخدمين من نوع tourist فقط
    Route::post('trips/{tripId}/register', [TripController::class, 'register'])->middleware('tourist');
});

Route::middleware('auth:api')->group(function () {
    Route::get('trips/search', [TripSearchController::class, 'search']);
});
