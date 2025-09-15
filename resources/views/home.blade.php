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
    <div class="home-hero text-center mb-5">
        <h2>Welcome to NewsPortal 📰</h2>
        <p class="lead">Your trusted source for the latest news and updates.</p>
    </div>

    <!-- Featured News Section -->
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-3">Latest News</h3>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Breaking News Title</h5>
                    <p class="card-text">Short description of the news goes here...</p>
                    <a href="#" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Another News Title</h5>
                    <p class="card-text">Some quick preview text for the second news...</p>
                    <a href="#" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div class="col-md-4">
            <h3 class="mb-3">Categories</h3>
            <ul class="list-group mb-4">
                <li class="list-group-item"><a href="#">Politics</a></li>
                <li class="list-group-item"><a href="#">Sports</a></li>
                <li class="list-group-item"><a href="#">Technology</a></li>
                <li class="list-group-item"><a href="#">Entertainment</a></li>
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