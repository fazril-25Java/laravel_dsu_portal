<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\File;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('admin.devices.index', compact('devices'));
    }

    public function create()
    {
        return view('admin.devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'status' => 'required|string|in:active,inactive',
        ]);

        $filename = null;

        if ($request->has('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/devices/';
            $file->move($path, $filename);
        }

        Device::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $filename ? $path . $filename : null,
        ]);

        return redirect()->route('admin.devices.create')->with('success', 'Device created successfully.');
    }


    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('admin.devices.edit', compact('device'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'status' => 'required|string|in:active,inactive',
        ]);

        $device = Device::findOrFail($id);

        if ($request->has('image')) {
            if (File::exists($device->image)) {
                File::delete($device->image);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/devices/';
            $file->move($path, $filename);

            $device->update([
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $path . $filename,
            ]);
        } else {
            $device->update($request->only(['name', 'type', 'description', 'status']));
        }

        return redirect()->route('admin.devices.index')->with('success', 'Device updated successfully.');
    }

    public function deactivate($id)
    {
        $device = Device::findOrFail($id);
        $device->update(['status' => 'inactive']);
        return redirect()->route('admin.devices.index')->with('success', 'Device deactivated successfully.');
    }
}
