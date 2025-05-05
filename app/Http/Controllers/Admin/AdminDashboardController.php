<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Booking;
use App\Models\User; // Import the User model

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalDevices = Device::count(); // Count total devices
        $pendingBookings = Booking::where('status', 'pending')->count(); // Count pending bookings
        $recentBookings = Booking::with(['user', 'device'])->latest()->take(5)->get(); // Fetch recent bookings
        $totalUsers = User::count(); // Count total users

        return view('admin.dashboard', compact('totalDevices', 'pendingBookings', 'recentBookings', 'totalUsers'));
    }
}