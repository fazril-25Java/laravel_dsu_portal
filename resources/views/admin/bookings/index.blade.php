{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\bookings\index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Bookings</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Device</th>
                    <th>User</th>
                    <th>Booking Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->device->name }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->return_date ?? 'Not returned yet' }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td>
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                            @if ($booking->status === 'booked')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @elseif ($booking->status === 'approved')
                                <form action="{{ route('admin.bookings.return', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">Mark as Returned</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection