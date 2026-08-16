<?php $__env->startSection('title', 'Store Settings'); ?>
<?php $__env->startSection('page_title', 'General & Brand Settings'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white" style="max-width: 800px;">
    <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Store Configuration</h5>

    <form method="POST" action="<?php echo e(route('admin.settings.update')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-row">
            <div class="form-group col-md-6 mb-3">
                <label class="font-weight-bold small">Store Name <span class="text-danger">*</span></label>
                <input type="text" name="site_name" class="form-control" value="<?php echo e(old('site_name', $setting->site_name ?? 'Miswan Fashion')); ?>" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label class="font-weight-bold small">SEO Browser Title <span class="text-danger">*</span></label>
                <input type="text" name="site_title" class="form-control" value="<?php echo e(old('site_title', $setting->site_title ?? 'Miswanfashion | Bangladesh’s Leading Fashion Brand')); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6 mb-3">
                <label class="font-weight-bold small">Hotline Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $setting->phone ?? '+8801700000000')); ?>" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label class="font-weight-bold small">Customer Support Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $setting->email ?? 'support@miswanfashion.com')); ?>" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="font-weight-bold small">Office Address <span class="text-danger">*</span></label>
            <input type="text" name="address" class="form-control" value="<?php echo e(old('address', $setting->address ?? 'House #12, Road #5, Dhanmondi, Dhaka')); ?>" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4 mb-3">
                <label class="font-weight-bold small">Currency Symbol <span class="text-danger">*</span></label>
                <input type="text" name="currency_symbol" class="form-control" value="<?php echo e(old('currency_symbol', $setting->currency_symbol ?? 'TK')); ?>" required>
            </div>
            <div class="form-group col-md-4 mb-3">
                <label class="font-weight-bold small">Delivery Fee (Inside City) <span class="text-danger">*</span></label>
                <input type="number" step="any" name="shipping_inside_city" class="form-control" value="<?php echo e(old('shipping_inside_city', $setting->shipping_inside_city ?? 60)); ?>" required>
            </div>
            <div class="form-group col-md-4 mb-3">
                <label class="font-weight-bold small">Delivery Fee (Outside City) <span class="text-danger">*</span></label>
                <input type="number" step="any" name="shipping_outside_city" class="form-control" value="<?php echo e(old('shipping_outside_city', $setting->shipping_outside_city ?? 120)); ?>" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="font-weight-bold small">Facebook Page URL</label>
            <input type="text" name="facebook_url" class="form-control" value="<?php echo e(old('facebook_url', $setting->facebook_url ?? 'https://www.facebook.com/p/Miswan-Fashion-61550113106815/')); ?>">
        </div>

        <div class="form-group mb-4">
            <label class="font-weight-bold small">Announcement Marquee Text</label>
            <input type="text" name="announcement_text" class="form-control" value="<?php echo e(old('announcement_text', $setting->announcement_text ?? 'Upto 50% Discount on selected product. Ending Soon.')); ?>">
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold"><i class="fa fa-save mr-1"></i> Save Store Settings</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>