<x-layout.layout title="Products Management - Admin">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Products Management</h3>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-danger rounded-pill px-4 fw-semibold me-2">+ Add Product</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">Dashboard</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="fw-bold">{{ $product->product_name }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td class="fw-semibold">${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td><span class="badge {{ $product->status === 'Available' ? 'bg-success' : 'bg-secondary' }} px-3 py-2 fs-7">{{ $product->status }}</span></td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-dark me-2">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div>
</x-layout.layout>
