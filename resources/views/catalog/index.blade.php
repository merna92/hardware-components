<x-layout title="HardwareHub | Products">
    <main class="container py-5">
        <div class="mb-4"><p class="text-uppercase text-muted small mb-1">Catalog</p><h1 class="section-title h2">Find the right component</h1></div>
        <div class="row g-4">
            <aside class="col-lg-3">
                <form class="filter-card" method="GET" action="{{ route('products.index') }}">
                    <div class="d-flex justify-content-between align-items-center mb-3"><h2 class="h5 mb-0">Filters</h2><a href="{{ route('products.index') }}" class="small">Reset</a></div>
                    <div class="mb-3"><label for="search" class="form-label">Search</label><input id="search" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control" placeholder="Product name..."></div>
                    <div class="mb-3"><label for="category" class="form-label">Category</label><select id="category" name="category" class="form-select"><option value="">All categories</option>@foreach ($categories as $category)<option value="{{ $category->id }}" @selected(($filters['category'] ?? null) == $category->id)>{{ $category->category_name }}</option>@endforeach</select></div>
                    <div class="row g-2 mb-3"><div class="col-6"><label for="min_price" class="form-label">Min price</label><input id="min_price" type="number" min="0" step="0.01" name="min_price" value="{{ $filters['min_price'] ?? '' }}" class="form-control"></div><div class="col-6"><label for="max_price" class="form-label">Max price</label><input id="max_price" type="number" min="0" step="0.01" name="max_price" value="{{ $filters['max_price'] ?? '' }}" class="form-control"></div></div>
                    <div class="mb-4"><label for="sort" class="form-label">Sort by</label><select id="sort" name="sort" class="form-select"><option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Latest</option><option value="price_low" @selected(($filters['sort'] ?? '') === 'price_low')>Price: low to high</option><option value="price_high" @selected(($filters['sort'] ?? '') === 'price_high')>Price: high to low</option><option value="name" @selected(($filters['sort'] ?? '') === 'name')>Name</option></select></div>
                    <button class="btn btn-dark w-100" type="submit">Apply filters</button>
                </form>
            </aside>
            <section class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3"><p class="text-muted mb-0">{{ $products->total() }} product(s) found</p></div>
                @if ($errors->any())<div class="alert alert-danger">Please check your filter values.</div>@endif
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    @forelse ($products as $product)<div class="col"><x-catalog.product-card :product="$product" /></div>@empty<div class="col-12"><div class="text-center border rounded-4 py-5"><i class="bi bi-search fs-1 text-muted"></i><h2 class="h5 mt-3">No products match these filters.</h2><a href="{{ route('products.index') }}">Clear filters</a></div></div>@endforelse
                </div>
                <div class="mt-5">{{ $products->links() }}</div>
            </section>
        </div>
    </main>
</x-layout>
