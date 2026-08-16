<?php $__env->startSection('title', 'My Dashboard - ' . ($globalSetting->site_name ?? 'Miswan Fashion')); ?>
<?php $__env->startSection('page_title', 'Dashboard'); ?>

<?php $__env->startSection('user_content'); ?>
<!-- Metric Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white text-center">
            <h6 class="text-muted small mb-1">Total Orders Placed</h6>
            <h3 class="font-weight-bold text-primary m-0"><?php echo e($totalOrdersCount); ?></h3>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white text-center">
            <h6 class="text-muted small mb-1">Registered Phone</h6>
            <h6 class="font-weight-bold text-dark m-0"><?php echo e($user->phone); ?></h6>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm rounded-lg p-3 bg-white text-center">
            <h6 class="text-muted small mb-1">Default City</h6>
            <h6 class="font-weight-bold text-dark m-0"><?php echo e($user->district ?? 'Dhaka'); ?></h6>
        </div>
    </div>
</div>

<!-- Recent Orders Card -->
<div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h5 class="font-weight-bold text-dark m-0"><i class="fa fa-shopping-bag text-primary mr-2"></i> Recent Orders</h5>
        <a href="<?php echo e(route('user.orders')); ?>" class="btn btn-sm btn-outline-primary">View All Orders</a>
    </div>

    <?php if(isset($recentOrders) && $recentOrders->count() > 0): ?>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="font-weight-bold text-dark"><?php echo e($order->order_number); ?></td>
                            <td class="text-muted small"><?php echo e($order->created_at->format('d M, Y')); ?></td>
                            <td class="font-weight-bold text-primary"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($order->grand_total)); ?></td>
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
                                <a href="<?php echo e(route('user.orders.details', $order->order_number)); ?>" class="btn btn-sm btn-light border">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-4 text-muted">
            <i class="fa fa-shopping-bag fa-3x mb-2 d-block text-muted"></i>
            <p>You haven't placed any orders yet.</p>
            <a href="<?php echo e(url('/')); ?>" class="btn btn-sm btn-primary">Start Shopping</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/user/dashboard.blade.php ENDPATH**/ ?>