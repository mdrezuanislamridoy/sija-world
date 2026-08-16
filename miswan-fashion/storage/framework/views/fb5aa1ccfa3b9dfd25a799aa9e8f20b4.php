<?php $__env->startSection('title', $page->title . ' - ' . ($globalSetting->site_name ?? 'Miswan Fashion')); ?>

<?php $__env->startSection('content'); ?>
<div class="static-page-area py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($page->title); ?></li>
            </ol>
        </nav>

        <div class="card border-0 shadow-sm rounded-lg p-4 p-md-5 bg-white">
            <h1 class="font-weight-bold text-dark mb-4 border-bottom pb-3"><?php echo e($page->title); ?></h1>
            <div class="page-body text-muted" style="line-height: 1.8; font-size: 15px;">
                <?php echo $page->content; ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/frontend/page.blade.php ENDPATH**/ ?>