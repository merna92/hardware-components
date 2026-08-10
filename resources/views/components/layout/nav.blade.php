<nav class="navbar navbar-expand-lg custom-navbar bg-white border-bottom py-2 shadow-sm">
    <div class="container">

        <!-- Brand / Logo -->
        <a class="navbar-brand fw-bold fs-4 text-dark tracking-tight" href="/">Logo Or Title</a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Navigation Links (Active state controlled directly by Laravel Request) -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium gap-1" id="navLinksList">
                <li class="nav-item">
                    <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->is('/') ? 'active-link' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->is('contact*') ? 'active-link' : '' }}" href="/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->is('about*') ? 'active-link' : '' }}" href="/about">About</a>
                </li>
            </ul>

            <!-- Right Side Utilities -->
            <div class="d-flex align-items-center gap-3">
                
                <!-- Search Form -->
                <form class="d-flex" role="search">
                    <div class="input-group">
                        <input class="form-control custom-search-input rounded-start-3 py-1 px-3 fs-6 border-end-0" type="search" placeholder="What are you looking for?">
                        <button class="btn btn-outline-secondary rounded-end-3 px-3 border-start-0 bg-white" type="submit">
                            <i class="bi bi-search text-muted"></i>
                        </button>
                    </div>
                </form>

                <!-- Wishlist Icon with Tooltip & Hover -->
                <a href="/wishlist" 
                   class="navbar-icon-btn position-relative text-dark fs-5 p-2 rounded-circle hover-icon-box" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="bottom" 
                   title="Wishlist">
                    <i class="bi bi-heart"></i>
                </a>

                <!-- Cart Icon with Tooltip & Hover -->
                <a href="/cart" 
                   class="navbar-icon-btn position-relative text-dark fs-5 p-2 rounded-circle hover-icon-box" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="bottom" 
                   title="Shopping Cart">
                    <i class="bi bi-cart3"></i>
                </a>

                <!-- User Profile Icon / Avatar Header Link -->
            @auth
                <a href="{{ route('profile') }}" class="d-inline-flex align-items-center justify-content-center text-decoration-none">
                    @if(auth()->user()->avatar)
                        <!-- صُورة المستخدم المرفوعة -->
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                            alt="{{ auth()->user()->name }}" 
                            class="rounded-circle object-fit-cover border shadow-sm" 
                            style="width: 38px; height: 38px; border-color: #e2e8f0 !important;">
                    @else
                        <!-- الأيقونة الافتراضية لو لسه مرفعش صورة -->
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-dark border" 
                            style="width: 38px; height: 38px;">
                            <i class="bi bi-person fs-5"></i>
                        </div>
                    @endif
                </a>
            @else
                <!-- لو مش مسجل دخول يروح لصفحة الـ Login -->
                <a href="{{ route('login') }}" class="text-dark text-decoration-none d-inline-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 38px; height: 38px;">
                    <i class="bi bi-person fs-5"></i>
                </a>
            @endauth

            </div>

        </div>

    </div>
</nav>

<!-- Custom CSS for Active Page Line & Micro-interactions -->
<style>
    /* Base Nav Link Styles */
    .custom-nav-link {
        transition: color 0.2s ease-in-out;
        border: none !important;
        text-decoration: none !important;
    }
    
    /* Line Element Placeholder */
    .custom-nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2.5px;
        background-color: #0f172a;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Active Page ONLY - Show the Line Permanently */
    .custom-nav-link.active-link {
        color: #0f172a !important;
        font-weight: 700 !important;
    }
    .custom-nav-link.active-link::after {
        width: 70% !important; /* Shows ONLY on the currently active page */
    }

    /* Icon Micro-interactions */
    .hover-icon-box {
        transition: all 0.25s ease-in-out;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .hover-icon-box:hover {
        background-color: #f8f9fa;
        transform: translateY(-3px) scale(1.1);
        color: #ff0844 !important;
    }

    /* Profile Frame Hover */
    .hover-profile-frame {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hover-profile-frame:hover {
        background-color: #0f172a !important;
        color: #ffffff !important;
        border-color: #0f172a !important;
        transform: translateY(-2px) scale(1.08);
        box-shadow: 0 6px 15px rgba(15, 23, 42, 0.25) !important;
    }
</style>

<!-- Bootstrap Tooltip Script Initialization -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>