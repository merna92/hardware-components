<x-layout.layout title="Cart">
    <main class="container my-5 py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="h2 mb-1">Shopping Cart</h1>
                <p class="text-muted mb-0">Review your selected components.</p>
            </div>
            @if ($cartItems->isNotEmpty())
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-custom">Clear Cart</button>
                </form>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        @if ($cartItems->isEmpty())
            <section class="cart-total-box text-center py-5">
                <h2 class="h4">Your cart is empty</h2>
                <p class="text-muted mb-4">Add products to begin checkout.</p>
                <a href="/" class="btn btn-danger-custom">Continue Shopping</a>
            </section>
        @else
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="table-responsive cart-total-box">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                    <th><span class="visually-hidden">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $item->product->product_name }}</div>
                                            <small class="text-muted">{{ $item->product->stock_quantity }} in stock</small>
                                        </td>
                                        <td>${{ number_format((float) $item->unit_price, 2) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('cart.update', $item) }}" class="d-flex align-items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input class="quantity-input" type="number" name="quantity" min="1" max="{{ $item->product->stock_quantity }}" value="{{ $item->quantity }}" aria-label="Quantity for {{ $item->product->product_name }}">
                                                <button type="submit" class="btn btn-sm btn-outline-custom">Update</button>
                                            </form>
                                        </td>
                                        <td class="text-end fw-semibold">${{ number_format((float) $item->unit_price * $item->quantity, 2) }}</td>
                                        <td class="text-end">
                                            <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Remove {{ $item->product->product_name }}">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <aside class="col-12 col-lg-4">
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
                        <div class="total-row"><span>Subtotal</span><span>${{ number_format($totals['subtotal'], 2) }}</span></div>
                        @if ($totals['discount'] > 0)
                            <div class="total-row text-success"><span>Discount</span><span>−${{ number_format($totals['discount'], 2) }}</span></div>
                        @endif
                        <div class="total-row"><span>Tax (14%)</span><span>${{ number_format($totals['tax'], 2) }}</span></div>
                        <div class="d-flex justify-content-between pt-3 mt-2 fw-bold fs-5"><span>Total</span><span>${{ number_format($totals['total'], 2) }}</span></div>
                        <a class="btn btn-danger-custom w-100 mt-4" href="{{ route('checkout.index') }}">Proceed to Checkout</a>
                    </section>
                </aside>
            </div>
        @endif
    </main>
</x-layout.layout>
