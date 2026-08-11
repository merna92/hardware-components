<x-layout title="Add Category">
    <main class="container py-5">
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> Back to categories
            </a>
            <h1 class="h3 fw-bold mt-2"><span class="exclusive-pill"></span>Add Category</h1>
        </div>

        @include('admin.partials.alerts')

        <form method="POST" action="{{ route('admin.categories.store') }}" class="card admin-card-exclusive">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button class="btn btn-exclusive">Save</button>
            </div>
        </form>
    </main>
</x-layout>
