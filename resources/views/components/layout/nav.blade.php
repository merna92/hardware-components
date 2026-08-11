<div class="top-sale-bar bg-dark text-white py-1 text-center fs-7">
    <div class="container d-flex justify-content-center justify-content-md-between align-items-center">
        <span>{{ __('Summer Sale For All Hardware Components - OFF 20%!') }} <a href="{{ route('catalog.index') }}" class="text-white text-decoration-underline fw-bold ms-2">{{ __('ShopNow') }}</a></span>
        <div class="d-none d-md-flex align-items-center gap-3">
            <!-- Dark Mode Toggle -->
            <a href="javascript:void(0)" id="themeToggleBtn" class="text-white text-decoration-none" title="Toggle Dark Mode">
                <i class="bi bi-moon fs-6"></i>
            </a>
            <!-- Language Toggle (simple icon like dark mode) -->
            <a href="{{ route('locale.set', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" 
               class="text-white text-decoration-none d-flex align-items-center gap-1" 
               id="langToggleBtn" title="Toggle Language">
                <i class="bi bi-translate fs-6"></i>
                <span class="fw-bold" style="font-size: 0.75rem;">{{ app()->getLocale() == 'ar' ? 'EN' : 'AR' }}</span>
            </a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg custom-navbar bg-white border-bottom py-3 shadow-sm sticky-top">
    <div class="container">

        <!-- Brand Logo -->
        <a class="navbar-brand text-decoration-none d-flex align-items-center py-0" href="{{ route('home') }}" style="gap: 4px;">
            <!-- Cropped S Logo -->
            <div style="height: 78px; overflow: hidden; display: flex; align-items: flex-start;" class="rounded">
                <img src="{{ asset('images/silica-logo.jpg') }}" alt="S" style="width: 58px; height: auto; transition: transform 0.3s ease; mix-blend-mode: multiply;" class="hover-scale-img">
            </div>
            
            <!-- Appended Text -->
            <span class="silica-brand-text mb-0" style="font-size: 2.3rem; margin-top: 4px;">
                {{ app()->getLocale() == 'ar' ? 'سِــــــــيليـــــــکا' : 'ILICA' }}
            </span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Nav Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium gap-2">
                <li class="nav-item">
                    <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->routeIs('home') ? 'active-link' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->routeIs('catalog.*') ? 'active-link' : '' }}" href="{{ route('catalog.index') }}">{{ __('Catalog') }}</a>
                </li>
                @if(!auth()->check() || !auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->is('contact*') ? 'active-link' : '' }}" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link custom-nav-link text-dark px-3 position-relative {{ request()->is('about*') ? 'active-link' : '' }}" href="{{ route('about') }}">{{ __('About') }}</a>
                </li>
                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link custom-nav-link text-danger fw-bold px-3 position-relative {{ request()->is('admin*') ? 'active-link' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>{{ __('Admin Dashboard') }}
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Right Utilities -->
            <div class="d-flex align-items-center gap-3">
                
                <!-- Search Form -->
                <form class="d-flex" role="search" action="{{ route('catalog.index') }}" method="GET">
                    <div class="input-group search-modern-group">
                        <span class="input-group-text bg-transparent border-0 pe-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input class="form-control border-0 shadow-none py-2 px-2 fs-6" 
                               type="search" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="{{ __('Search products...') }}">
                    </div>
                </form>

                <!-- Wishlist Icon -->
                <a href="{{ route('wishlist.index') }}" 
                   class="navbar-icon-btn position-relative text-dark fs-5 p-2 rounded-circle hover-icon-box" 
                   title="{{ __('Wishlist') }}">
                    <i class="bi bi-heart"></i>
                </a>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" 
                   class="navbar-icon-btn position-relative text-dark fs-5 p-2 rounded-circle hover-icon-box" 
                   title="{{ __('Cart') }}">
                    <i class="bi bi-cart3"></i>
                </a>

                <!-- User Profile / Auth Link -->
                @auth
                    <a href="{{ route('profile') }}" class="d-inline-flex align-items-center justify-content-center text-decoration-none">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                alt="{{ auth()->user()->name }}" 
                                class="rounded-circle object-fit-cover border shadow-sm" 
                                style="width: 38px; height: 38px; border-color: #e2e8f0 !important;">
                        @else
                            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center border" 
                                style="width: 38px; height: 38px;">
                                <i class="bi bi-person fs-5"></i>
                            </div>
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Login') }}
                    </a>
                @endauth

            </div>

        </div>

    </div>
</nav>

<style>
    .custom-nav-link {
        transition: color 0.2s ease-in-out;
        border: none !important;
        text-decoration: none !important;
    }
    .custom-nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2.5px;
        background-color: #db4444;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(-50%);
        border-radius: 2px;
    }
    .custom-nav-link.active-link {
        color: #db4444 !important;
        font-weight: 700 !important;
    }
    .custom-nav-link.active-link::after {
        width: 70% !important;
    }
    .hover-icon-box {
        transition: all 0.25s ease-in-out;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .hover-icon-box:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        color: #db4444 !important;
    }
    .hover-scale-img:hover {
        transform: scale(1.05);
    }
    .fs-7 { font-size: 0.85rem; }
    #langToggleBtn:hover {
        opacity: 0.8;
        transform: translateY(-1px);
    }
    #langToggleBtn {
        transition: all 0.2s ease;
    }
    .search-modern-group {
        background: #f1f3f5;
        border-radius: 50px;
        padding: 2px 8px;
        transition: all 0.3s ease;
        min-width: 220px;
    }
    .search-modern-group:focus-within {
        background: #e9ecef;
        box-shadow: 0 0 0 3px rgba(219, 68, 68, 0.15);
    }
    .search-modern-group .form-control {
        background: transparent !important;
        font-size: 0.85rem;
    }
    .search-modern-group .form-control::placeholder {
        color: #adb5bd;
        font-size: 0.85rem;
    }
    .search-modern-group .input-group-text {
        color: #adb5bd;
    }

    /* Silica Brand Logo */
    .silica-brand-text {
        font-family: 'Orbitron', sans-serif;
        font-weight: 800;
        font-size: 1.45rem;
        letter-spacing: 3px;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
        text-transform: uppercase;
    }
    [dir="rtl"] .silica-brand-text {
        font-family: 'Orbitron', 'Cairo', sans-serif;
        letter-spacing: 2px;
        font-size: 1.5rem;
    }
    .navbar-brand:hover .silica-brand-text {
        background: linear-gradient(135deg, #db4444 0%, #ff6b6b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .silica-logo-icon {
        transition: transform 0.3s ease;
    }
    .navbar-brand:hover .silica-logo-icon {
        transform: rotate(12deg) scale(1.08);
    }
    [data-bs-theme="dark"] .silica-brand-text {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    [data-bs-theme="dark"] .navbar-brand:hover .silica-brand-text {
        background: linear-gradient(135deg, #db4444 0%, #ff6b6b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
