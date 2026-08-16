<?php $__env->startSection('title', 'My Orders - ' . ($globalSetting->site_name ?? 'Miswan Fashion')); ?>
<?php $__env->startSection('page_title', 'My Orders'); ?>

<?php $__env->startSection('user_content'); ?>
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <h5 class="font-weight-bold text-dark mb-4 border-bottom pb-2">
        <i class="fa fa-list-alt text-primary mr-2"></i> All Orders (<?php echo e($orders->total()); ?>)
    </h5>

    <?php if($orders->count() > 0): ?>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Order #</th>
                        <th>Items</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="font-weight-bold text-dark"><?php echo e($order->order_number); ?></td>
                            <td><?php echo e($order->items->count()); ?> item(s)</td>
                            <td class="text-muted small"><?php echo e($order->created_at->format('d M, Y h:i A')); ?></td>
                            <td class="font-weight-bold text-primary"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($order->grand_total)); ?></td>
                            <td><span class="badge badge-light border"><?php echo e($order->payment_method); ?></span></td>
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
                            <td class="text-right">
                                <a href="<?php echo e(route('user.orders.details', $order->order_number)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye mr-1"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <?php echo e($orders->links('pagination::bootstrap-4')); ?>

        </div>
    <?php else: ?>
        <div class="text-center py-5 text-muted">
            <i class="fa fa-shopping-basket fa-4x mb-3 d-block text-muted"></i>
            <h4>No orders found.</h4>
            <p>Your previous purchase history will appear here once you place an order.</p>
            <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mt-2">Start Shopping</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/user/orders.blade.php ENDPATH**/ ?>