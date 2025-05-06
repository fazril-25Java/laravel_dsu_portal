{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\devices\show.blade.php --}}
@extends('layouts.admin') {{-- Extend your admin layout --}}

@section('content')
<div class="container mt-4">
    <h1>Device Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $device->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Type:</strong> {{ $device->type }}</p>
            <p><strong>Description:</strong> {{ $device->description }}</p>
            <p><strong>Status:</strong> 
                @if ($device->status === 'available')
                    <span class="badge bg-success">Available</span>
                @elseif ($device->status === 'booked')
                    <span class="badge bg-warning">Booked</span>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($device->status) }}</span>
                @endif
            </p>
            <p><strong>Images:</strong></p>
            <div class="row">
                @foreach ($device->images as $image)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $image) }}" alt="Device Image" class="img-fluid rounded">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.devices.index') }}" class="btn btn-primary">Back to Devices</a>
        </div>
    </div>
</div>
@endsection