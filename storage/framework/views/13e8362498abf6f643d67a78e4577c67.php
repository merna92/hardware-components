<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Hardware Components'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Hardware Components'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(file_exists(public_path('build/manifest.json'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/ali-layout.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title><?php echo e($title); ?></title>
</head>
<body>
    <?php if (isset($component)) { $__componentOriginal716b2e1b28998879cf545b7ca2032129 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal716b2e1b28998879cf545b7ca2032129 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.nav','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout.nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal716b2e1b28998879cf545b7ca2032129)): ?>
<?php $attributes = $__attributesOriginal716b2e1b28998879cf545b7ca2032129; ?>
<?php unset($__attributesOriginal716b2e1b28998879cf545b7ca2032129); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal716b2e1b28998879cf545b7ca2032129)): ?>
<?php $component = $__componentOriginal716b2e1b28998879cf545b7ca2032129; ?>
<?php unset($__componentOriginal716b2e1b28998879cf545b7ca2032129); ?>
<?php endif; ?>
    <?php echo e($slot); ?>

    <?php if (isset($component)) { $__componentOriginal4766510e0268a7a5917e77b146281554 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4766510e0268a7a5917e77b146281554 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4766510e0268a7a5917e77b146281554)): ?>
<?php $attributes = $__attributesOriginal4766510e0268a7a5917e77b146281554; ?>
<?php unset($__attributesOriginal4766510e0268a7a5917e77b146281554); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4766510e0268a7a5917e77b146281554)): ?>
<?php $component = $__componentOriginal4766510e0268a7a5917e77b146281554; ?>
<?php unset($__componentOriginal4766510e0268a7a5917e77b146281554); ?>
<?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\Users\Gergs\Documents\Codex\2026-08-10\5-5\work\hardware-components-main\hardware-components-main\resources\views/components/layout/layout.blade.php ENDPATH**/ ?>