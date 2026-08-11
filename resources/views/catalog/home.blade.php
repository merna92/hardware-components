    <main class="container py-5">
        <!-- Hero Banner -->
        <div class="p-5 bg-dark text-white rounded-4 shadow-sm mb-5 position-relative overflow-hidden">
            <div class="row align-items-center position-relative z-1 py-4">
                <div class="col-lg-7">
                    <span class="text-danger fw-bold text-uppercase tracking-wider">{{ __('iPhone 14 Series / Hardware Tech') }}</span>
                    <h1 class="display-4 fw-extrabold text-white mt-2 mb-3">{{ __('Up to 10% off Voucher for Hardware Components') }}</h1>
                    <p class="text-secondary lead mb-4">{{ __('Discover high performance GPUs, CPUs, Motherboards and NVMe SSDs with official warranty.') }}</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-danger btn-lg rounded-pill px-5 fw-bold shadow-sm">
                        {{ __('Shop Now') }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <i class="bi bi-cpu display-1 text-danger"></i>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="bg-danger rounded" style="width: 15px; height: 30px;"></div>
                <span class="text-danger fw-bold">{{ __('Categories') }}</span>
            </div>
            <h2 class="h3 fw-bold mb-4">{{ __('Browse By Category') }}</h2>
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                @foreach ($categories as $cat)
                    <div class="col">
                        <a href="{{ route('catalog.index', ['category' => $cat->id]) }}" class="text-decoration-none">
                            <div class="p-4 border rounded-4 text-center bg-white shadow-sm hover-cat h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="bi bi-hardware fs-1 text-dark mb-2"></i>
                                <span class="fw-semibold text-dark fs-6">{{ $cat->category_name }}</span>
                                <small class="text-muted mt-1">{{ $cat->available_products_count }} {{ __('Products') }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Featured Products -->
        <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="bg-danger rounded" style="width: 15px; height: 30px;"></div>
                <span class="text-danger fw-bold">{{ __('Our Products') }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold mb-0">{{ __('Explore Our Products') }}</h2>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-danger rounded-pill px-4">{{ __('View All Products') }}</a>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($featuredProducts as $product)
                    <div class="col">
                        <x-catalog.product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <style>
        .hover-cat {
            transition: all 0.3s ease;
        }
        .hover-cat:hover {
            background-color: #db4444 !important;
            color: white !important;
            transform: translateY(-5px);
        }
        .hover-cat:hover span, .hover-cat:hover i, .hover-cat:hover small {
            color: white !important;
        }
    </style>
