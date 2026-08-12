<x-layout.layout :title="__('My Cancellations') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-bold mb-3 text-dark">{{ __('My Orders') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 fs-6">
                        <li><a href="{{ route('orders.index') }}" class="text-decoration-none text-secondary">{{ __('My Orders') }}</a></li>
                        <li><a href="{{ route('cancellations.index') }}" class="text-decoration-none fw-semibold text-danger">{{ __('My Cancellations') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold mb-4 text-dark">{{ __('My Cancellations') }}</h4>

                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4">{{ session('success') }}</div>
                    @endif

                    @forelse($orders as $order)
                        <div class="border rounded-4 p-4 mb-4 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <div>
                                    <span class="fw-bold text-dark me-2">{{ __('Order') }} #{{ $order->id }}</span>
                                    <small class="text-muted">{{ $order->created_at->format('Y-m-d') }}</small>
                                </div>
                                <span class="badge bg-secondary px-3 py-2 fs-6">{{ __('Cancelled') }}</span>
                            </div>
                            @foreach($order->items as $item)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>{{ $item->product_snapshot_name ?? __('Product') }} × {{ $item->quantity }}</span>
                                    <span class="fw-semibold">${{ number_format($item->total_price ?? ($item->unit_price * $item->quantity), 2) }}</span>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top fw-bold">
                                <span>{{ __('Total Amount') }}:</span>
                                <span class="text-danger fs-5">${{ number_format($order->final_amount ?? $order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-x-circle fs-1 text-muted"></i>
                            <p class="mt-3 text-muted fs-5">{{ __('No cancelled orders found.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
