@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        @if ($news->image)
        <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}"
            style="max-height: 400px; object-fit: cover;">
        @endif
        <div class="card-body">
            <h2 class="card-title">{{ $news->title }}</h2>
            <p class="text-muted">
                Published by <strong>{{ $news->user->name ?? 'Unknown' }}</strong>
                on {{ $news->created_at->format('F j, Y') }}
            </p>
            <hr>
            <p class="card-text" style="white-space: pre-line;">{{ $news->content }}</p>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">← Back</a>
        </div>
    </div>
</div>
@endsection