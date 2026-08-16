<?php $__env->startSection('title', 'Manage Orders'); ?>
<?php $__env->startSection('page_title', 'Customer Orders'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0">Customer Orders</h5>

        <!-- Filter Status Tabs -->
        <div class="btn-group btn-group-sm">
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'all'])); ?>" class="btn <?php echo e($status == 'all' ? 'btn-dark' : 'btn-outline-dark'); ?>">All</a>
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'Pending'])); ?>" class="btn <?php echo e($status == 'Pending' ? 'btn-secondary' : 'btn-outline-secondary'); ?>">Pending</a>
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'Processing'])); ?>" class="btn <?php echo e($status == 'Processing' ? 'btn-warning' : 'btn-outline-warning'); ?>">Processing</a>
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'Shipped'])); ?>" class="btn <?php echo e($status == 'Shipped' ? 'btn-info' : 'btn-outline-info'); ?>">Shipped</a>
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'Delivered'])); ?>" class="btn <?php echo e($status == 'Delivered' ? 'btn-success' : 'btn-outline-success'); ?>">Delivered</a>
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'Cancelled'])); ?>" class="btn <?php echo e($status == 'Cancelled' ? 'btn-danger' : 'btn-outline-danger'); ?>">Cancelled</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>District</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="font-weight-bold text-dark"><?php echo e($order->order_number); ?></td>
                        <td class="text-muted small"><?php echo e($order->created_at->format('d M, Y')); ?></td>
                        <td><?php echo e($order->customer_name); ?></td>
                        <td><?php echo e($order->phone); ?></td>
                        <td><?php echo e($order->district); ?></td>
                        <td class="font-weight-bold text-primary">TK <?php echo e(number_format($order->grand_total)); ?></td>
                        <td>
                            <?php if($order->order_status == 'Delivered'): ?>
                                <span class="badge badge-success">Delivered</span>
                            <?php elseif($order->order_status == 'Shipped'): ?>
                                <span class="badge badge-info">Shipped</span>
                            <?php elseif($order->order_status == 'Processing'): ?>
                                <span class="badge badge-warning">Processing</span>
                            <?php elseif($order->order_status == 'Cancelled'): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge badge-light border"><?php echo e($order->payment_method); ?></span></td>
                        <td class="text-right">
                            <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-primary mr-1"><i class="fa fa-eye mr-1"></i> Manage</a>
                            <form method="POST" action="<?php echo e(route('admin.orders.destroy', $order->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this order?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No orders found in this category.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($orders->appends(request()->query())->links('pagination::bootstrap-4')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Volumes/2BT/Ridoy/miswan-ashion/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>