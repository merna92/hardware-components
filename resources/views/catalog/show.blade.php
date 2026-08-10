<x-layout :title="$product->product_name . ' | HardwareHub'">
    <main class="container py-5">
        <nav class="mb-4 small"><a href="{{ route('home') }}">Home</a> <span class="text-muted mx-1">/</span> <a href="{{ route('products.index', ['category' => $product->category_id]) }}">{{ $product->category->category_name }}</a> <span class="text-muted mx-1">/</span> {{ $product->product_name }}</nav>
        <div class="row g-5">
            <section class="col-lg-6">
                @php($mainImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first())
                @if ($mainImage || $product->image_url)<img id="mainProductImage" class="detail-main-image" src="{{ $mainImage?->image_url ?? $product->image_url }}" alt="{{ $mainImage?->alt_text ?? $product->product_name }}">@else<div class="detail-main-image image-placeholder"><i class="bi bi-cpu"></i></div>@endif
                @if ($product->images->isNotEmpty())<div class="d-flex gap-2 mt-3">@foreach ($product->images as $image)<img class="product-thumb" src="{{ $image->image_url }}" alt="{{ $image->alt_text ?? $product->product_name }}" onclick="document.getElementById('mainProductImage').src=this.src">@endforeach</div>@endif
            </section>
            <section class="col-lg-6">
                <p class="text-danger fw-semibold mb-2">{{ $product->category->category_name }}</p><h1 class="section-title display-6">{{ $product->product_name }}</h1><p class="product-price my-3">${{ number_format((float) $product->price, 2) }}</p>
                <p class="mb-4">{{ $product->description ?: 'No product description has been added yet.' }}</p>
                @if ($product->stock_quantity > 0)<p class="text-success"><i class="bi bi-check-circle-fill me-1"></i> In stock ({{ $product->stock_quantity }} available)</p>@else<p class="text-danger"><i class="bi bi-x-circle-fill me-1"></i> Out of stock</p>@endif
                <button class="btn btn-dark btn-lg" type="button" @disabled($product->stock_quantity === 0)><i class="bi bi-cart-plus me-1"></i> Add to cart</button>
            </section>
        </div>
        <section class="mt-5 pt-3"><h2 class="section-title h3 mb-4">Technical details</h2><div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3"><div class="col"><div class="spec-card"><span class="spec-card__label">Category</span>{{ $product->category->category_name }}</div></div><div class="col"><div class="spec-card"><span class="spec-card__label">Warranty</span>{{ $product->warranty_period ?: 'Not specified' }}</div></div><div class="col"><div class="spec-card"><span class="spec-card__label">Release date</span>{{ $product->release_date?->format('d M Y') ?? 'Not specified' }}</div></div><div class="col"><div class="spec-card"><span class="spec-card__label">Availability</span>{{ str_replace('_', ' ', $product->status) }}</div></div></div></section>
    </main>
</x-layout>
