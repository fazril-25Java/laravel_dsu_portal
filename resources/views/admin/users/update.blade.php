<!-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\users\update.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Update User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection