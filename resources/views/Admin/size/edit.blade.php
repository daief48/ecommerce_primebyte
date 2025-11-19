@extends('Admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Size</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Edit Size Form -->
    <div class="card">
        <div class="card-header">Edit Size</div>
        <div class="card-body">
            <form action="{{ route('sizes.update', $size->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Size Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $size->name) }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update Size</button>
                <a href="{{ route('sizes.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
