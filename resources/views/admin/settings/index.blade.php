@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Settings</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Site Name</label>
            <input type="text" name="site_name" value="{{ $setting->site_name ?? '' }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ $setting->email ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ $setting->phone ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" value="{{ $setting->address ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label><br>
            @if(!empty($setting->logo))
            <img src="{{ asset('uploads/logo/' . $setting->logo) }}" alt="Logo" width="120" class="mb-2">
            @endif
            <input type="file" name="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection