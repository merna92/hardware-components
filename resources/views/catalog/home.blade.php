<x-layout title="HardwareHub | Home">
    <section class="catalog-hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <p class="text-uppercase small fw-semibold mb-2">Build better. Play harder.</p>
                    <h1 class="display-5 fw-bold">The components your next PC needs.</h1>
                    <p class="lead text-white-50">Browse reliable hardware and find the right part for every build.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4">Shop products <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
                <div class="col-lg-5 text-center d-none d-lg-block"><i class="bi bi-pc-display-horizontal" style="font-size: 10rem"></i></div>
            </div>
        </div>
    </section>

    <main class="container py-5">
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div><p class="text-uppercase text-muted small mb-1">Browse by type</p><h2 class="section-title h3 mb-0">Shop categories</h2></div>
                <a href="{{ route('products.index') }}" class="text-decoration-none">View all</a>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                @forelse ($categories as $category)
                    <div class="col"><a class="category-card" href="{{ route('products.index', ['category' => $category->id]) }}"><i class="bi bi-cpu fs-3 text-danger"></i><h3 class="h6 mt-3 mb-1">{{ $category->category_name }}</h3><small class="text-muted">{{ $category->available_products_count }} available</small></a></div>
                @empty
                    <p class="text-muted">Categories will appear here after the database is seeded.</p>
                @endforelse
            </div>
        </section>

        <section>
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div><p class="text-uppercase text-muted small mb-1">Latest arrivals</p><h2 class="section-title h3 mb-0">Featured products</h2></div>
                <a href="{{ route('products.index') }}" class="text-decoration-none">All products <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                @forelse ($featuredProducts as $product)
                    <div class="col"><x-catalog.product-card :product="$product" /></div>
                @empty
                    <p class="text-muted">No available products yet.</p>
                @endforelse
            </div>
        </section>
    </main>
</x-layout>
