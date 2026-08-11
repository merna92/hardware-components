<x-layout.layout title="Orders Management - Admin">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Orders Management</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items Count</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="fw-bold">#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'Guest/Customer' }}</td>
                                <td>{{ $order->items->count() }} items</td>
                                <td class="fw-bold">${{ number_format($order->final_amount ?? $order->total_amount, 2) }}</td>
                                <td><span class="badge bg-danger px-3 py-2 fs-7">{{ $order->status }}</span></td>
                                <td>
                                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm" style="width: 140px;">
                                            @foreach($statuses as $st)
                                                <option value="{{ $st }}" @selected($order->status === $st)>{{ $st }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-dark">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $orders->links() }}</div>
        </div>
    </div>
</x-layout.layout>
