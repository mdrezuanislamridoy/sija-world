<?php $__env->startSection('title', 'Add New Product'); ?>
<?php $__env->startSection('page_title', 'Create Product'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">Add New Product</h5>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left mr-1"></i> Back to Catalog</a>
    </div>

    <?php if(isset($errors) && $errors->any()): ?>
        <div class="alert alert-danger p-3 small">
            <ul class="m-0 pl-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.products.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Product Title <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" placeholder="e.g. Premium Cotton Shirt" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2" placeholder="Brief summary"><?php echo e(old('short_description')); ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Full Description</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Detailed product specifications"><?php echo e(old('description')); ?></textarea>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="" disabled selected>-- Select Category --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold small">Selling Price <span class="text-danger">*</span></label>
                        <input type="number" step="any" name="price" class="form-control" value="<?php echo e(old('price')); ?>" placeholder="399" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold small">Previous Price</label>
                        <input type="number" step="any" name="previous_price" class="form-control" value="<?php echo e(old('previous_price')); ?>" placeholder="850">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Stock Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', 100)); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Thumbnail Image Path <span class="text-danger">*</span></label>
                    <input type="text" name="thumbnail" class="form-control" value="<?php echo e(old('thumbnail', '/uploads/image_directory/product_image/1510192199-2026-05-14.webp')); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="isFeatured" name="is_featured" value="1" checked>
                        <label class="custom-control-label" for="isFeatured">Featured Product</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="isBestseller" name="is_bestseller" value="1" checked>
                        <label class="custom-control-label" for="isBestseller">Best Seller</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"><i class="fa fa-save mr-1"></i> Save Product</button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Volumes/2BT/Ridoy/miswan-ashion/resources/views/admin/products/create.blade.php ENDPATH**/ ?>