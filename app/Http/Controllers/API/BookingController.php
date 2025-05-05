<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Device;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('device', 'user')->get(); // Fetch all bookings with related data
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'return_date' => 'required|date|after:booking_date',
        ]);

        // Check if the device is available
        $device = Device::find($validated['device_id']);
        if ($device->status !== 'available') {
            return response()->json(['message' => 'Device is not available for booking'], 400);
        }

        // Create the booking
        $booking = Booking::create($validated);

        // Update the device status to 'booked'
        $device->update(['status' => 'booked']);

        return response()->json($booking, 201);
    }

    public function show(string $id)
    {
        $booking = Booking::with('device', 'user')->find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }

    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validated = $request->validate([
            'booking_date' => 'sometimes|date',
            'return_date' => 'sometimes|date|after:booking_date',
            'status' => 'sometimes|string|in:pending,approved,returned',
        ]);

        $booking->update($validated);

        return response()->json($booking);
    }

    public function destroy(string $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Update the device status to 'available'
        $booking->device->update(['status' => 'available']);

        $booking->delete();

        return response()->json(['message' => 'Booking canceled successfully']);
    }
}
