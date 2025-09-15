<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NewsPortal') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background-color: #212529;
            color: #fff;
            padding: 15px 10px;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
        }

        .toggle-btn:hover {
            background-color: #495057;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            color: #adb5bd;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-links a:hover {
            background-color: #495057;
            color: #fff;
        }

        .nav-links i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .sidebar.collapsed .link-text {
            display: none;
        }

        .sidebar.collapsed .nav-links i {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }

        .sidebar.collapsed .brand {
            display: none;
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }

        /* Main content */
        #app {
            margin-left: 220px;
            transition: margin-left 0.3s ease;
        }

        #app.sidebar-collapsed {
            margin-left: 70px;
        }

        #app.no-sidebar {
            margin-left: 0px;
        }
    </style>
</head>

<body>
    @include('partials.header')

    <div id="app" class="{{ Auth::check() ? '' : 'no-sidebar' }}">
        @if(Auth::check())
            <div id="sidebar" class="sidebar">
                <div class="sidebar-header">
                    <span class="brand">NewsPortal</span>
                    <button id="toggle-btn" class="toggle-btn">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <ul class="nav-links">
                    <li><a href="#"><i class="bi bi-house"></i><span class="link-text">Dashboard</span></a></li>
                    <li><a href="#"><i class="bi bi-box"></i><span class="link-text">Products</span></a></li>
                    <li><a href="#"><i class="bi bi-gear"></i><span class="link-text">Settings</span></a></li>
                </ul>
            </div>
        @endif

        <main class="py-4 main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

        @include('partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggle-btn');
            const sidebar = document.getElementById('sidebar');
            const app = document.getElementById('app');

            if (toggleBtn && sidebar && app) {
                // Load state from localStorage
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (isCollapsed) {
                    sidebar.classList.add('collapsed');
                    app.classList.add('sidebar-collapsed');
                }

                // Toggle sidebar
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('collapsed');
                    app.classList.toggle('sidebar-collapsed');

                    // Save state
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }
        });
    </script>
</body>
</html>