<x-layout title="Admin Dashboard">
    <main class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1"><span class="exclusive-pill"></span>Admin Dashboard</h1>
                <p class="text-muted mb-0">Manage catalog data and order status.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-exclusive">
                <i class="bi bi-plus-circle me-1"></i> Add Product
            </a>
        </div>

        @include('admin.partials.alerts')

        <div class="row g-3 mb-4">
            @foreach ($stats as $stat)
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted small mb-1">{{ $stat['label'] }}</p>
                                <h2 class="h3 fw-bold mb-0">{{ $stat['value'] }}</h2>
                            </div>
                            <i class="bi {{ $stat['icon'] }} fs-2 text-secondary"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-3 mb-4">
            @foreach ($analytics as $item)
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">{{ $item['label'] }}</span>
                                <i class="bi {{ $item['icon'] }} text-secondary"></i>
                            </div>
                            <div class="h4 fw-bold mb-0">{{ $item['value'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-3 mb-4">
                <div class="col-12 col-xl-6">
                <div class="card admin-card-exclusive h-100">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3">Order Status Summary</h2>
                        @foreach ($statusSummary as $item)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <span>{{ $item['status'] }}</span>
                                <span class="badge text-bg-secondary">{{ $item['count'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card admin-card-exclusive h-100">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3">Latest Products</h2>
                        @forelse ($latestProducts as $product)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">{{ $product->product_name }}</div>
                                    <small class="text-muted">{{ $product->category?->category_name ?? 'N/A' }}</small>
                                </div>
                                <span class="text-muted">${{ number_format((float) $product->price, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No products yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card admin-card-exclusive">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3"><span class="exclusive-pill" style="height:25px; width:12px; margin-right:8px;"></span>Latest Orders</h2>
                        <div class="table-responsive">
                            <table class="table admin-table-exclusive align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestOrders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user?->name ?? 'User #' . $order->user_id }}</td>
                                            <td>${{ number_format((float) $order->final_amount, 2) }}</td>
                                            <td><span class="badge text-bg-secondary">{{ $order->status }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">No orders yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-lg-4">
                <a class="card border-0 shadow-sm h-100 text-decoration-none text-dark" href="{{ route('admin.categories.index') }}">
                    <div class="card-body">
                        <i class="bi bi-grid fs-3"></i>
                        <h3 class="h5 mt-3">Categories</h3>
                        <p class="text-muted mb-0">Create, edit, and delete product categories.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="card border-0 shadow-sm h-100 text-decoration-none text-dark" href="{{ route('admin.products.index') }}">
                    <div class="card-body">
                        <i class="bi bi-cpu fs-3"></i>
                        <h3 class="h5 mt-3">Products</h3>
                        <p class="text-muted mb-0">Manage product details, prices, stock, and images.</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="card border-0 shadow-sm h-100 text-decoration-none text-dark" href="{{ route('admin.orders.index') }}">
                    <div class="card-body">
                        <i class="bi bi-bag-check fs-3"></i>
                        <h3 class="h5 mt-3">Orders</h3>
                        <p class="text-muted mb-0">Review orders and update delivery progress.</p>
                    </div>
                </a>
            </div>
        </div>
    </main>
</x-layout>
