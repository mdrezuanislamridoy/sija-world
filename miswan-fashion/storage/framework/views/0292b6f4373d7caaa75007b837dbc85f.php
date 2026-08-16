<?php $__env->startSection('title', 'Manage Categories'); ?>
<?php $__env->startSection('page_title', 'Category Management'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="row">
    <!-- Category List -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Active Categories</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products Count</th>
                            <th>Priority</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset($cat->image)); ?>" width="40" height="40" class="rounded-circle border" style="object-fit: cover;">
                                </td>
                                <td class="font-weight-bold text-dark"><?php echo e($cat->name); ?></td>
                                <td><code><?php echo e($cat->slug); ?></code></td>
                                <td><span class="badge badge-primary"><?php echo e($cat->products_count); ?> items</span></td>
                                <td><?php echo e($cat->priority); ?></td>
                                <td class="text-right">
                                    <form method="POST" action="<?php echo e(route('admin.categories.destroy', $cat->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this category?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Category Form -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Category</h5>

            <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Premium Watch" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Image Path <span class="text-danger">*</span></label>
                    <input type="text" name="image" class="form-control" placeholder="/uploads/category_image/..." value="/uploads/category_image/cat_img958a5d386c-2026-02-23.jpg" required>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold small">Sort Priority</label>
                    <input type="number" name="priority" class="form-control" value="1">
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"><i class="fa fa-plus mr-1"></i> Add Category</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>