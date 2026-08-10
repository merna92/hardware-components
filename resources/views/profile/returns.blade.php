<x-layout.layout title="My Returns">
    <div class="container py-5">
        
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
                                <a href="/returns" class="text-decoration-none fw-medium text-danger">My Returns</a>
                            </li>
                            <li>
                                <a href="/cancellations" class="text-decoration-none text-secondary hover-link">My Cancellations</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Section 3: My WishList -->
                    <div>
                        <a href="/wishlist" class="text-decoration-none fw-bold h6 d-block mb-0 text-dark hover-link">My WishList</a>
                    </div>

                </div>
            </div>

            <!-- Right Returns Content -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <h5 class="fw-bold mb-0 text-danger">My Returns</h5>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                            Total Returns: {{ $returns->count() }}
                        </span>
                    </div>

                    @if($returns->isEmpty())
                        <!-- Empty State for Returns -->
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-arrow-return-left display-1 text-secondary opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">No returned items</h5>
                            <p class="text-secondary small mb-4">You have not requested any order returns or refunds yet.</p>
                            <a href="/orders" class="btn text-white px-4 py-2.5 rounded-2 fw-medium shadow-sm bg-danger border-0 hover-red-btn">
                                <i class="bi bi-bag-check me-2"></i> View My Orders
                            </a>
                        </div>
                    @else
                        <!-- Returns List -->
                        <div class="d-flex flex-column gap-4">
                            @foreach($returns as $order)
                                <div class="border rounded-3 p-4 bg-light shadow-sm">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-3 border-bottom">
                                        <div>
                                            <span class="fw-bold text-dark d-block mb-1">Return Request for Order #{{ $order->order_number ?? $order->id }}</span>
                                            <small class="text-secondary">
                                                <i class="bi bi-calendar3 me-1"></i> Requested on {{ $order->updated_at->format('M d, Y') }}
                                            </small>
                                        </div>

                                        <div class="d-flex align-items-center gap-3">
                                            <span class="badge bg-warning text-dark border border-warning-subtle px-3 py-2 rounded-pill fw-semibold text-capitalize">
                                                {{ str_replace('_', ' ', $order->status) }}
                                            </span>

                                            <span class="fw-bold text-dark fs-5">
                                                ${{ number_format($order->total_price ?? 0, 2) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2 text-secondary small">
                                            <i class="bi bi-info-circle fs-5 text-secondary"></i>
                                            <span>Refund Amount: <strong>${{ number_format($order->total_price ?? 0, 2) }}</strong></span>
                                        </div>

                                        <span class="badge bg-light text-dark border px-3 py-2 rounded-2 small">
                                            Status: Processing Refund
                                        </span>
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
    </style>
</x-layout.layout>