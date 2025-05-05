<!-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\user\bookings\show.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Booking Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Device: {{ $booking->device->name }}</h5>
            <p class="card-text"><strong>Start Date:</strong> {{ $booking->start_date->format('Y-m-d') }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $booking->end_date->format('Y-m-d') }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $booking->device->description }}</p>
        </div>
    </div>
    <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary mt-3">Back to Bookings</a>

    @if ($booking->status !== 'returned')
        <form action="{{ route('user.bookings.return', $booking->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger">Return Device</button>
        </form>
    @endif
</div>
@endsection