<header class="bg-dark text-white p-3 shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo + Site Name -->
        <div class="d-flex align-items-center">
            @if(!empty($globalSetting->logo))
            <img src="{{ asset('uploads/logo/' . $globalSetting->logo) }}" alt="Logo" class="me-2"
                style="max-height: 40px; width: auto;">
            @endif
            <h1 class="h5 m-0">{{ $globalSetting->site_name }}</h1>
        </div>

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
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-white">Logout</button>
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>