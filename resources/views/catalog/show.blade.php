<x-layout.layout :title="$product->product_name . ' - Hardware Components'">
    <main class="container py-5">
        <nav class="mb-4 small">
            <a href="{{ route('home') }}" class="text-muted text-decoration-none">{{ __('Home') }}</a> 
            <span class="text-muted mx-1">/</span> 
            <a href="{{ route('catalog.index', ['category' => $product->category_id]) }}" class="text-muted text-decoration-none">{{ $product->category->category_name }}</a> 
            <span class="text-muted mx-1">/</span> 
            <span class="fw-semibold text-dark">{{ $product->product_name }}</span>
        </nav>
        
        <div class="row g-5 bg-white p-4 rounded-4 shadow-sm">
            <section class="col-lg-6">
                @php
                    $mainImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                @endphp
                <div class="bg-light rounded-4 text-center p-4 mb-3 d-flex align-items-center justify-content-center" style="height: 380px;">
                    @if ($mainImage || $product->image_url)
                        @php
                            $showImg = $mainImage?->image_url ?? $product->image_url;
                            $showImgSrc = Str::startsWith($showImg, ['http://', 'https://']) ? $showImg : asset('storage/' . $showImg);
                        @endphp
                        <img id="mainProductImage" class="img-fluid object-fit-contain h-100" src="{{ $showImgSrc }}" alt="{{ $mainImage?->alt_text ?? $product->product_name }}">
                    @else
                        <i class="bi bi-cpu display-1 text-muted"></i>
                    @endif
                </div>
                
                @if ($product->images->isNotEmpty())
                    <div class="d-flex gap-2">
                        @foreach ($product->images as $image)
                            @php
                                $thumbSrc = Str::startsWith($image->image_url, ['http://', 'https://']) ? $image->image_url : asset('storage/' . $image->image_url);
                            @endphp
                            <img class="rounded border p-1 object-fit-contain cursor-pointer" style="width: 70px; height: 70px;" src="{{ $thumbSrc }}" alt="{{ $image->alt_text ?? $product->product_name }}" onclick="document.getElementById('mainProductImage').src=this.src">
                        @endforeach
                    </div>
                @endif
            </section>
            
            <section class="col-lg-6">
                <span class="text-danger fw-bold text-uppercase tracking-wider mb-2 d-inline-block">{{ $product->category->category_name }}</span>
                <h1 class="h2 fw-bold text-dark mb-3">{{ $product->product_name }}</h1>
                <div class="h3 fw-bold text-dark mb-3">${{ number_format((float) $product->price, 2) }}</div>
                
                <p class="text-secondary mb-4 leading-relaxed">{{ $product->description ?: __('No product description available.') }}</p>
                
                <div class="mb-4">
                    @if ($product->stock_quantity > 0)
                        <span class="badge text-bg-success px-3 py-2 fs-6"><i class="bi bi-check-circle-fill me-1"></i> {{ __('In Stock') }} ({{ $product->stock_quantity }} {{ __('available') }})</span>
                    @else
                        <span class="badge text-bg-danger px-3 py-2 fs-6"><i class="bi bi-x-circle-fill me-1"></i> {{ __('Out of Stock') }}</span>
                    @endif
                </div>
                
                <div class="d-flex gap-3">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="form-control text-center" style="width: 80px;" @disabled($product->stock_quantity === 0)>
                        <button class="btn btn-danger btn-lg px-4 rounded-3 fw-semibold" type="submit" @disabled($product->stock_quantity === 0)>
                            <i class="bi bi-cart-plus me-2"></i> {{ __('Add to Cart') }}
                        </button>
                    </form>

                    @php
                        $inWishlist = auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists();
                    @endphp
                    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-secondary btn-lg rounded-3 {{ $inWishlist ? 'text-danger border-danger' : '' }}" type="submit" title="{{ __('Add to Wishlist') }}">
                            <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Specs Table -->
                <div class="mt-5 pt-3 border-top">
                    <h5 class="fw-bold mb-3">{{ __('Specifications') }}</h5>
                    <div class="row row-cols-2 g-3">
                        <div class="col"><div class="p-3 bg-light rounded-3"><small class="text-muted d-block">{{ __('Warranty') }}</small><strong class="text-dark">{{ $product->warranty_period ?: '3 Years' }}</strong></div></div>
                        <div class="col"><div class="p-3 bg-light rounded-3"><small class="text-muted d-block">{{ __('Status') }}</small><strong class="text-dark">{{ str_replace('_', ' ', $product->status) }}</strong></div></div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout.layout>
