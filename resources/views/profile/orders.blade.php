<x-layout.layout title="My Orders">
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
                    <a href="/orders" class="text-decoration-none fw-medium text-danger">My Orders History</a>
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
            <a href="/wishlist" class="text-decoration-none fw-bold h6 d-block mb-0 text-dark hover-link">My WishList</a>
        </div>

    </div>
</div>

            <!-- Right Orders Content -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <h5 class="fw-bold mb-0 text-danger">My Orders</h5>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                            Total Orders: {{ $orders->count() }}
                        </span>
                    </div>

                    @if($orders->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-bag-x display-1 text-secondary opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">No orders found yet</h5>
                            <p class="text-secondary small mb-4">You haven't placed any orders with us yet. Explore our latest products and start shopping!</p>
                            <a href="/" class="btn text-white px-4 py-2.5 rounded-2 fw-medium shadow-sm bg-danger border-0 hover-red-btn">
                                <i class="bi bi-shop me-2"></i> Explore Our Store
                            </a>
                        </div>
                    @else
                        <!-- Orders List -->
                        <div class="d-flex flex-column gap-4">
                            @foreach($orders as $order)
                                <div class="border rounded-3 p-4 bg-light shadow-sm">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-3 border-bottom">
                                        <div>
                                            <span class="fw-bold text-dark d-block mb-1">Order #{{ $order->order_number ?? $order->id }}</span>
                                            <small class="text-secondary">
                                                <i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('M d, Y - h:i A') }}
                                            </small>
                                        </div>

                                        <div class="d-flex align-items-center gap-3">
                                            <!-- Status Badges -->
                                            @php
                                                $statusClass = match(strtolower($order->status ?? 'pending')) {
                                                    'pending' => 'bg-warning text-dark border-warning-subtle',
                                                    'processing' => 'bg-primary text-white',
                                                    'shipped' => 'bg-info text-dark',
                                                    'delivered' => 'bg-success text-white',
                                                    'cancelled' => 'bg-danger text-white',
                                                    default => 'bg-secondary text-white'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill fw-semibold text-capitalize">
                                                {{ $order->status ?? 'Pending' }}
                                            </span>

                                            <span class="fw-bold text-dark fs-5">
                                                ${{ number_format($order->total_price ?? $order->total ?? 0, 2) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2 text-secondary small">
                                            <i class="bi bi-box-seam fs-5 text-dark"></i>
                                            <span>{{ $order->items->count() }} item(s) in this order</span>
                                        </div>

                                        <!-- View Details Trigger Modal -->
                                        <button type="button" class="btn btn-outline-dark btn-sm rounded-2 px-3 fw-medium" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                            View Details
                                        </button>
                                    </div>
                                </div>

                                <!-- Order Details Modal -->
                                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4">
                                            <div class="modal-header border-bottom p-4">
                                                <div>
                                                    <h5 class="modal-title fw-bold text-dark mb-1">Order Details #{{ $order->order_number ?? $order->id }}</h5>
                                                    <small class="text-secondary">Placed on {{ $order->created_at->format('F d, Y') }}</small>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body p-4">
                                                <!-- Items List -->
                                                <div class="table-responsive">
                                                    <table class="table table-borderless align-middle mb-0">
                                                        <thead class="bg-light">
                                                            <tr class="text-secondary small">
                                                                <th>Product</th>
                                                                <th class="text-center">Price</th>
                                                                <th class="text-center">Quantity</th>
                                                                <th class="text-end">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($order->items as $item)
                                                                <tr class="border-bottom">
                                                                    <td>
                                                                        <div class="d-flex align-items-center gap-3 py-2">
                                                                            @if($item->product && $item->product->image)
                                                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded-2 object-fit-cover" style="width: 50px; height: 50px;">
                                                                            @else
                                                                                <div class="rounded-2 bg-light d-flex align-items-center justify-content-center text-secondary" style="width: 50px; height: 50px;">
                                                                                    <i class="bi bi-image fs-4"></i>
                                                                                </div>
                                                                            @endif
                                                                            <div>
                                                                                <h6 class="fw-semibold text-dark mb-0 fs-6">{{ $item->product->name ?? 'Product' }}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center fw-medium">${{ number_format($item->price, 2) }}</td>
                                                                    <td class="text-center fw-medium">{{ $item->quantity }}</td>
                                                                    <td class="text-end fw-bold text-dark">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                                    <span class="fw-bold text-dark">Order Total Amount</span>
                                                    <span class="fw-bold text-danger fs-4">${{ number_format($order->total_price ?? $order->total ?? 0, 2) }}</span>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-top p-3">
                                                <button type="button" class="btn btn-secondary btn-sm px-4 rounded-2" data-bs-dismiss="modal">Close</button>
                                            </div>
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
    </style>
</x-layout.layout>