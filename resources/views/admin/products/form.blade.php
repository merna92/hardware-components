<div class="row g-3">
    <div class="col-12 col-md-6">
        <label class="form-label">Product Name</label>
        <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product?->product_name) }}" required>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id', $product?->category_id) === $category->id)>{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product?->price) }}" required>
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label">Stock Quantity</label>
        <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $product?->stock_quantity ?? 0) }}" required>
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $product?->status ?? 'Available') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label">Warranty Period</label>
        <input type="text" name="warranty_period" class="form-control" value="{{ old('warranty_period', $product?->warranty_period) }}">
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label">Release Date</label>
        <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $product?->release_date?->format('Y-m-d')) }}">
    </div>
    <div class="col-12">
        <label class="form-label">Product Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $product?->description) }}</textarea>
    </div>
</div>
<hr>
