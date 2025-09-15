@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit News</h2>

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

    <form action="{{ route('admin.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Use PUT method --}}
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $news->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content', $news->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="categories_id" class="form-select">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $news->categories_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Show existing image --}}
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($news->image)
            <img src="{{ asset($news->image) }}" alt="News Image" width="150" class="mb-2 rounded">
            @else
            <p>No image uploaded.</p>
            @endif
        </div>

        {{-- Upload new image --}}
        <div class="mb-3">
            <label class="form-label">Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update News</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection