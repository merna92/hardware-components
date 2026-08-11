<x-layout.layout title="Checkout - Exclusive">
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none text-muted">Cart</a></li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">Checkout</li>
            </ol>
        </nav>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Billing Details -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <h4 class="fw-bold text-dark mb-4">Billing Details</h4>

                        @if($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4">{{ $errors->first() }}</div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control bg-light border-0 py-2" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Last Name</label>
                                <input type="text" name="last_name" class="form-control bg-light border-0 py-2" value="{{ old('last_name', $user->last_name ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Street Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control bg-light border-0 py-2" placeholder="House number and street name" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control bg-light border-0 py-2" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control bg-light border-0 py-2" value="{{ old('phone', $user->phone ?? $user->phone_number ?? '') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control bg-light border-0 py-2" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Order Notes (Optional)</label>
                                <textarea name="notes" class="form-control bg-light border-0 py-2" rows="3" placeholder="Any special delivery instructions...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-4">Your Order</h5>

                        <div class="d-flex flex-column gap-3 pb-3 mb-3 border-bottom">
                            @foreach($cartItems as $item)
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $item->product->image_url ?? asset('images/placeholder.png') }}" class="rounded bg-light p-1" style="width: 45px; height: 45px; object-fit: contain;" alt="">
                                        <div>
                                            <small class="fw-semibold text-dark d-block text-truncate" style="max-width: 180px;">{{ $item->product->product_name }}</small>
                                            <small class="text-muted">x{{ $item->quantity }}</small>
                                        </div>
                                    </div>
                                    <span class="fw-bold text-dark">${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold">${{ number_format($totals['subtotal'], 2) }}</span>
                        </div>
                        @if($totals['discount'] > 0)
                            <div class="d-flex justify-content-between py-2 text-success">
                                <span>Discount:</span>
                                <span class="fw-bold">-${{ number_format($totals['discount'], 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Tax (14%):</span>
                            <span class="fw-bold">${{ number_format($totals['tax'], 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-top mt-2 pt-3">
                            <span class="fw-bold text-dark fs-5">Total:</span>
                            <span class="fw-bold text-danger fs-4">${{ number_format($totals['total'], 2) }}</span>
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cash_on_delivery" checked>
                                <label class="form-check-label fw-semibold" for="cod">Cash on Delivery</label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank_transfer">
                                <label class="form-check-label fw-semibold" for="bank">Bank Transfer</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 rounded-3 py-3 fw-bold fs-6">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout.layout>
