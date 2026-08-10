<x-layout title="Coupons">
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Coupons</div>

            <div class="admin-title-row">
                <h2>Coupons Management</h2>
                <div class="admin-actions">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark px-4">Dashboard</a>
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-dark px-4">Create Coupon</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="admin-panel p-0">
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Usage</th>
                                <th>Status</th>
                                <th>Dates</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td class="fw-bold">{{ $coupon->code }}</td>
                                    <td>{{ $coupon->type }}</td>
                                    <td>{{ number_format($coupon->value, 2) }}</td>
                                    <td>{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                                    <td><span class="badge text-bg-light">{{ $coupon->status }}</span></td>
                                    <td>{{ $coupon->start_date ?? '-' }} : {{ $coupon->end_date ?? '-' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                                        <form action="{{ route('admin.coupons.delete', $coupon) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $coupons->links() }}</div>
        </div>
    </div>
</x-layout>
