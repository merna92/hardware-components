<x-layout title="Admin Dashboard">
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin Dashboard</div>

            <div class="admin-title-row">
                <div>
                    <h2>Admin Dashboard</h2>
                    <p class="text-muted mb-0 mt-2">Analytics overview for orders, customers, products and coupons.</p>
                </div>
                <div class="admin-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark px-4">Users</a>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-dark px-4">Coupons</a>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Total Sales</p>
                        <h3>{{ number_format($totalSales, 2) }} EGP</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Orders</p>
                        <h3>{{ $ordersCount }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Customers</p>
                        <h3>{{ $customersCount }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Active Coupons</p>
                        <h3>{{ $activeCoupons }}</h3>
                    </div>
                </div>
            </div>

            <div class="admin-panel">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="admin-panel-title mb-0">Latest Orders</h5>
                    <span class="badge text-bg-light">Products: {{ $productsCount }}</span>
                </div>

                @if($latestOrders->isEmpty())
                    <div class="alert alert-info mb-0">No orders yet.</div>
                @else
                    <div class="table-responsive">
                        <table class="table admin-table align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td><span class="badge text-bg-secondary">{{ $order->status }}</span></td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ number_format($order->final_amount, 2) }} EGP</td>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
