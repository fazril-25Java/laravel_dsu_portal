{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\devices\create.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Device</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.devices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Device Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Device Type</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Device Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Device</button>
            <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection