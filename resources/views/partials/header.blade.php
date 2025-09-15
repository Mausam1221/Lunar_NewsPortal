<header class="bg-dark text-white p-3 shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo / Site Name -->
        <h1 class="h4 m-0">NewsPortal</h1>

        <!-- Navigation -->
        <nav>
            <ul class="nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('logout') }}">Logout</a>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>