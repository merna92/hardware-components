<x-layout>
<div class="container my-5 py-4">

    <div class="cart-table-header d-none d-md-flex align-items-center row text-center text-md-start">
        <div class="col-md-4">Product</div>
        <div class="col-md-3">Price</div>
        <div class="col-md-3">Quantity</div>
        <div class="col-md-2 text-md-end">Subtotal</div>
    </div>

    @foreach ( $cartItems as $item )
        <x-cart.item
            itemId='{{ $item->id }}'
            cartId='{{ $item->cart_id }}'
            title='{{ $item->product->product_name }}'
            imgSrc='{{ $item->product->image_url }}'
            imgAlt='{{ $item->product->product_name }}'
            quantity='{{ $item->quantity }}'
            price='{{ $item->unit_price }}'/>
    @endforeach

    <div class="d-flex justify-content-between align-items-center my-4 pt-2">
        <a href="#" class="btn btn-outline-custom">Return To Shop</a>
        <a href="/cart/edit" class="btn btn-outline-custom">Update Cart</a>
    </div>

    <div class="row mt-5 pt-3 g-4">

        <div class="col-12 col-lg-6">
            <x-cart.coupon />
        </div>

        <div class="col-12 col-lg-5 offset-lg-1">
            <x-cart.cartTotal total='{{ $sum }}'/>
        </div>

    </div>

</div>
</x-layout>
