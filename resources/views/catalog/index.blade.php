<x-layout.layout title="Catalog - Hardware Components">
    <main class="container py-5">
        <div class="mb-4">
            <span class="text-danger fw-bold text-uppercase tracking-wider">{{ __('Catalog') }}</span>
            <h1 class="h2 fw-bold text-dark mb-1">{{ __('Find the Right Component') }}</h1>
        </div>
        <div class="row g-4">
            <!-- Kholoud's Sidebar Filtering -->
            <aside class="col-lg-3">
                <form class="card border-0 shadow-sm p-4 rounded-4 bg-white" method="GET" action="{{ route('catalog.index') }}">
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <h5 class="fw-bold mb-0">{{ __('Filters') }}</h5>
                        <a href="{{ route('catalog.index') }}" class="small text-danger text-decoration-none">{{ __('Reset All') }}</a>
                    </div>
                    
                    <!-- Search Input -->
                    <div class="mb-3">
                        <label for="search" class="form-label fw-semibold fs-7">{{ __('Search') }}</label>
                        <input id="search" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control bg-light" placeholder="{{ __('Product name...') }}">
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold fs-7">{{ __('Category') }}</label>
                        <select id="category" name="category" class="form-select bg-light">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(($filters['category'] ?? null) == $category->id)>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label for="min_price" class="form-label fw-semibold fs-7">{{ __('Min Price') }} ($)</label>
                            <input id="min_price" type="number" min="0" step="0.01" name="min_price" value="{{ $filters['min_price'] ?? '' }}" class="form-control bg-light">
                        </div>
                        <div class="col-6">
                            <label for="max_price" class="form-label fw-semibold fs-7">{{ __('Max Price') }} ($)</label>
                            <input id="max_price" type="number" min="0" step="0.01" name="max_price" value="{{ $filters['max_price'] ?? '' }}" class="form-control bg-light">
                        </div>
                    </div>
                    
                    <!-- Sorting -->
                    <div class="mb-4">
                        <label for="sort" class="form-label fw-semibold fs-7">{{ __('Sort By') }}</label>
                        <select id="sort" name="sort" class="form-select bg-light">
                            <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>{{ __('Latest') }}</option>
                            <option value="price_low" @selected(($filters['sort'] ?? '') === 'price_low')>{{ __('Price: Low to High') }}</option>
                            <option value="price_high" @selected(($filters['sort'] ?? '') === 'price_high')>{{ __('Price: High to Low') }}</option>
                            <option value="name" @selected(($filters['sort'] ?? '') === 'name')>{{ __('Name') }}</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-danger w-100 py-2 rounded-3 fw-semibold" type="submit">{{ __('Apply Filters') }}</button>
                </form>
            </aside>
            
            <!-- Products Grid -->
            <section class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="text-muted mb-0 fw-medium">{{ $products->total() }} {{ __('product(s) found') }}</p>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger">{{ __('Please check your filter values.') }}</div>
                @endif
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    @forelse ($products as $product)
                        <div class="col">
                            <x-catalog.product-card :product="$product" />
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center border rounded-4 py-5 bg-white shadow-sm">
                                <i class="bi bi-search fs-1 text-muted"></i>
                                <h4 class="h5 mt-3 fw-bold">{{ __('No products match these filters.') }}</h4>
                                <a href="{{ route('catalog.index') }}" class="btn btn-outline-danger btn-sm mt-2">{{ __('Clear All Filters') }}</a>
                            </div>
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </section>
        </div>
    </main>
</x-layout.layout>
