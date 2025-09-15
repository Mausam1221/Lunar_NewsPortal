@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Manage Users</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user) 
            <tr>
<td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty($user)
                
            <tr>
                <td colspan="5" class="text-center">No users found</td>
            </tr>
            @endempty
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection