<x-layout.layout title="Categories Management - Admin">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Categories Management</h3>
            <div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-danger rounded-pill px-4 fw-semibold me-2">+ Add Category</a>
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Products Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td class="fw-bold">{{ $category->category_name }}</td>
                                <td class="text-muted">{{ Str::limit($category->description, 50) }}</td>
                                <td><span class="badge bg-secondary px-3 py-2 fs-7">{{ $category->products_count }} products</span></td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-dark me-2">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $categories->links() }}</div>
        </div>
    </div>
</x-layout.layout>
