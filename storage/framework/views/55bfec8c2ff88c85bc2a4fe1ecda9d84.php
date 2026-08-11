<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.layout','data' => ['title' => 'Coupons']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Coupons']); ?>
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Coupons</div>

            <div class="admin-title-row">
                <h2>Coupons Management</h2>
                <div class="admin-actions">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-dark px-4">Dashboard</a>
                    <a href="<?php echo e(route('admin.coupons.create')); ?>" class="btn btn-dark px-4">Create Coupon</a>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <div class="admin-panel p-0">
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Usage</th>
                                <th>Status</th>
                                <th>Dates</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-bold"><?php echo e($coupon->code); ?></td>
                                    <td><?php echo e($coupon->type); ?></td>
                                    <td><?php echo e(number_format($coupon->value, 2)); ?></td>
                                    <td><?php echo e($coupon->used_count); ?> / <?php echo e($coupon->usage_limit ?? 'Unlimited'); ?></td>
                                    <td><span class="badge text-bg-light"><?php echo e($coupon->status); ?></span></td>
                                    <td><?php echo e($coupon->start_date ?? '-'); ?> : <?php echo e($coupon->end_date ?? '-'); ?></td>
                                    <td class="text-end">
                                        <a href="<?php echo e(route('admin.coupons.edit', $coupon)); ?>" class="btn btn-outline-dark btn-sm">Edit</a>
                                        <form action="<?php echo e(route('admin.coupons.delete', $coupon)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4"><?php echo e($coupons->links()); ?></div>
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
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/admin/coupons/index.blade.php ENDPATH**/ ?>