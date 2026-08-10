<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">HardwareHub</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            @guest
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            @endguest
        </ul>

        <div class="d-flex align-items-center gap-3">
            <form class="d-flex" role="search" action="{{ route('products.index') }}" method="GET">
            <div class="input-group">
                <input class="form-control custom-search-input rounded-start-2 py-1 px-3" type="search" name="search" value="{{ request('search') }}" placeholder="What are you looking for?">
                <button class="btn custom-search-btn rounded-end-2 px-3" type="submit">
                <i class="bi bi-search"></i>
                </button>
            </div>
            </form>

            <a href="#" class="navbar-icon-btn ms-2 position-relative">
            <i class="bi bi-heart fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle badge-wishlist">{{-- Put the number here --}}</span>
            </a>

            <a href="#" class="navbar-icon-btn ms-2"><i class="bi bi-cart3 fs-5"></i></a>
            <a href="#" class="navbar-icon-btn ms-2"><i class="bi bi-person fs-5"></i></a>
        </div>

        </div>

    </div>
</nav>
