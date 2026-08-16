<?php $__env->startSection('title', 'Manage Products'); ?>
<?php $__env->startSection('page_title', 'Products Catalog'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">All Products (<?php echo e($products->total()); ?>)</h5>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary"><i class="fa fa-plus mr-1"></i> Add New Product</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset($prod->thumbnail)); ?>" width="45" height="45" class="rounded border" style="object-fit: cover;">
                        </td>
                        <td class="font-weight-bold text-dark"><?php echo e($prod->name); ?></td>
                        <td><code><?php echo e($prod->sku); ?></code></td>
                        <td><span class="badge badge-light border"><?php echo e($prod->category->name ?? 'None'); ?></span></td>
                        <td class="font-weight-bold text-primary">TK <?php echo e(number_format($prod->price)); ?></td>
                        <td>
                            <span class="badge <?php echo e($prod->stock > 0 ? 'badge-success' : 'badge-danger'); ?>"><?php echo e(number_format($prod->stock)); ?></span>
                        </td>
                        <td>
                            <span class="badge <?php echo e($prod->status ? 'badge-success' : 'badge-secondary'); ?>"><?php echo e($prod->status ? 'Active' : 'Hidden'); ?></span>
                        </td>
                        <td class="text-right">
                            <a href="<?php echo e(route('admin.products.edit', $prod->id)); ?>" class="btn btn-sm btn-info mr-1"><i class="fa fa-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('admin.products.destroy', $prod->id)); ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($products->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Volumes/2BT/Ridoy/miswan-ashion/resources/views/admin/products/index.blade.php ENDPATH**/ ?>