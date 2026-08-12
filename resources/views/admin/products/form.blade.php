<div class="mb-3">
    <label class="form-label fw-semibold">Product Name</label>
    <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Category</label>
    <select name="category_id" class="form-select" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Brand</label>
    <select name="brand_id" class="form-select">
        <option value="">Select Brand</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') == $brand->id)>
                {{ $brand->brand_name }}
            </option>
        @endforeach
    </select>
</div>
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Price ($)</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Stock Quantity</label>
        <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}" required>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Description</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Status</label>
    <select name="status" class="form-select" required>
        @foreach($statuses as $st)
            <option value="{{ $st }}" @selected(old('status', $product->status ?? '') === $st)>{{ $st }}</option>
        @endforeach
    </select>
</div>

{{-- Product Image Upload (Up to 4 images) --}}
<div class="mb-4">
    <label class="form-label fw-semibold">Product Images (Max 4)</label>

    {{-- Show current images if editing --}}
    @if(isset($product) && $product->images->isNotEmpty())
        <div class="mb-2 d-flex gap-2 flex-wrap">
            @foreach($product->images as $img)
                <img src="{{ Str::startsWith($img->image_url, 'http') ? $img->image_url : asset('storage/' . $img->image_url) }}"
                     alt="{{ $product->product_name }}"
                     class="rounded-3 border shadow-sm"
                     style="width: 80px; height: 80px; object-fit: contain; background:#f8f9fa; padding:4px;">
            @endforeach
            <div class="w-100">
                <p class="text-muted small mt-1">Current images — uploading new ones will replace these.</p>
            </div>
        </div>
    @elseif(isset($product) && $product->image_url)
        <div class="mb-2">
            <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}"
                 alt="{{ $product->product_name }}"
                 class="rounded-3 border shadow-sm"
                 style="width: 80px; height: 80px; object-fit: contain; background:#f8f9fa; padding:4px;">
            <p class="text-muted small mt-1">Current image — uploading new ones will replace it.</p>
        </div>
    @endif

    <div class="image-upload-zone border-2 border-dashed rounded-4 p-4 text-center position-relative"
         style="border: 2px dashed #dee2e6; cursor: pointer; transition: all 0.3s ease;"
         id="imageDropZone"
         onclick="document.getElementById('image_input').click()">
        <i class="bi bi-images fs-1 text-muted mb-2 d-block"></i>
        <p class="text-muted mb-1 fw-semibold">Click to upload or drag & drop</p>
        <p class="text-muted small mb-0">PNG, JPG, WEBP (Max 4 images, up to 2MB each)</p>
        <input type="file" name="images[]" id="image_input" accept="image/*" class="d-none" multiple onchange="previewImages(this)">
    </div>

    {{-- Image Previews --}}
    <div id="imagePreviewContainer" class="mt-3 d-none d-flex gap-2 flex-wrap">
        <!-- Previews will be injected here via JS -->
    </div>
    <div id="imagePreviewActions" class="mt-2 d-none">
        <p class="text-success small mb-1"><i class="bi bi-check-circle me-1"></i>Images selected.</p>
        <button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="clearImages()">
            <i class="bi bi-x-circle me-1"></i>Remove All
        </button>
    </div>
</div>

<script>
    function previewImages(input) {
        const files = input.files;
        if (!files || files.length === 0) return;
        
        if (files.length > 4) {
            alert('You can only upload a maximum of 4 images.');
            clearImages();
            return;
        }

        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = ''; // Clear previous previews
        
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded-3 border shadow-sm';
                img.style.cssText = 'width: 80px; height: 80px; object-fit: contain; background:#f8f9fa; padding:4px;';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });

        container.classList.remove('d-none');
        document.getElementById('imagePreviewActions').classList.remove('d-none');
        document.getElementById('imageDropZone').style.borderColor = '#db4444';
    }

    function clearImages() {
        document.getElementById('image_input').value = '';
        document.getElementById('imagePreviewContainer').innerHTML = '';
        document.getElementById('imagePreviewContainer').classList.add('d-none');
        document.getElementById('imagePreviewActions').classList.add('d-none');
        document.getElementById('imageDropZone').style.borderColor = '#dee2e6';
    }

    // Drag & Drop
    const zone = document.getElementById('imageDropZone');
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor = '#db4444'; zone.style.background = '#fff5f5'; });
    zone.addEventListener('dragleave', e => { zone.style.borderColor = '#dee2e6'; zone.style.background = ''; });
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.style.borderColor = '#dee2e6';
        zone.style.background = '';
        const dt = e.dataTransfer;
        document.getElementById('image_input').files = dt.files;
        previewImages(document.getElementById('image_input'));
    });
</script>
