<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\TouristProgramController;
use App\Http\Controllers\Api\Admin\Bus\BusController;
use App\Http\Controllers\Api\Admin\Bus\BusDriverController;
use App\Http\Controllers\Api\Admin\guide\GuideController;
use App\Http\Controllers\Api\Admin\TripController;
use App\Http\Controllers\Api\Admin\TouristTripImageController;
use App\Http\Controllers\Api\Admin\AdController;
use App\Http\Controllers\Api\TripSearchController;
use App\Http\Controllers\Api\TouristProgramControllerUser;

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
    Route::get('buses', [BusController::class, 'index']);
    Route::post('buses', [BusController::class, 'store']);
    Route::patch('buses/{bus}/status', [BusController::class, 'updateStatus']);
    Route::delete('/buses/{bus}', [BusController::class, 'destroy']);
    // Route for getting all drivers
Route::get('admin/drivers', [BusDriverController::class, 'getDrivers']);
Route::get('admin/guides', [GuideController::class, 'getGuides']);
Route::delete('admin/guides/{user}', [GuideController::class, 'destroy']);
});



// Route for getting buses without drivers
Route::get('admin/buses/without-drivers', [BusDriverController::class, 'getBusesWithoutDrivers']);

// Route for assigning a driver to a bus
Route::post('admin/buses/assign-driver', [BusDriverController::class, 'assignDriver']);


Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::post('admin/trips', [TripController::class, 'store']);
    Route::delete('admin/trips/{trip}', [TripController::class, 'destroy']);
    Route::post('admin/ads', [AdController::class, 'store']);

Route::delete('admin/ads/{id}', [AdController::class, 'destroy']); 
Route::post('admin/trips/images', [TouristTripImageController::class, 'store'])->middleware('admin'); // إضافة صورة للرحلة


});

// مسارات لعرض الرحلات وحجزها
Route::middleware('auth:api')->group(function () {
    Route::get('trips', [TripController::class, 'index']); // عرض جميع الرحلات
    Route::post('trips/dates', [TripController::class, 'getTripsBetweenDates']); // عرض الرحلات بين تاريخين
    Route::get('trips/registered', [TripController::class, 'getRegisteredTrips']);

    // حجز الرحلة للمستخدمين من نوع tourist فقط
    Route::post('trips/{tripId}/register', [TripController::class, 'register'])->middleware('tourist');
});

Route::middleware('auth:api')->group(function () {
    Route::post('trips/search', [TripSearchController::class, 'search']);
    Route::get('ads', [AdController::class, 'index']);
    // عرض جميع البرامج السياحية
Route::get('tourist-programs', [TouristProgramControllerUser::class, 'index']);

// عرض برنامج سياحي محدد مع حالة وجود الرحلات
Route::get('tourist-programs/{id}', [TouristProgramControllerUser::class, 'show']);

// عرض الرحلات الخاصة ببرنامج سياحي محدد
Route::get('tourist-programs/{id}/trips', [TouristProgramControllerUser::class, 'getTripsByProgram']);


});

