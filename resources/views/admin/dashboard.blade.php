<!-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Admin Dashboard</h1>
    <div class="row mt-4">
        <!-- Total Devices Card -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Devices</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalDevices }}</h5>
                    <p class="card-text">Manage all devices in the system.</p>
                    <a href="{{ route('admin.devices.index') }}" class="btn btn-light">View Devices</a>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                    <p class="card-text">Manage all users in the system.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">View Users</a>
                </div>
            </div>
        </div>

        <!-- Pending Bookings Card -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pending Bookings</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $pendingBookings }}</h5>
                    <p class="card-text">Review and approve pending bookings.</p>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-light">View Bookings</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="mt-5">
        <h2>Recent Bookings</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Device</th>
                    <th>Status</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentBookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->device->name }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection