<x-layout.layout title="Cart">
    <main class="container my-4 py-3 md:my-5 md:py-4">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="h2 mb-1">Shopping Cart</h1>
                <p class="text-muted mb-0">Review your selected components.</p>
            </div>
            @if ($cartItems->isNotEmpty())
                <form method="POST" action="{{ route('cart.clear') }}" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-custom w-full sm:w-auto">Clear Cart</button>
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
                <a href="/" class="btn btn-danger-custom w-full sm:w-auto">Continue Shopping</a>
            </section>
        @else
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="space-y-3 md:hidden">
                        @foreach ($cartItems as $item)
                            <article class="cart-total-box bg-white p-3">
                                <div class="flex min-w-0 gap-3">
                                    @if ($item->product->image_url)
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->product_name }}" class="h-16 w-16 shrink-0 rounded object-contain" loading="lazy">
                                    @else
                                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded bg-gray-100 text-center text-xs text-muted">No image</div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <h2 class="mb-1 break-words text-base font-semibold">{{ $item->product->product_name }}</h2>
                                        <p class="mb-1 text-sm text-muted">{{ $item->product->stock_quantity }} in stock</p>
                                        <p class="mb-0 font-semibold">${{ number_format((float) $item->unit_price, 2) }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-col gap-3 border-top pt-3">
                                    <form method="POST" action="{{ route('cart.update', $item) }}" class="flex w-full items-center justify-between gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <label class="mb-0 shrink-0 text-sm fw-semibold" for="quantity-{{ $item->id }}">Quantity</label>
                                        <input class="quantity-input min-w-0" id="quantity-{{ $item->id }}" type="number" name="quantity" min="1" max="{{ $item->product->stock_quantity }}" value="{{ $item->quantity }}" aria-label="Quantity for {{ $item->product->product_name }}">
                                        <button type="submit" class="btn btn-outline-custom shrink-0 px-3 py-2">Update</button>
                                    </form>
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <span class="d-block text-sm text-muted">Subtotal</span>
                                            <span class="fw-bold">${{ number_format((float) $item->unit_price * $item->quantity, 2) }}</span>
                                        </div>
                                        <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger px-3 py-2" aria-label="Remove {{ $item->product->product_name }}">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="hidden md:block">
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
                                                <div class="d-flex align-items-center gap-3">
                                                    @if ($item->product->image_url)
                                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->product_name }}" class="rounded" style="width: 56px; height: 56px; object-fit: contain;" loading="lazy">
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ $item->product->product_name }}</div>
                                                        <small class="text-muted">{{ $item->product->stock_quantity }} in stock</small>
                                                    </div>
                                                </div>
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
                </div>

                <aside class="col-12 col-lg-4">
                    <section class="cart-total-box bg-white">
                        <h2 class="h4 mb-4">Order Summary</h2>
                        <form method="POST" action="{{ route('coupon.apply') }}" class="mb-3">
                            @csrf
                            <label class="form-label" for="coupon_code">Discount code</label>
                            <div class="flex flex-col gap-2 sm:flex-row">
                                <input class="form-control min-w-0" id="coupon_code" name="code" value="{{ old('code') }}" placeholder="SAVE10" {{ $coupon ? 'disabled' : '' }}>
                                <button class="btn btn-outline-custom w-full shrink-0 sm:w-auto" type="submit" {{ $coupon ? 'disabled' : '' }}>Apply</button>
                            </div>
                        </form>
                        @if ($coupon)
                            <div class="mb-3 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <span class="badge text-bg-success w-fit">{{ $coupon->code }} Applied</span>
                                <form method="POST" action="{{ route('coupon.remove') }}" class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger w-full sm:w-auto" type="submit">Remove</button>
                                </form>
                            </div>
                        @endif
                        <div class="total-row"><span>Subtotal</span><span>${{ number_format($totals['subtotal'], 2) }}</span></div>
                        @if ($totals['discount'] > 0)
                            <div class="total-row text-success"><span>Discount</span><span>−${{ number_format($totals['discount'], 2) }}</span></div>
                        @endif
                        <div class="total-row"><span>Tax (14%)</span><span>${{ number_format($totals['tax'], 2) }}</span></div>
                        <div class="d-flex justify-content-between pt-3 mt-2 fw-bold fs-5"><span>Total</span><span>${{ number_format($totals['total'], 2) }}</span></div>
                        <a class="btn btn-danger-custom mt-4 block w-full text-center" href="{{ route('checkout.index') }}">Proceed to Checkout</a>
                    </section>
                </aside>
            </div>
        @endif
    </main>
</x-layout.layout>
