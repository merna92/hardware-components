<x-layout.layout title="Admin Dashboard - Hardware Components">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <span class="text-danger fw-bold text-uppercase tracking-wider">Admin Panel</span>
                <h1 class="h2 fw-bold text-dark mb-0">Management Dashboard</h1>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark rounded-pill px-3">Users</a>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-dark rounded-pill px-3">Coupons</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark rounded-pill px-3">Categories</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark rounded-pill px-3">Products</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-danger rounded-pill px-3 fw-semibold">Orders</a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-currency-dollar fs-1 text-success mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">Total Sales</span>
                    <h3 class="fw-bold text-dark mb-0">${{ number_format($totalSales, 2) }}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-cart-check fs-1 text-danger mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">Total Orders</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $ordersCount }}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-people fs-1 text-primary mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">Registered Users</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $customersCount }}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-ticket-perforated fs-1 text-warning mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">Active Coupons</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $activeCoupons }}</h3>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="fw-bold mb-4">Latest Platform Orders</h5>
            @if($latestOrders->isEmpty())
                <div class="alert alert-info mb-0">No orders recorded yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Total Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestOrders as $order)
                                <tr>
                                    <td class="fw-bold">#{{ $order->id }}</td>
                                    <td><span class="badge bg-danger px-3 py-2 fs-7">{{ $order->status }}</span></td>
                                    <td><span class="badge bg-secondary px-3 py-2 fs-7">{{ $order->payment_status }}</span></td>
                                    <td class="fw-bold text-dark">${{ number_format($order->final_amount, 2) }}</td>
                                    <td class="text-muted small">{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layout.layout>
