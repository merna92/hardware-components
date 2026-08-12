<x-layout.layout :title="__('Edit Brand') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold mb-4">{{ __('Edit Brand') }} #{{ $brand->id }}</h4>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('Brand Name') }}</label>
                            <input type="text" name="brand_name" class="form-control" value="{{ old('brand_name', $brand->brand_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $brand->description) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">{{ __('Logo URL') }}</label>
                            <input type="text" name="logo_url" class="form-control" value="{{ old('logo_url', $brand->logo_url) }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary px-4">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-danger px-4 fw-semibold">{{ __('Update Brand') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
