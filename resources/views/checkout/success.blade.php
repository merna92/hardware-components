<x-layout.layout title="Order Confirmed - Exclusive">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-5 bg-white text-center">
                    <div class="mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-circle-fill text-success fs-1"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark mb-2">Order Confirmed!</h2>
                    <p class="text-muted mb-4">Thank you for your order. Your order <strong class="text-danger">#{{ $order->id }}</strong> has been placed successfully.</p>

                    <div class="bg-light rounded-4 p-4 mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Order Number:</span>
                            <span class="fw-bold text-dark">#{{ $order->id }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Status:</span>
                            <span class="badge bg-warning px-3 py-2">{{ $order->status }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Payment:</span>
                            <span class="fw-semibold">{{ $order->payment_status }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total Amount:</span>
                            <span class="fw-bold text-danger fs-5">${{ number_format($order->final_amount, 2) }}</span>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('orders.index') }}" class="btn btn-danger rounded-3 py-2 fw-semibold">View My Orders</a>
                        <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark rounded-3 py-2 fw-semibold">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
