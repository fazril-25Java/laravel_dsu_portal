<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DeviceController;
use App\Http\Controllers\API\BookingController;

//Route::post('/login', [AuthController::class, 'login']);
//Route::apiResource('users', UserController::class);
//Route::post('/logout', [AuthController::class,'logout']);

Route::apiResource('devices', DeviceController::class);
Route::apiResource('bookings', BookingController::class);

Route::get('/devices', [DeviceController::class, 'index']); // Fetch available devices
Route::post('/book-device', [DeviceController::class, 'store']); // Book a device

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
