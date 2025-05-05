<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; // Assuming you have a Booking model
use App\Models\Device;  // Assuming you have a Device model
use Carbon\Carbon; // Import Carbon for date manipulation

class BookingController extends Controller
{

    
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('device')->get();
        return view('user.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $devices = Device::all();
        return view('user.bookings.create', compact('devices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'start_date' => 'required|date|after_or_equal:today',
            'duration' => 'required|in:7,14',
        ]);
    
        $validated['user_id'] = auth()->id(); // Add the authenticated user's ID
        $validated['end_date'] = Carbon::parse($validated['start_date'])->addDays((int) $validated['duration']); // Calculate end date
        $validated['booking_date'] = Carbon::now(); // Set the booking date to the current date and time
    
        Booking::create($validated); // Save the booking
    
        return redirect()->route('user.bookings.index')->with('success', 'Your booking has been successfully created!');
    }
    
    public function show(Booking $booking)
    {
        return view('user.bookings.show', compact('booking'));
    }


    public function returnDevice(Request $request, Booking $booking)
    {
        // Check if the authenticated user owns the booking
        if ($booking->user_id !== auth()->id()) {
            return redirect()->route('user.bookings.index')->with('error', 'You are not authorized to return this device.');
        }
    
        // Update the booking status to 'returned'
        $booking->update([
            'status' => 'returned',
        ]);
    
        return redirect()->route('user.bookings.index')->with('success', 'Device returned successfully.');
    }


    
}
