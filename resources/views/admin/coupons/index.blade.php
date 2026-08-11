<x-layout.layout title="Coupons Management - Admin">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Coupons Management</h3>
            <div>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-danger rounded-pill px-4 fw-semibold me-2">+ Create Coupon</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">Dashboard</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Limit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td class="fw-bold text-danger">{{ $coupon->code }}</td>
                                <td>{{ $coupon->type }}</td>
                                <td class="fw-semibold">{{ $coupon->type === 'Percentage' ? $coupon->value.'%' : '$'.number_format($coupon->value, 2) }}</td>
                                <td>{{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                                <td><span class="badge {{ $coupon->status === 'Active' ? 'bg-success' : 'bg-secondary' }} px-3 py-2 fs-7">{{ $coupon->status }}</span></td>
                                <td>
                                    <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-outline-dark me-2">Edit</a>
                                    <form action="{{ route('admin.coupons.delete', $coupon) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete coupon?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $coupons->links() }}</div>
        </div>
    </div>
</x-layout.layout>
