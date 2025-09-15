@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Category</h2>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action=" {{route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- important for updating --}}

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}"
                required>
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href=" route('admin.category.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection