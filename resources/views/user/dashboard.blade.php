<!-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\user\dashboard.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container">
    <h1 class="mb-4">Welcome to Your Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">View Devices</h5>
                    <p class="card-text">Browse and book available devices.</p>
                    <a href="{{ route('user.devices.index') }}" class="btn btn-primary">Go to Devices</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Your Profile</h5>
                    <p class="card-text">View and update your profile information.</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-secondary">Go to Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Your Bookings</h5>
                    <p class="card-text">Manage your current and past bookings.</p>
                    <a href="{{ route('user.bookings.index') }}" class="btn btn-success">Go to Booking List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection