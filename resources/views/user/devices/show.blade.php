<!-- filepath: resources/views/user/devices/show.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container">
    <h1>{{ $device->name }}</h1>
    <p><strong>Type:</strong> {{ $device->type }}</p>
    <p><strong>Status:</strong> {{ ucfirst($device->status) }}</p>
    <p><strong>Description:</strong> {{ $device->description }}</p>
    
    <a href="{{ route('user.devices.index') }}" class="btn btn-secondary">Back to Devices</a>

    @if ($device->status === 'active')
        <a href="{{ route('user.bookings.create', ['device_id' => $device->id]) }}" class="btn btn-primary">Book This Device</a>
    @else
        <button class="btn btn-secondary" disabled>Device Unavailable</button>
    @endif
</div>
@endsection