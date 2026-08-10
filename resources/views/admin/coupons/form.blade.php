@if($errors->any())
    <div class="alert alert-danger">Please check the form data.</div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Coupon Code</label>
        <input type="text" name="code" value="{{ old('code', $coupon->code ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Type</label>
        <select name="type" class="form-select" required>
            @foreach(['Percentage', 'Fixed_Amount'] as $type)
                <option value="{{ $type }}" @selected(old('type', $coupon->type ?? '') == $type)>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Value</label>
        <input type="number" step="0.01" name="value" value="{{ old('value', $coupon->value ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Usage Limit</label>
        <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Start Date</label>
        <input type="date" name="start_date" value="{{ old('start_date', $coupon->start_date ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">End Date</label>
        <input type="date" name="end_date" value="{{ old('end_date', $coupon->end_date ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            @foreach(['Active', 'Expired', 'Disabled', 'Scheduled'] as $status)
                <option value="{{ $status }}" @selected(old('status', $coupon->status ?? 'Active') == $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>
