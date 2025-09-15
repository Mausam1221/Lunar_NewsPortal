<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <a href=" {{route('admin.dashboard') }}">Dashboard</a>
        <a href=" {{route('admin.create') }}">Add News</a>
        <a href=" {{route('categories.index') }}">Add Category</a>
        <a href=" {{route('admin.users.index') }}">Users</a>
        <a href="#">Settings</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>