<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device; // Import the Device model

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::active()->get(); // Fetch only active devices using the scope
        return response()->json($devices); // Return as JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'status' => 'required|string|in:available,booked,active,inactive',
        ]);

        $device = Device::create($validated); // Create a new device

        return response()->json($device, 201); // Return the created device with a 201 status
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $device = Device::find($id); // Find the device by ID

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404); // Return 404 if not found
        }

        return response()->json($device); // Return the device as JSON
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $device = Device::find($id); // Find the device by ID

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404); // Return 404 if not found
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'status' => 'sometimes|string|in:available,booked,active,inactive',
        ]);

        $device->update($validated); // Update the device

        return response()->json($device); // Return the updated device
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $device = Device::find($id); // Find the device by ID

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404); // Return 404 if not found
        }

        $device->delete(); // Delete the device

        return response()->json(['message' => 'Device deleted successfully']); // Return success message
    }
}
