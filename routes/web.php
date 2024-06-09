<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\SensorReadingController;
use App\Http\Controllers\ControlDeviceController;
use App\Http\Controllers\ControlDeviceStatusController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // New routes for API
    Route::prefix('api')->group(function () {
        // Routes for users
        Route::get('/users', [ProfileController::class, 'index']);
        Route::get('/users/{id}', [ProfileController::class, 'show']);
        Route::post('/users', [ProfileController::class, 'store']);
        Route::put('/users/{id}', [ProfileController::class, 'update']);
        Route::delete('/users/{id}', [ProfileController::class, 'destroy']);

        // Routes for sensors
        Route::get('/sensors', [SensorController::class, 'index']);
        Route::get('/sensors/{id}', [SensorController::class, 'show']);
        Route::post('/sensors', [SensorController::class, 'store']);
        Route::put('/sensors/{id}', [SensorController::class, 'update']);
        Route::delete('/sensors/{id}', [SensorController::class, 'destroy']);

        // Routes for sensor readings
        Route::get('/sensor-readings', [SensorReadingController::class, 'index']);
        Route::get('/sensor-readings/{id}', [SensorReadingController::class, 'show']);
        Route::post('/sensor-readings', [SensorReadingController::class, 'store']);
        Route::put('/sensor-readings/{id}', [SensorReadingController::class, 'update']);
        Route::delete('/sensor-readings/{id}', [SensorReadingController::class, 'destroy']);

        // Routes for control devices
        Route::get('/control-devices', [ControlDeviceController::class, 'index']);
        Route::get('/control-devices/{id}', [ControlDeviceController::class, 'show']);
        Route::post('/control-devices', [ControlDeviceController::class, 'store']);
        Route::put('/control-devices/{id}', [ControlDeviceController::class, 'update']);
        Route::delete('/control-devices/{id}', [ControlDeviceController::class, 'destroy']);

        // Routes for control device statuses
        Route::get('/control-device-statuses', [ControlDeviceStatusController::class, 'index']);
        Route::get('/control-device-statuses/{id}', [ControlDeviceStatusController::class, 'show']);
        Route::post('/control-device-statuses', [ControlDeviceStatusController::class, 'store']);
        Route::put('/control-device-statuses/{id}', [ControlDeviceStatusController::class, 'update']);
        Route::delete('/control-device-statuses/{id}', [ControlDeviceStatusController::class, 'destroy']);

        // Routes for notifications
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::get('/notifications/{id}', [NotificationController::class, 'show']);
        Route::post('/notifications', [NotificationController::class, 'store']);
        Route::put('/notifications/{id}', [NotificationController::class, 'update']);
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);

        Route::get('/temperature-page', function () {
            return view('temperature');
        })->name('temperature.page');
        
        Route::get('/humidity-page', function () {
            return view('humidity');
        })->name('humidity.page');
        
        Route::get('/gas-page', function () {
            return view('gas');
        })->name('gas.page');
        
        Route::get('/motion-page', function () {
            return view('motion');
        })->name('motion.page');
        
        Route::get('/rainfall-page', function () {
            return view('rainfall');
        })->name('rainfall.page');
    });
});

require __DIR__.'/auth.php';
