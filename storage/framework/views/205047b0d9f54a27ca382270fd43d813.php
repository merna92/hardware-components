<?php if($errors->any()): ?>
    <div class="alert alert-danger">Please check the form data.</div>
<?php endif; ?>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Coupon Code</label>
        <input type="text" name="code" value="<?php echo e(old('code', $coupon->code ?? '')); ?>" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Type</label>
        <select name="type" class="form-select" required>
            <?php $__currentLoopData = ['Percentage', 'Fixed_Amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type); ?>" <?php if(old('type', $coupon->type ?? '') == $type): echo 'selected'; endif; ?>><?php echo e($type); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Value</label>
        <input type="number" step="0.01" name="value" value="<?php echo e(old('value', $coupon->value ?? '')); ?>" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Usage Limit</label>
        <input type="number" name="usage_limit" value="<?php echo e(old('usage_limit', $coupon->usage_limit ?? '')); ?>" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Start Date</label>
        <input type="date" name="start_date" value="<?php echo e(old('start_date', $coupon->start_date ?? '')); ?>" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">End Date</label>
        <input type="date" name="end_date" value="<?php echo e(old('end_date', $coupon->end_date ?? '')); ?>" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <?php $__currentLoopData = ['Active', 'Expired', 'Disabled', 'Scheduled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status); ?>" <?php if(old('status', $coupon->status ?? 'Active') == $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/admin/coupons/form.blade.php ENDPATH**/ ?>