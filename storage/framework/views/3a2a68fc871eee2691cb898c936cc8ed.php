<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.layout','data' => ['title' => 'Admin Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Admin Dashboard']); ?>
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin Dashboard</div>

            <div class="admin-title-row">
                <div>
                    <h2>Admin Dashboard</h2>
                    <p class="text-muted mb-0 mt-2">Analytics overview for orders, customers, products and coupons.</p>
                </div>
                <div class="admin-actions">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-dark px-4">Users</a>
                    <a href="<?php echo e(route('admin.coupons.index')); ?>" class="btn btn-dark px-4">Coupons</a>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Total Sales</p>
                        <h3><?php echo e(number_format($totalSales, 2)); ?> EGP</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Orders</p>
                        <h3><?php echo e($ordersCount); ?></h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Customers</p>
                        <h3><?php echo e($customersCount); ?></h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="admin-stat-card">
                        <p>Active Coupons</p>
                        <h3><?php echo e($activeCoupons); ?></h3>
                    </div>
                </div>
            </div>

            <div class="admin-panel">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="admin-panel-title mb-0">Latest Orders</h5>
                    <span class="badge text-bg-light">Products: <?php echo e($productsCount); ?></span>
                </div>

                <?php if($latestOrders->isEmpty()): ?>
                    <div class="alert alert-info mb-0">No orders yet.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table admin-table align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $latestOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($order->id); ?></td>
                                        <td><span class="badge text-bg-secondary"><?php echo e($order->status); ?></span></td>
                                        <td><?php echo e($order->payment_status); ?></td>
                                        <td><?php echo e(number_format($order->final_amount, 2)); ?> EGP</td>
                                        <td><?php echo e($order->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
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
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>