@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Add News</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>❌ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter news title">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" placeholder="Enter news content">{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="draft" {{ old('status')=='draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status')=='published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="categories_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                     <option value="{{ $category->id }}" {{ old('categories_id')==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Create News</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection