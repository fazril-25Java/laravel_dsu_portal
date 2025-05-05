<!-- filepath: resources/views/user/devices/index.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Devices</h1>
    <div class="row">
        @if ($devices->isEmpty())
            <div class="col-12">
                <p class="text-center">There's no devices available at the moment.</p>
            </div>
        @else
            @foreach ($devices as $device)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($device->image)
                            <img src="{{ asset('storage/' . $device->image) }}" class="card-img-top" alt="{{ $device->name }}">
                        @else
                            <img src="{{ asset('assets/images/Portrait_Placeholder.png') }}" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $device->name }}</h5>
                            <p class="card-text">{{ Str::limit($device->description, 100) }}</p>
                            <p class="card-text"><strong>Type:</strong> {{ $device->type }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ ucfirst($device->status) }}</p>
                            <a href="{{ route('user.devices.show', $device->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection