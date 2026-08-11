<div class="mb-3">
    <label class="form-label fw-semibold">Coupon Code</label>
    <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code ?? '') }}" placeholder="SAVE10" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Discount Type</label>
    <select name="type" class="form-select" required>
        <option value="Percentage" @selected(old('type', $coupon->type ?? '') === 'Percentage')>Percentage (%)</option>
        <option value="Fixed_Amount" @selected(old('type', $coupon->type ?? '') === 'Fixed_Amount')>Fixed Amount ($)</option>
    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Discount Value</label>
    <input type="number" step="0.01" name="value" class="form-control" value="{{ old('value', $coupon->value ?? '') }}" placeholder="10" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Usage Limit</label>
    <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}" placeholder="100">
</div>
<div class="mb-4">
    <label class="form-label fw-semibold">Status</label>
    <select name="status" class="form-select" required>
        <option value="Active" @selected(old('status', $coupon->status ?? '') === 'Active')>Active</option>
        <option value="Disabled" @selected(old('status', $coupon->status ?? '') === 'Disabled')>Disabled</option>
        <option value="Expired" @selected(old('status', $coupon->status ?? '') === 'Expired')>Expired</option>
    </select>
</div>
