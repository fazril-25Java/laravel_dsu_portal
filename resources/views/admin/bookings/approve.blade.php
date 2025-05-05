{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\bookings\approve.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Approve Booking</h1>
        <div class="card mt-4">
            <div class="card-header">
                Confirm Approval for Booking #{{ $booking->id }}
            </div>
            <div class="card-body">
                <p><strong>Device:</strong> {{ $booking->device->name }}</p>
                <p><strong>User:</strong> {{ $booking->user->name }}</p>
                <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                <p><strong>Return Date:</strong> {{ $booking->return_date ?? 'Not returned yet' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
            </div>
        </div>

        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <p>Are you sure you want to approve this booking?</p>
            <button type="submit" class="btn btn-success">Yes, Approve</button>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection