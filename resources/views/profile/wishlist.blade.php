<x-layout.layout title="My Wishlist - Hardware Components">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Wishlist ({{ count($wishlists) }})</h3>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-dark rounded-pill px-4">Continue Shopping</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse($wishlists as $wishlist)
                @if($wishlist->product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative bg-white">
                            <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST" class="position-absolute top-0 end-0 m-3 z-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-xs" title="Remove">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </form>

                            <div class="bg-light text-center p-4" style="height: 200px;">
                                <img src="{{ $wishlist->product->image_url }}" class="img-fluid object-fit-contain h-100" alt="{{ $wishlist->product->product_name }}">
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <h6 class="fw-bold text-dark mb-2">{{ $wishlist->product->product_name }}</h6>
                                <span class="fs-5 fw-bold text-danger mb-3">${{ number_format($wishlist->product->price, 2) }}</span>

                                <form action="{{ route('cart.add', $wishlist->product->id) }}" method="POST" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 rounded-3 py-2 fw-semibold">
                                        <i class="bi bi-cart-plus me-1"></i> Add To Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-heart fs-1 text-muted"></i>
                    <p class="mt-3 text-muted fs-5">Your wishlist is currently empty.</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-danger px-4 rounded-pill">Explore Products</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layout.layout>
