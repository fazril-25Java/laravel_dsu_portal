@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Your Bookings</h1>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($bookings->isEmpty())
        <p class="text-center">You have no bookings yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Device</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->device->name }}</td>
                        <td>{{ $booking->start_date->format('Y-m-d') }}</td>
                        <td>{{ $booking->end_date->format('Y-m-d') }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td>
                            @if ($booking->status !== 'returned')
                                <form action="{{ route('user.bookings.return', $booking->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">Return Device</button>
                                </form>
                            @else
                                <span class="text-success">Returned</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection