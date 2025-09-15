@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>

    {{-- Success Message --}}
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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="is_admin" class="form-select">
                <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection