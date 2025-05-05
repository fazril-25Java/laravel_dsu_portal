<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device; // Assuming you have a Device model

class DeviceController extends Controller
{
    public function index()
    {
        // Fetch all devices from the database
        $devices = Device::all();

        // Return the devices to a view
        return view('user.devices.index', compact('devices'));
    }

    public function show($id)
    {
        // Fetch a single device by its ID
        $device = Device::find($id);

        if (!$device) {
            return redirect()->route('user.devices.index')->with('error', 'Device not found');
        }

        // Return the device details to a view
        return view('user.devices.show', compact('device'));
    }
}
