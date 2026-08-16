<?php $__env->startSection('title', 'Manage Sliders & Banners'); ?>
<?php $__env->startSection('page_title', 'Sliders & Banners'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="row">
    <!-- Sliders List -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
            <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">Active Hero Sliders</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Preview</th>
                            <th>Title</th>
                            <th>Target Link</th>
                            <th>Order</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset($slider->image)); ?>" width="100" height="40" class="rounded border" style="object-fit: cover;">
                                </td>
                                <td class="font-weight-bold text-dark"><?php echo e($slider->title); ?></td>
                                <td><code><?php echo e($slider->link); ?></code></td>
                                <td><?php echo e($slider->sort_order); ?></td>
                                <td class="text-right">
                                    <form method="POST" action="<?php echo e(route('admin.sliders.destroy', $slider->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this slider?');">
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

    <!-- Create Slider Form -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
            <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Add New Slider</h5>

            <form method="POST" action="<?php echo e(route('admin.sliders.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Slider Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Mega Summer Sale" required>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Target Click Link</label>
                    <input type="text" name="link" class="form-control" placeholder="/product-category/fashion-women" value="/">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold small">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control-file" accept="image/*" required>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold small">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="1">
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold"><i class="fa fa-plus mr-1"></i> Add Slider</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/admin/sliders/index.blade.php ENDPATH**/ ?>