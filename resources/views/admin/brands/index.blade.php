<x-layout.layout :title="__('Brands Management') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">{{ __('Brands Management') }}</h3>
            <div>
                <a href="{{ route('admin.brands.create') }}" class="btn btn-danger rounded-pill px-4 fw-semibold me-2">+ {{ __('Add Brand') }}</a>
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
                            <th>#</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Products Count') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td class="fw-bold">{{ $brand->brand_name }}</td>
                                <td class="text-muted">{{ \Illuminate\Support\Str::limit($brand->description, 50) }}</td>
                                <td><span class="badge bg-secondary px-3 py-2 fs-7">{{ $brand->products_count }} {{ __('products') }}</span></td>
                                <td>
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-dark me-2">{{ __('Edit') }}</a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" data-confirm="{{ __('Delete brand?') }}" data-confirm-text="{{ __('This brand will be removed from product selection.') }}" data-confirm-button="{{ __('Yes, delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $brands->links() }}</div>
        </div>
    </div>
</x-layout.layout>
