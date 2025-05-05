{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\devices\index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1>Devices</h1>
    <a href="{{ route('admin.devices.create') }}" class="btn btn-primary">Add Device</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
                <tr>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->type }}</td>
                    <td>{{ $device->status }}</td>
                    <td>
                        <a href="{{ route('admin.devices.show', $device) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.devices.edit', $device) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.devices.destroy', $device) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection