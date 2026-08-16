<?php $__env->startSection('title', 'Edit Product #' . $product->id); ?>
<?php $__env->startSection('page_title', 'Edit Product: ' . $product->name); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">Edit Product: <?php echo e($product->name); ?></h5>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left mr-1"></i> Back to Catalog</a>
    </div>

    <form method="POST" action="<?php echo e(route('admin.products.update', $product->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Product Title <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $product->name)); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2"><?php echo e(old('short_description', $product->short_description)); ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Full Description</label>
                    <textarea name="description" class="form-control" rows="5"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $product->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold small">Selling Price <span class="text-danger">*</span></label>
                        <input type="number" step="any" name="price" class="form-control" value="<?php echo e(old('price', $product->price)); ?>" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="font-weight-bold small">Previous Price</label>
                        <input type="number" step="any" name="previous_price" class="form-control" value="<?php echo e(old('previous_price', $product->previous_price)); ?>">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Stock Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="<?php echo e(old('stock', $product->stock)); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Available Colors</label>
                    <input type="text" name="colors" class="form-control" value="<?php echo e(old('colors', $product->colors)); ?>" placeholder="e.g. Red, White, Black">
                    <small class="text-muted">Separate multiple colors with a comma.</small>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Thumbnail Image (Leave blank to keep current)</label>
                    <div class="mb-2">
                        <img src="<?php echo e(asset($product->thumbnail)); ?>" width="80" class="rounded border">
                    </div>
                    <input type="file" name="thumbnail" class="form-control-file" accept="image/*">
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="isFeatured" name="is_featured" value="1" <?php echo e($product->is_featured ? 'checked' : ''); ?>>
                        <label class="custom-control-label" for="isFeatured">Featured Product</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="isBestseller" name="is_bestseller" value="1" <?php echo e($product->is_bestseller ? 'checked' : ''); ?>>
                        <label class="custom-control-label" for="isBestseller">Best Seller</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" <?php echo e($product->status ? 'checked' : ''); ?>>
                        <label class="custom-control-label" for="status">Published (Active)</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"><i class="fa fa-save mr-1"></i> Update Product</button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>