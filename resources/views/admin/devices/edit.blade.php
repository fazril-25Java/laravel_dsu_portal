{{-- filepath: c:\Users\Fazril\OneDrive\Desktop\fyp\resources\views\admin\devices\edit.blade.php --}}
@extends('layouts.admin') {{-- Extend your admin layout --}}

@section('content')
<div class="container mt-4">
    <h1>Edit Device</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.devices.update', $device->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Use PUT method for updating --}}
                
                {{-- Device Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Device Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $device->name) }}" required>
                </div>

                {{-- Device Type --}}
                <div class="mb-3">
                    <label for="type" class="form-label">Device Type</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $device->type) }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $device->description) }}</textarea>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="available" {{ $device->status === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="booked" {{ $device->status === 'booked' ? 'selected' : '' }}>Booked</option>
                        <option value="inactive" {{ $device->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Images --}}
                <div class="mb-3">
                    <label for="images" class="form-label">Device Images</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="text-muted">Leave blank if you don't want to update images.</small>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Update Device</button>
                <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection