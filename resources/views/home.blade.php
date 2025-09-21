@extends('layouts.app')

<style>
    /* Hero / Welcome Section */
    .home-hero {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        padding: 60px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .home-hero h2 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .home-hero p {
        font-size: 1.2rem;
    }

    /* News Cards */
    .card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Sidebar Lists */
    .list-group-item {
        transition: background 0.2s;
    }

    .list-group-item:hover {
        background: #f0f0f0;
    }
</style>

@section('content')
<div class="container">
    <!-- Hero Section -->
    {{-- <div class="home-hero text-center mb-5">
        <h2>Welcome to NewsPortal 📰</h2>
        <p class="lead">Your trusted source for the latest news and updates.</p>
    </div> --}}
    <div class="home-hero text-center mb-5">
        <h2>Welcome to {{ $globalSetting->site_name ?? 'NewsPortal' }} 📰</h2>
        <p class="lead">Your trusted source for the latest news and updates.</p>
    </div>

    <!-- Featured News Section -->
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-3">Latest News</h3>

@forelse ($latestNews as $news)
<div class="card mb-3">
    @if ($news->image)
    <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}"
        style="max-height: 300px; object-fit: cover;">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $news->title }}</h5>
        <p class="card-text">{{ \Illuminate\Support\Str::limit($news->content, 100) }}</p>
        <a href="{{ route('news.show', $news->id) }}" class="btn btn-primary btn-sm">Read More</a>
    </div>
</div>
@empty
<p>No published news available.</p>
@endforelse
        </div>

        <!-- Sidebar Widgets -->
        <div class="col-md-4">
            <h3 class="mb-3">Categories</h3>
            <ul class="list-group mb-4">
                @foreach ($categories as $category)
                <li class="list-group-item">
                    <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>

            <h3 class="mb-3">Trending</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Top Story 1</a></li>
                <li class="list-group-item"><a href="#">Top Story 2</a></li>
                <li class="list-group-item"><a href="#">Top Story 3</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection