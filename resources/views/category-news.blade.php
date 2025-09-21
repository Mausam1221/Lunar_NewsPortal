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

    .breadcrumb {
        background: transparent;
        padding: 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
</style>

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="home-hero text-center mb-5">
        <h2>{{ $category->name }} News 📰</h2>
        <p class="lead">All news articles in the {{ $category->name }} category.</p>
    </div>

    <!-- News Section -->
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-3">{{ $category->name }} Articles ({{ $news->count() }})</h3>

            @forelse ($news as $article)
            <div class="card mb-3">
                @if ($article->image)
                <img src="{{ asset($article->image) }}" class="card-img-top" alt="{{ $article->title }}"
                    style="max-height: 300px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($article->content, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('news.show', $article->id) }}" class="btn btn-primary btn-sm">Read More</a>
                        <small class="text-muted">{{ $article->created_at->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                <h4>No articles found</h4>
                <p>There are currently no published articles in the {{ $category->name }} category.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
            </div>
            @endforelse
        </div>

        <!-- Sidebar Widgets -->
        <div class="col-md-4">
            <h3 class="mb-3">All Categories</h3>
            <ul class="list-group mb-4">
                @foreach ($categories as $cat)
                <li class="list-group-item {{ $cat->id == $category->id ? 'active' : '' }}">
                    <a href="{{ route('category.show', $cat->id) }}" 
                       class="{{ $cat->id == $category->id ? 'text-white' : '' }}">
                        {{ $cat->name }}
                    </a>
                </li>
                @endforeach
            </ul>

            <h3 class="mb-3">Quick Links</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('home') }}">All News</a></li>
                <li class="list-group-item"><a href="#">Trending</a></li>
                <li class="list-group-item"><a href="#">Popular</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
