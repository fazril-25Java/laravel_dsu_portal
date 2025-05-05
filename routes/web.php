<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DeviceController as AdminDeviceController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\DeviceController as UserDeviceController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\UserController as UserProfileController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Welcome Page
Route::view('/', 'welcome')->name('welcome');

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

// Authenticated User & Admin Routes
Route::middleware('auth')->group(function () {

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Admin Resource Routes
        Route::resource('devices', AdminDeviceController::class);
        Route::resource('bookings', AdminBookingController::class);
        Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show']);

        // Booking Custom Routes
        Route::get('bookings/{id}/approve', [AdminBookingController::class, 'showApprove'])->name('bookings.showApprove');
        Route::put('bookings/{id}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
        Route::get('bookings/{id}/return', [AdminBookingController::class, 'showReturn'])->name('bookings.showReturn');
        Route::put('bookings/{id}/return', [AdminBookingController::class, 'returnBooking'])->name('bookings.return');
    });

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        // User Dashboard
        Route::view('/dashboard', 'user.dashboard')->name('dashboard');

        // User Profile
        Route::get('/profile', [UserProfileController::class, 'profile'])->name('profile');

        // User Device Routes
        Route::controller(UserDeviceController::class)->prefix('devices')->name('devices.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
        });

        // User Booking Routes
        Route::controller(UserBookingController::class)->prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::put('/{booking}/return', 'returnDevice')->name('return');
        });
    });
});
