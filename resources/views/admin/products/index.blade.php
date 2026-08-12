<x-layout.layout :title="__('Products Management') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">{{ __('Products Management') }}</h3>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-danger rounded-pill px-4 fw-semibold me-2">+ {{ __('Add Product') }}</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">{{ __('Dashboard') }}</a>
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
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Stock') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="fw-bold">
                                    {{ $product->product_name }}
                                    @if($product->trashed())
                                        <span class="badge bg-warning text-dark ms-2">{{ __('Deleted') }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->category?->category_name ?? __('Uncategorized') }}</td>
                                <td class="fw-semibold">${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td><span class="badge {{ $product->status === 'Available' ? 'bg-success' : 'bg-secondary' }} px-3 py-2 fs-7">{{ __($product->status) }}</span></td>
                                <td>
                                    @if($product->trashed())
                                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline" data-confirm="Restore product?" data-confirm-text="This product will appear in the catalog again if it is available." data-confirm-icon="question" data-confirm-button-color="#198754" data-confirm-button="Yes, restore">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success">{{ __('Restore') }}</button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-dark me-2">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" data-confirm="Delete product?" data-confirm-text="The product will be soft deleted and can be restored by an admin." data-confirm-button="Yes, delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                                        </form>
                                    @endif
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
