<!-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\user\profile.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container mt-4">
    <h1>User Profile</h1>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection