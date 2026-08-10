<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <h1 class="fw-bold mb-3">Hardware Components Store</h1>
                    <p class="text-muted mb-4">Admin dashboard for analytics, users management and coupons management.</p>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-dark px-4">Open Dashboard</a>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 border rounded bg-light">
                        <h5 class="fw-bold">Person 4</h5>
                        <p class="mb-0 text-muted">Admin Dashboard Analytics, Coupons and Users Management.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/welcome.blade.php ENDPATH**/ ?>