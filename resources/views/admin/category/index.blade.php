@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Categories</h2>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Category Button --}}
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">
        Add Category
    </a>

    {{-- Category Table --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                {{-- <td>{{ $category->id }}</td> --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at->format('d M, Y') }}</td>
                <td>
                    <a href=" {{route('admin.category.edit', $category->id) }}"
                        class="btn btn-warning btn-sm">Edit</a>

                    <form action=" {{route('admin.category.destroy', $category->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this category?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection