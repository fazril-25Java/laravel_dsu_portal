<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the devices.
     */
    public function index()
    {
        $devices = Device::all();
        return view('admin.devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new device.
     */
    public function create()
    {
        return view('admin.devices.create');
    }

    /**
     * Store a newly created device in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        'status' => 'required|string|in:active,inactive',
    ]);

    if ($request->hasFile('image')) {
        // Store the image in the 'public/images' directory and get the path
        $imagePath = $request->file('image')->store('images', 'public');
        $validated['image'] = $imagePath; // Save the path to the database
    }

    Device::create($validated); // Save the device with the image path

    return redirect()->route('admin.devices.index')->with('success', 'Device created successfully.');
}

    /**
     * Display the specified device.
     */
    public function show(Device $device)
    {
        return view('admin.devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified device.
     */
    public function edit(Device $device)
    {
        return view('admin.devices.edit', compact('device'));
    }

    /**
     * Update the specified device in storage.
     */
    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'status' => 'required|string|in:active,inactive',
        ]);

        $device->update($validated);

        return redirect()->route('admin.devices.index')->with('success', 'Device updated successfully.');
    }

    /**
     * Remove the specified device from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('admin.devices.index')->with('success', 'Device deleted successfully.');
    }
}
