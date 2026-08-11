<x-layout.layout title="Shopping Cart - Exclusive">
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">Cart</li>
            </ol>
        </nav>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4 rounded-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 mb-4 rounded-3">{{ session('error') }}</div>
        @endif

        @if($cartItems->isEmpty())
            <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-white">
                <div class="card-body">
                    <i class="bi bi-cart-x fs-1 text-muted"></i>
                    <h4 class="fw-bold text-dark mt-3">Your Cart is Empty</h4>
                    <p class="text-muted">Looks like you haven't added any hardware components to your cart yet.</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-danger rounded-pill px-4 py-2 mt-2 fw-semibold">Return to Shop</a>
                </div>
            </div>
        @else
            <div class="table-responsive bg-white shadow-sm rounded-4 p-4 mb-4">
                <table class="table align-middle border-bottom">
                    <thead>
                        <tr class="text-muted small text-uppercase">
                            <th>Product</th>
                            <th>Price</th>
                            <th style="width: 160px;">Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->product->image_url ?? asset('images/placeholder.png') }}" class="img-fluid rounded-3 object-fit-contain bg-light p-2" style="width: 60px; height: 60px;" alt="{{ $item->product->product_name }}">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0">{{ $item->product->product_name }}</h6>
                                            <small class="text-muted">{{ $item->product->category->category_name ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold text-dark">${{ number_format($item->unit_price, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}" class="btn btn-outline-secondary btn-sm px-2 rounded-2">-</button>
                                        <input type="text" readonly value="{{ $item->quantity }}" class="form-control form-control-sm text-center border-0 fw-bold px-1" style="width: 45px;">
                                        <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="btn btn-outline-secondary btn-sm px-2 rounded-2">+</button>
                                    </form>
                                </td>
                                <td class="fw-bold text-danger">${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm text-danger rounded-circle p-2" title="Remove Item">
                                            <i class="bi bi-trash fs-6"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center pt-2">
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark rounded-3 px-4 fw-semibold">Return To Shop</a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger rounded-3 px-4 fw-semibold">Clear Cart</button>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h6 class="fw-bold text-dark mb-3">Apply Coupon</h6>
                        <form action="{{ route('coupon.apply') }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="text" name="code" class="form-control rounded-3" placeholder="Coupon Code (e.g. SAVE10)" value="{{ session('coupon_code') }}" required>
                            <button type="submit" class="btn btn-danger px-4 rounded-3 fw-semibold">Apply</button>
                        </form>
                        @if($coupon)
                            <div class="mt-3 p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                <span class="text-success fw-semibold"><i class="bi bi-check-circle me-1"></i> Coupon <strong>{{ $coupon->code }}</strong> Applied!</span>
                                <form action="{{ route('coupon.remove') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm text-danger p-0 text-decoration-none fw-bold">Remove</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-4">Cart Total</h5>
                        <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold text-dark">${{ number_format($totals['subtotal'], 2) }}</span>
                        </div>
                        @if($totals['discount'] > 0)
                            <div class="d-flex justify-content-between pb-3 mb-3 border-bottom text-success">
                                <span>Discount:</span>
                                <span class="fw-bold">-${{ number_format($totals['discount'], 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                            <span class="text-muted">Estimated Tax (14%):</span>
                            <span class="fw-bold text-dark">${{ number_format($totals['tax'], 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between pb-4 mb-4 border-bottom">
                            <span class="fw-bold text-dark fs-5">Total:</span>
                            <span class="fw-bold text-danger fs-4">${{ number_format($totals['total'], 2) }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100 rounded-3 py-3 fw-bold fs-6">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout.layout>
