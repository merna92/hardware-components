@props(['product'])
<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card position-relative bg-white">
    @php
        $image = $product->primaryImage?->image_url ?? $product->image_url;
    @endphp
    
    <div class="position-relative bg-light text-center p-4 d-flex align-items-center justify-content-center" style="height: 220px;">
        <!-- Category Badge (Kholoud's design) -->
        <span class="badge bg-dark position-absolute top-0 start-0 m-3 px-3 py-2 fs-7 fw-semibold rounded-2 z-2">
            {{ $product->category->category_name ?? __('Hardware') }}
        </span>

        @if ($image && $image !== '/images/placeholder.png')
            @php
                $imgSrc = Str::startsWith($image, ['http://', 'https://']) ? $image : asset('storage/' . $image);
            @endphp
            <img class="img-fluid object-fit-contain h-100" src="{{ $imgSrc }}" alt="{{ $product->product_name }}">
        @else
            <div class="text-center text-muted">
                <i class="bi bi-image fs-1 opacity-50 d-block mb-1"></i>
                <span class="small fw-semibold">{{ __('No Image Available') }}</span>
            </div>
        @endif
        
        <!-- Wishlist Icon -->
        <div class="position-absolute top-0 end-0 m-3 z-2">
            @php
                $inWishlist = auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists();
            @endphp
            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-white btn-sm rounded-circle shadow-xs {{ $inWishlist ? 'text-danger' : 'text-dark' }} hover-danger" title="{{ __('Wishlist') }}">
                    <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                </button>
            </form>
        </div>
    </div>
    
    <div class="card-body p-4 d-flex flex-column">
        <h6 class="card-title fw-bold text-dark mb-1 text-truncate">
            <a href="{{ route('catalog.show', $product) }}" class="text-decoration-none text-dark hover-red">
                {{ $product->product_name }}
            </a>
        </h6>
        
        <p class="text-muted small text-truncate-2 mb-3 fs-7" style="height: 38px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
            {{ $product->description ?? 'High quality PC hardware component with official warranty.' }}
        </p>
        
        <div class="mt-auto d-flex align-items-center justify-content-between pt-2">
            <span class="fs-5 fw-bold text-dark">${{ number_format((float) $product->price, 2) }}</span>
            <div class="d-flex gap-2">
                <a href="{{ route('catalog.show', $product) }}" class="btn btn-dark btn-sm px-3 rounded-2 fw-semibold">{{ __('Details') }}</a>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm px-2 rounded-2" title="{{ __('Add to Cart') }}">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .product-card {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
    }
    .hover-red:hover {
        color: #db4444 !important;
    }
    .hover-danger:hover {
        background-color: #db4444 !important;
        color: white !important;
    }
</style>
