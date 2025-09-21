<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #343a40;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h4 {
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: #ddd;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar a.active {
            background: #007bff;
            color: #fff;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.create') }}" class="{{ request()->routeIs('admin.create') ? 'active' : '' }}">Add News</a>
        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">Add Category</a>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">Users</a>
        <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">Settings</a>
        <a href="{{ route('logout') }}" class="{{ request()->routeIs('logout') ? 'active' : '' }}">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>