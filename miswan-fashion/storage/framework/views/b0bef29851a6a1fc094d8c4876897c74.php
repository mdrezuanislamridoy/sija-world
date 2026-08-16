<?php $__env->startSection('title', 'অর্ডার ট্র্যাক করুন - ' . ($globalSetting->site_name ?? 'Miswan Fashion')); ?>

<?php $__env->startSection('content'); ?>
<div class="track-order-page-area py-5 bg-light" style="min-height: 70vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <i class="fa fa-map-marker fa-3x mb-3"></i>
                        <h3 class="font-weight-bold m-0">অর্ডার ট্র্যাক করুন</h3>
                        <p class="m-0 mt-2 opacity-75">আপনার অর্ডারের বর্তমান অবস্থা জানতে তথ্য প্রদান করুন</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger font-weight-bold">
                                <i class="fa fa-exclamation-triangle mr-2"></i> <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('track.order.post')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-dark">ফোন নম্বর (Phone Number)</label>
                                <input type="text" name="phone" class="form-control form-control-lg" placeholder="অর্ডার করার সময় দেয়া ফোন নম্বর" value="<?php echo e(old('phone')); ?>" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-dark">কাস্টমারের নাম (Customer Name)</label>
                                <input type="text" name="customer_name" class="form-control form-control-lg" placeholder="অর্ডার করার সময় দেয়া নাম" value="<?php echo e(old('customer_name')); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg font-weight-bold shadow-sm">
                                <i class="fa fa-search mr-2"></i> অর্ডার খুঁজুন
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/frontend/track_order.blade.php ENDPATH**/ ?>