<x-layout.layout title="My WishList">
    <div class="container py-5">
        
        <!-- Success Alert Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            
            <!-- Left Minimal Navigation Sidebar -->
            <div class="col-lg-3">
                <div class="pe-lg-3">
                    
                    <!-- Section 1: Manage My Account -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">Manage My Account</h6>
                        <ul class="list-unstyled ps-3 mb-0 d-flex flex-column gap-2">
                            <li>
                                <a href="/profile" class="text-decoration-none text-secondary hover-link">My Profile</a>
                            </li>
                            <li>
                                <a href="/addresses" class="text-decoration-none text-secondary hover-link">Address Book</a>
                            </li>
                            <li>
                                <a href="/payments" class="text-decoration-none text-secondary hover-link">My Payment Options</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Section 2: My Orders -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">My Orders</h6>
                        <ul class="list-unstyled ps-3 mb-0 d-flex flex-column gap-2">
                            <li>
                                <a href="/orders" class="text-decoration-none text-secondary hover-link">My Orders History</a>
                            </li>
                            <li>
                                <a href="/returns" class="text-decoration-none text-secondary hover-link">My Returns</a>
                            </li>
                            <li>
                                <a href="/cancellations" class="text-decoration-none text-secondary hover-link">My Cancellations</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Section 3: My WishList -->
                    <div>
                        <a href="/wishlist" class="text-decoration-none fw-bold h6 d-block mb-0 text-danger">My WishList</a>
                    </div>
                       <!-- Section 4: Logout -->
                <div class="mt-4 pt-3 border-top">
                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 bg-transparent fw-bold h6 d-flex align-items-center gap-2 hover-link text-decoration-none">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
                </div>
            </div>

            <!-- Right Wishlist Content -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <h5 class="fw-bold mb-0 text-danger">My WishList</h5>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                            Total Saved: {{ $wishlists->count() }}
                        </span>
                    </div>

                    @if($wishlists->isEmpty())
                        <!-- Empty State for Wishlist -->
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-heart display-1 text-secondary opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Your Wishlist is Empty</h5>
                            <p class="text-secondary small mb-4">You haven't saved any items to your wishlist yet. Explore our products and save your favorites!</p>
                            <a href="/" class="btn text-white px-4 py-2.5 rounded-2 fw-medium shadow-sm bg-danger border-0 hover-red-btn">
                                <i class="bi bi-shop me-2"></i> Explore Our Products
                            </a>
                        </div>
                    @else
                        <!-- Wishlist Grid Cards -->
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                            @foreach($wishlists as $item)
                                <div class="col">
                                    <div class="card h-100 border rounded-3 shadow-sm position-relative overflow-hidden">
                                        
                                        <!-- Delete / Remove Wishlist Button -->
                                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="position-absolute top-0 end-0 m-2 z-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light rounded-circle p-2 shadow-sm border-0 d-flex align-items-center justify-content-center text-secondary hover-danger" title="Remove from Wishlist" style="width: 32px; height: 32px;">
                                                <i class="bi bi-trash fs-6"></i>
                                            </button>
                                        </form>

                                        <!-- Product Image -->
                                        <div class="bg-light p-3 text-center d-flex align-items-center justify-content-center" style="height: 180px;">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid object-fit-contain" style="max-height: 140px;">
                                            @else
                                                <i class="bi bi-image display-4 text-secondary opacity-50"></i>
                                            @endif
                                        </div>

                                        <!-- Product Info Body -->
                                        <div class="card-body d-flex flex-column justify-content-between p-3">
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $item->product->name ?? 'Product' }}</h6>
                                                <p class="text-danger fw-bold mb-3">${{ number_format($item->product->price ?? 0, 2) }}</p>
                                            </div>

                                            <!-- Add to Cart Action -->
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                <button type="submit" class="btn btn-dark btn-sm w-100 rounded-2 fw-medium d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <style>
        .hover-link:hover {
            color: #dc3545 !important;
        }
        .hover-red-btn {
            transition: background-color 0.2s ease;
        }
        .hover-red-btn:hover {
            background-color: #e62e04 !important;
        }
        .hover-danger:hover {
            background-color: #dc3545 !important;
            color: #ffffff !important;
        }
    </style>
</x-layout.layout>