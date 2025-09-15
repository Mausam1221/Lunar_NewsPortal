@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Add New Category</h2>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Category Form --}}
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter category name" value="{{ old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save Category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection