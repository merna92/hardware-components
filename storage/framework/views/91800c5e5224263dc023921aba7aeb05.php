<div class="top-sale-bar">
    <div class="container d-flex justify-content-center justify-content-md-between align-items-center">
        <span>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!</span>
        <span class="d-none d-md-inline">English <i class="bi bi-chevron-down"></i></span>
    </div>
</div>

<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">Exclusive</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">Admin</a></li>
            <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            <?php endif; ?>
        </ul>

        <div class="d-flex align-items-center gap-3">
            <form class="d-flex" role="search">
            <div class="input-group">
                <input class="form-control custom-search-input rounded-start-2 py-1 px-3" type="search" placeholder="What are you looking for?">
                <button class="btn custom-search-btn rounded-end-2 px-3" type="submit">
                <i class="bi bi-search"></i>
                </button>
            </div>
            </form>

            <a href="#" class="navbar-icon-btn ms-2 position-relative" aria-label="Wishlist">
            <i class="bi bi-heart fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle badge-wishlist"></span>
            </a>

            <a href="#" class="navbar-icon-btn ms-2" aria-label="Cart"><i class="bi bi-cart3 fs-5"></i></a>
            <a href="#" class="navbar-icon-btn ms-2" aria-label="Account"><i class="bi bi-person fs-5"></i></a>
        </div>

        </div>

    </div>
</nav>
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/components/layout/nav.blade.php ENDPATH**/ ?>