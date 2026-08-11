<x-layout.layout title="Checkout">
    <main class="container my-5 py-4">
        <div class="mb-4">
            <h1 class="h2 mb-1">Checkout</h1>
            <p class="text-muted mb-0">Complete your order details below.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="row g-4 align-items-start">
            <section class="col-12 col-lg-7">
                <div class="cart-total-box bg-white">
                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <h2 class="h4 mb-4">Contact and Delivery</h2>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="full_name">Full name</label>
                                <input class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $user?->name) }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" value="{{ old('email', $user?->email) }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="phone">Phone</label>
                                <input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="address_line1">Address</label>
                                <input class="form-control" id="address_line1" name="address_line1" value="{{ old('address_line1') }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="city">City</label>
                                <input class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="country">Country</label>
                                <input class="form-control" id="country" name="country" value="{{ old('country') }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="postal_code">Postal code</label>
                                <input class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="payment_method">Payment method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="">Select payment method</option>
                                    <option value="cod" @selected(old('payment_method', 'cod') === 'cod')>Cash on delivery</option>
                                    <option value="credit_card" @selected(old('payment_method') === 'credit_card')>Credit card</option>
                                    <option value="paypal" @selected(old('payment_method') === 'paypal')>PayPal</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger-custom mt-4">Place Order</button>
                    </form>
                </div>
            </section>

            <aside class="col-12 col-lg-5 position-sticky top-0">
                <section class="cart-total-box bg-white">
                    <h2 class="h4 mb-4">Order Summary</h2>
                    <form method="POST" action="{{ route('coupon.apply') }}" class="mb-3">
                        @csrf
                        <label class="form-label" for="coupon_code">Discount code</label>
                        <div class="input-group">
                            <input class="form-control" id="coupon_code" name="code" value="{{ old('code') }}" placeholder="SAVE10" {{ $coupon ? 'disabled' : '' }}>
                            <button class="btn btn-outline-custom" type="submit" {{ $coupon ? 'disabled' : '' }}>Apply</button>
                        </div>
                    </form>
                    @if ($coupon)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge text-bg-success">{{ $coupon->code }} Applied</span>
                            <form method="POST" action="{{ route('coupon.remove') }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Remove</button>
                            </form>
                        </div>
                    @endif
                    @foreach ($cartItems as $item)
                        <div class="d-flex justify-content-between gap-3 pb-3 mb-3 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ $item->product->product_name }}</div>
                                <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                            </div>
                            <span>${{ number_format((float) $item->unit_price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="total-row"><span>Subtotal</span><span>${{ number_format($totals['subtotal'], 2) }}</span></div>
                    @if ($totals['discount'] > 0)
                        <div class="total-row text-success"><span>Discount</span><span>−${{ number_format($totals['discount'], 2) }}</span></div>
                    @endif
                    <div class="total-row"><span>Tax (14%)</span><span>${{ number_format($totals['tax'], 2) }}</span></div>
                    <div class="d-flex justify-content-between pt-3 mt-2 fw-bold fs-5"><span>Total</span><span>${{ number_format($totals['total'], 2) }}</span></div>
                </section>
            </aside>
        </div>
    </main>
</x-layout.layout>
