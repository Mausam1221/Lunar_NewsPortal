@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Add Category</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action=" {{route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
</div>
@endsection