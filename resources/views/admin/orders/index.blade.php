<x-layout title="Orders Management">
    <main class="container py-5">
        <div class="mb-4">
            <h1 class="h3 fw-bold mb-1"><span class="exclusive-pill"></span>Orders Management</h1>
            <p class="text-muted mb-0">Review orders and update delivery status.</p>
        </div>

        @include('admin.partials.alerts')

        <div class="card admin-card-exclusive">
            <div class="table-responsive">
                <table class="table admin-table-exclusive align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th class="text-end">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user?->name ?? 'User #' . $order->user_id }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>{{ $order->items->count() }} items</span>
                                        <button class="btn btn-sm btn-outline-secondary py-0 px-1" type="button" data-bs-toggle="collapse" data-bs-target="#orderDetails-{{ $order->id }}" aria-expanded="false" style="font-size: 0.75rem;">
                                            <i class="bi bi-eye"></i> Details
                                        </button>
                                    </div>
                                </td>
                                <td>${{ number_format((float) $order->final_amount, 2) }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td><span class="badge text-bg-secondary">{{ $order->status }}</span></td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="d-inline-flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-exclusive">Save</button>
                                    </form>
                                </td>
                            </tr>
                            <tr class="border-0 collapse-row">
                                <td colspan="7" class="p-0 border-0">
                                    <div class="collapse bg-light border-start border-end" id="orderDetails-{{ $order->id }}">
                                        <div class="p-3">
                                            <h6 class="fw-bold mb-2 text-dark"><i class="bi bi-list-ul me-1"></i> Order Items Detail</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered bg-white mb-0 align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th class="text-center" style="width: 80px;">Qty</th>
                                                            <th class="text-end" style="width: 120px;">Unit Price</th>
                                                            <th class="text-end" style="width: 120px;">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->items as $item)
                                                            <tr>
                                                                <td>{{ $item->product_snapshot_name }}</td>
                                                                <td class="text-center">{{ $item->quantity }}</td>
                                                                <td class="text-end">${{ number_format((float) $item->unit_price, 2) }}</td>
                                                                <td class="text-end">${{ number_format((float) $item->total_price, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $orders->links('pagination::bootstrap-5') }}</div>
    </main>
</x-layout>
