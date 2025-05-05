{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\bookings\show.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Booking Details</h1>
        <div class="card mt-4">
            <div class="card-header">
                Booking #{{ $booking->id }}
            </div>
            <div class="card-body">
                <p><strong>Device:</strong> {{ $booking->device->name }}</p>
                <p><strong>User:</strong> {{ $booking->user->name }}</p>
                <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                <p><strong>Return Date:</strong> {{ $booking->return_date ?? 'Not returned yet' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
            </div>
        </div>

        @if ($booking->status === 'approved')
            <form action="{{ route('admin.bookings.return', $booking->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-warning">Mark as Returned</button>
            </form>
        @endif

        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-3">Back to Bookings</a>
    </div>
@endsection