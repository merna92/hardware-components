<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.layout','data' => ['title' => 'Edit Coupon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Coupon']); ?>
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Coupons / Edit</div>

            <div class="admin-title-row">
                <h2>Edit Coupon</h2>
            </div>

            <form action="<?php echo e(route('admin.coupons.update', $coupon)); ?>" method="POST" class="admin-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <?php echo $__env->make('admin.coupons.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <button class="btn btn-dark mt-4 px-4" type="submit">Update Coupon</button>
                <a href="<?php echo e(route('admin.coupons.index')); ?>" class="btn btn-outline-dark mt-4 px-4">Cancel</a>
            </form>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/admin/coupons/edit.blade.php ENDPATH**/ ?>