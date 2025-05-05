@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Book a Device</h1>
    <form action="{{ route('user.bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="device_id">Select Device</label>
            <select name="device_id" id="device_id" class="form-control" required>
                <option value="">-- Select a Device --</option>
                @foreach ($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required min="{{ date('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="duration">Duration (Days)</label>
            <select name="duration" id="duration" class="form-control" required>
                <option value="7">7 Days</option>
                <option value="14">14 Days</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Book Device</button>
    </form>
</div>

<script>
    // Example: Disable the submit button if no device is selected
    const deviceSelect = document.getElementById('device_id');
    const submitButton = document.querySelector('button[type="submit"]');

    deviceSelect.addEventListener('change', function () {
        if (deviceSelect.value === '') {
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;
        }
    });

    // Initially disable the button
    submitButton.disabled = deviceSelect.value === '';
</script>
@endsection