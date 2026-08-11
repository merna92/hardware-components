<nav class="navbar navbar-expand-lg custom-navbar bg-white border-bottom py-2 shadow-sm">
    <div class="container">

        <!-- Brand / Logo -->
        <a class="navbar-brand fw-bold fs-4 text-dark tracking-tight" href="/">Logo Or Title</a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            @guest
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            @endguest
        </ul>

            </div>
            </form>

            <a href="#" class="navbar-icon-btn ms-2 position-relative" aria-label="Wishlist">
            <i class="bi bi-heart fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle badge-wishlist">{{-- Put the number here --}}</span>
            </a>

            <a href="/cart" class="navbar-icon-btn ms-2"><i class="bi bi-cart3 fs-5"></i></a>
            <a href="#" class="navbar-icon-btn ms-2"><i class="bi bi-person fs-5"></i></a>
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