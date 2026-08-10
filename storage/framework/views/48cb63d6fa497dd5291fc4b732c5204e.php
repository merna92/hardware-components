<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.layout','data' => ['title' => 'Users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Users']); ?>
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Users</div>

            <div class="admin-title-row">
                <h2>Users Management</h2>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-dark px-4">Dashboard</a>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <div class="admin-panel p-0">
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->phone_number ?? '-'); ?></td>
                                    <td><span class="badge text-bg-light"><?php echo e($user->role_type); ?></span></td>
                                    <td class="text-end">
                                        <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn btn-outline-dark btn-sm">Edit</a>
                                        <form action="<?php echo e(route('admin.users.delete', $user)); ?>" method="POST" class="d-inline">
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

            <div class="mt-4"><?php echo e($users->links()); ?></div>
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
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/admin/users/index.blade.php ENDPATH**/ ?>