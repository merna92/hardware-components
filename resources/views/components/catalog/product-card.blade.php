@props(['product'])
<article class="product-card">
    @php($image = $product->primaryImage?->image_url ?? $product->image_url)
    @if ($image)<img class="product-card__image" src="{{ $image }}" alt="{{ $product->product_name }}">@else<div class="image-placeholder"><i class="bi bi-cpu"></i></div>@endif
    <div class="p-3"><p class="product-meta mb-1">{{ $product->category->category_name }}</p><h3 class="h6"><a class="text-decoration-none text-dark stretched-link" href="{{ route('products.show', $product) }}">{{ $product->product_name }}</a></h3><p class="product-price mb-0">${{ number_format((float) $product->price, 2) }}</p></div>
</article>
