<x-layout title="Admin Products">
    <main class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1"><span class="exclusive-pill"></span>Products</h1>
                <p class="text-muted mb-0">Manage hardware products, prices, stock, and images.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-exclusive">
                <i class="bi bi-plus-circle me-1"></i> Add Product
            </a>
        </div>

        @include('admin.partials.alerts')

        <div class="card admin-card-exclusive">
            <div class="table-responsive">
                <table class="table admin-table-exclusive align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td style="width: 84px;">
                                    @if ($product->image_url)
                                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->product_name }}" class="rounded object-fit-cover" width="56" height="56">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $product->product_name }}</td>
                                <td>{{ $product->category?->category_name ?? 'N/A' }}</td>
                                <td>${{ number_format((float) $product->price, 2) }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td><span class="badge text-bg-secondary">{{ $product->status }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this product?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $products->links('pagination::bootstrap-5') }}</div>
    </main>
</x-layout>
