<x-layout title="Edit Product">
    <main class="container py-5">
        <div class="mb-4">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> Back to products
            </a>
            <h1 class="h3 fw-bold mt-2"><span class="exclusive-pill"></span>Edit Product</h1>
        </div>

        @include('admin.partials.alerts')

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="card admin-card-exclusive">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.products.form', ['product' => $product])
                <button class="btn btn-exclusive">Update</button>
            </div>
        </form>
    </main>
</x-layout>
