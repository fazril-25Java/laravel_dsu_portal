<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Device;
use App\Models\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['device', 'user'])->get(); // Eager load device and user relationships
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the approval confirmation page for a booking.
     */
    public function showApprove($id)
    {
        $booking = Booking::with(['device', 'user'])->findOrFail($id);
        return view('admin.bookings.approve', compact('booking'));
    }

    /**
     * Approve a booking.
     */
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking approved successfully.');
    }

    /**
     * Mark a booking as returned.
     */
    public function returnBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'returned';
        $booking->return_date = now(); // Set the return date to the current date
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking marked as returned successfully.');
    }

    public function showReturn($id)
    {
        $booking = Booking::with(['device', 'user'])->findOrFail($id);
        return view('admin.bookings.return', compact('booking'));
    }
    /**
     * Show the form for creating a new booking.
     */
}
