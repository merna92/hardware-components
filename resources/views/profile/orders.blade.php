<x-layout.layout title="My Orders - Hardware Components">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-bold mb-3 text-dark">{{ __('Manage My Account') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('profile') }}" class="text-decoration-none text-secondary">{{ __('My Profile') }}</a></li>
                        <li><a href="{{ route('addresses.index') }}" class="text-decoration-none text-secondary">{{ __('Address Book') }}</a></li>
                        <li><a href="{{ route('payments.index') }}" class="text-decoration-none text-secondary">{{ __('My Payment Options') }}</a></li>
                    </ul>

                    <h6 class="fw-bold mb-3 text-dark">{{ __('My Orders') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('orders.index') }}" class="text-decoration-none fw-semibold text-danger">{{ __('My Orders') }}</a></li>
                        <li><a href="{{ route('cancellations.index') }}" class="text-decoration-none text-secondary">{{ __('My Cancellations') }}</a></li>
                    </ul>

                    <h6 class="fw-bold mb-3 text-dark">{{ __('My Wishlist') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-0 fs-6">
                        <li><a href="{{ route('wishlist.index') }}" class="text-decoration-none text-secondary">{{ __('My Wishlist') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold mb-4 text-dark">{{ __('My Orders') }}</h4>

                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4">{{ session('success') }}</div>
                    @endif

                    @forelse($orders as $order)
                        <div class="border rounded-4 p-4 mb-4 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <div>
                                    <span class="fw-bold text-dark me-2">{{ __('Order') }} #{{ $order->id }}</span>
                                    <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                </div>
                                @php
                                    $badgeClass = match($order->status) {
                                        'Pending' => 'bg-warning text-dark',
                                        'Processing' => 'bg-info',
                                        'Shipped' => 'bg-primary',
                                        'Delivered' => 'bg-success',
                                        'Cancelled' => 'bg-secondary',
                                        'Return Requested' => 'bg-danger',
                                        'Returned' => 'bg-dark',
                                        default => 'bg-danger',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} px-3 py-2 fs-6">{{ __($order->status) }}</span>
                            </div>

                            @foreach($order->items as $item)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>{{ $item->product_snapshot_name ?? $item->product->product_name ?? 'Hardware Product' }} x {{ $item->quantity }}</span>
                                    <span class="fw-semibold">${{ number_format($item->total_price ?? ($item->unit_price * $item->quantity), 2) }}</span>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top fw-bold">
                                <span>{{ __('Total Amount') }}:</span>
                                <span class="text-danger fs-5">${{ number_format($order->final_amount ?? $order->total_amount, 2) }}</span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2 mt-3">
                                @if($order->status === 'Pending')
                                    <form action="{{ route('orders.cancel', $order) }}" method="POST"
                                          onsubmit="return confirm('{{ __('Are you sure you want to cancel this order?') }}')">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-x-circle me-1"></i>{{ __('Cancel Order') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam fs-1 text-muted"></i>
                            <p class="mt-3 text-muted fs-5">{{ __("You haven't placed any orders yet.") }}</p>
                            <a href="{{ route('catalog.index') }}" class="btn btn-danger px-4 rounded-pill">{{ __('Start Shopping') }}</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
