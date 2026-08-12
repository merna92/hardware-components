<x-layout.layout :title="__('Admin Dashboard') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <span class="text-danger fw-bold text-uppercase tracking-wider">{{ __('Admin Panel') }}</span>
                <h1 class="h2 fw-bold text-dark mb-0">{{ __('Management Dashboard') }}</h1>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Users') }}</a>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Coupons') }}</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Categories') }}</a>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Brands') }}</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Products') }}</a>
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Reviews') }}</a>
                <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-outline-dark rounded-pill px-3">{{ __('Activity Log') }}</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-danger rounded-pill px-3 fw-semibold">{{ __('Orders') }}</a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-currency-dollar fs-1 text-success mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">{{ __('Total Sales') }}</span>
                    <h3 class="fw-bold text-dark mb-0">${{ number_format($totalSales, 2) }}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-cart-check fs-1 text-danger mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">{{ __('Orders') }}</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $ordersCount }}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-people fs-1 text-primary mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">{{ __('Customers') }}</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $customersCount }}</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center h-100">
                    <i class="bi bi-ticket-perforated fs-1 text-warning mb-2"></i>
                    <span class="text-muted small text-uppercase fw-bold">{{ __('Active Coupons') }}</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $activeCoupons }}</h3>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="fw-bold mb-4">{{ __('Latest Platform Orders') }}</h5>
            @if($latestOrders->isEmpty())
                <div class="alert alert-info mb-0">{{ __('No orders recorded yet.') }}</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Order ID') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Payment') }}</th>
                                <th>{{ __('Total Amount') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestOrders as $order)
                                <tr>
                                    <td class="fw-bold">#{{ $order->id }}</td>
                                    <td><span class="badge bg-danger px-3 py-2 fs-7">{{ __($order->status) }}</span></td>
                                    <td><span class="badge bg-secondary px-3 py-2 fs-7">{{ __($order->payment_status) }}</span></td>
                                    <td class="fw-bold text-dark">${{ number_format($order->final_amount, 2) }}</td>
                                    <td class="text-muted small">{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mt-4">
            <h5 class="fw-bold mb-4">{{ __('Best Selling Products') }}</h5>
            @if($bestSellingProducts->isEmpty())
                <div class="alert alert-info mb-0">{{ __('No sales data available yet.') }}</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Units Sold') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSellingProducts as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product ?? 'Unknown Product' }}</td>
                                    <td><span class="badge bg-success px-3 py-2">{{ $item->total_quantity }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layout.layout>
