@extends('Admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manage Sizes</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Create Size Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Size</div>
        <div class="card-body">
            <form action="{{ route('sizes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Size Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Size</button>
            </form>
        </div>
    </div>

    <!-- List of Sizes -->
    <div class="card">
        <div class="card-header">Size List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Size Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sizes as $size)
                    <tr>
                        <td>{{ $size->id }}</td>
                        <td>{{ $size->name }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('sizes.destroy', $size->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No sizes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
