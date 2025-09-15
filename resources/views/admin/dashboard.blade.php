@extends('layouts.admin')

@section('content')
@if(session('success'))
<div id="toastSuccess" class="toast-slide-in toast-success position-fixed top-0 end-0 m-3" style="z-index:1055;">
    ✅ {{ session('success') }}
    <button type="button" class="btn-close float-end" aria-label="Close" onclick="hideToast('toastSuccess')"></button>
</div>
@endif

@if(session('error'))
<div id="toastError" class="toast-slide-in toast-error position-fixed top-0 end-0 m-3" style="z-index:1055;">
    ❌ {{ session('error') }}
    <button type="button" class="btn-close float-end" aria-label="Close" onclick="hideToast('toastError')"></button>
</div>
@endif

<style>
    .toast-slide-in,
    .toast-slide-out {
        color: #fff;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        min-width: 250px;
        max-width: 350px;
        font-weight: 500;
    }

    .toast-success {
        background-color: #28a745 !important;
    }

    .toast-error {
        background-color: #dc3545 !important;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(120%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(120%);
            opacity: 0;
        }
    }

    .toast-slide-in {
        animation: slideInRight 0.5s forwards;
    }

    .toast-slide-out {
        animation: slideOutRight 0.5s forwards;
    }

    .btn-close {
        filter: brightness(0) invert(1);
    }
</style>

<script>
    function hideToast(id) {
    const toast = document.getElementById(id);
    toast.classList.remove('toast-slide-in');
    toast.classList.add('toast-slide-out');
    setTimeout(() => toast.remove(), 500); // remove after animation
}

// Auto-hide after 3 seconds
document.addEventListener("DOMContentLoaded", function () {
    const success = document.getElementById('toastSuccess');
    const error = document.getElementById('toastError');
    if(success) setTimeout(() => hideToast('toastSuccess'), 3000);
    if(error) setTimeout(() => hideToast('toastError'), 3000);
});
</script>
<div class="container">
    <h2>Admin Dashboard</h2>
    <a href=" route('admin.create') }}" class="btn btn-primary mb-3">+ Add News</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>
                    <a href=" {{route('admin.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action=" {{route('admin.delete', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this news?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection