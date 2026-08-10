@props([
    'itemId',
    'cartId',
    'title',
    'imgSrc',
    'imgAlt',
    'quantity' => 1,
    'price',
])

<div class="cart-item-card mb-3">
    <div class="row align-items-center gy-3 text-center text-md-start">

        <!-- الصورة فوق الاسم في الشاشات الصغيرة، وبجانبه في الشاشات الكبيرة -->
        <div class="col-12 col-md-4 d-flex flex-column flex-md-row align-items-center gap-2 gap-md-3 justify-content-center justify-content-md-start">
            <div class="cart-item-img flex-shrink-0">
                <form action="/cart" method="post">
                    @method('DELETE')
                    @csrf

                    <input type="hidden" name="item_id" value="{{ $itemId }}" />
                    <input type="hidden" name="cart_id" value="{{ $cartId }}" />

                    <button type="submit" class="cart-remove-icon">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </form>
                <img src="{{ $imgSrc }}" alt="{{ $imgAlt }}">
            </div>
            <span class="fw-medium text-break">{{ $title }}</span>
        </div>

        <div class="col-6 col-md-3 d-flex d-md-block justify-content-between align-items-center">
            <span class="d-md-none text-muted small">Price:</span>
            <span>${{ $price }}</span>
        </div>

        <div class="col-6 col-md-3 d-flex d-md-block justify-content-between align-items-center">
            <span class="d-md-none text-muted small">Quantity:</span>
            <div class="d-inline-block">
                <div class="quantity-input form-control-sm">{{ $quantity }}</div>
            </div>
        </div>

        <div class="col-12 col-md-2 d-flex d-md-block justify-content-between align-items-center text-md-end pt-2 pt-md-0 border-top border-md-0">
            <span class="d-md-none fw-bold">Subtotal:</span>
            <span class="fw-bold">${{ floatval($price) * floatval($quantity) }}</span>
        </div>

    </div>
</div>
