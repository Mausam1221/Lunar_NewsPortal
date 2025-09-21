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

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card.published {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-card.draft {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .stat-card.categories {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #333;
    }

    .stat-card.users {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #333;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-published {
        background-color: #d4edda;
        color: #155724;
    }

    .status-draft {
        background-color: #fff3cd;
        color: #856404;
    }

    .quick-actions {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .recent-activity {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .news-table {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .table th {
        border: none;
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }

    .table td {
        border: none;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .search-filter {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .btn-action {
        padding: 0.25rem 0.5rem;
        margin: 0 0.1rem;
        font-size: 0.75rem;
    }
</style>

<script>
    function hideToast(id) {
        const toast = document.getElementById(id);
        toast.classList.remove('toast-slide-in');
        toast.classList.add('toast-slide-out');
        setTimeout(() => toast.remove(), 500);
    }

    function toggleStatus(id) {
        if (confirm('Are you sure you want to change the status of this news?')) {
            const url = `/toggle-status/${id}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            console.log('Making request to:', url);
            console.log('CSRF Token:', csrfToken);
            
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Unknown error occurred'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the status: ' + error.message);
            });
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const success = document.getElementById('toastSuccess');
        const error = document.getElementById('toastError');
        if(success) setTimeout(() => hideToast('toastSuccess'), 3000);
        if(error) setTimeout(() => hideToast('toastError'), 3000);
        
        // Add enter key support for search
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        }
    });
</script>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add News
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_news'] }}</div>
                <div class="stat-label">Total News</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card published">
                <div class="stat-number">{{ $stats['published_news'] }}</div>
                <div class="stat-label">Published</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card draft">
                <div class="stat-number">{{ $stats['draft_news'] }}</div>
                <div class="stat-label">Draft</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card categories">
                <div class="stat-number">{{ $stats['total_categories'] }}</div>
                <div class="stat-label">Categories</div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card users">
                <div class="stat-number">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="stat-number">{{ $stats['admin_users'] }}</div>
                <div class="stat-label">Admin Users</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-4 mb-4">
            <div class="quick-actions">
                <h5 class="mb-3">Quick Actions</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New News
                    </a>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-success">
                        <i class="fas fa-tags"></i> Add Category
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-info">
                        <i class="fas fa-users"></i> Manage Users
                    </a>
                    <a href="{{ route('admin.settings') }}" class="btn btn-warning">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h5 class="mb-3">Recent News</h5>
                @foreach($recent_news as $recent)
                <div class="d-flex align-items-center mb-3 p-2 border rounded">
                    <div class="flex-grow-1">
                        <h6 class="mb-1">{{ Str::limit($recent->title, 30) }}</h6>
                        <small class="text-muted">
                            {{ $recent->category->name ?? 'No Category' }} • 
                            {{ $recent->created_at->diffForHumans() }}
                        </small>
                    </div>
                    <span class="status-badge status-{{ $recent->status }}">
                        {{ $recent->status }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- News Table -->
        <div class="col-lg-8">
            <div class="news-table">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">All News</h5>
                    <div class="search-filter">
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control form-control-sm" 
                                   placeholder="Search news..." value="{{ request('search') }}">
                            <select name="status" class="form-select form-select-sm">
                                <option value="">All Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Filter</button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($news as $item)
                            <tr>
                                <td>
                                    <div>
                                        <strong>{{ Str::limit($item->title, 40) }}</strong>
                                        {{-- @if($item->image)
                                            <i class="fas fa-image text-muted ms-1" title="Has Image"></i>
                                        @endif --}}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $item->category->name ?? 'No Category' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $item->status }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>{{ $item->user->name ?? 'Unknown' }}</td>
                                <td>{{ $item->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.edit', $item->id) }}" 
                                           class="btn btn-sm btn-outline-warning btn-action" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="toggleStatus({{ $item->id }})" 
                                                class="btn btn-sm btn-outline-{{ $item->status === 'published' ? 'secondary' : 'success' }} btn-action" 
                                                title="Toggle Status">
                                            <i class="fas fa-{{ $item->status === 'published' ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                        <form action="{{ route('admin.delete', $item->id) }}" method="POST" 
                                              style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this news?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-action" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-newspaper fa-3x mb-3"></i>
                                    <p>No news found. <a href="{{ route('admin.create') }}">Create your first news!</a></p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($news->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $news->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection