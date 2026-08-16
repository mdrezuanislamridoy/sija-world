<?php $__env->startSection('title', 'Order Details #' . $order->order_number . ' - ' . ($globalSetting->site_name ?? 'Miswan Fashion')); ?>

<?php $__env->startSection('content'); ?>
<div class="order-success-page-area py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow rounded-lg p-4 p-md-5 bg-white mx-auto" style="max-width: 850px;">
            <!-- Celebration Banner -->
            <div class="text-center mb-4 pb-3 border-bottom">
                <div class="success-icon mb-3">
                    <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fa fa-map-marker fa-3x"></i>
                    </span>
                </div>
                <h2 class="font-weight-bold text-dark mb-1">অর্ডারের বিস্তারিত তথ্য</h2>
                <p class="text-muted">নিচে আপনার অর্ডারের সম্পূর্ণ বিবরণ এবং বর্তমান অবস্থা দেওয়া হলো।</p>
                <div class="order-badge mt-3">
                    <span class="badge badge-light border p-2 text-dark font-weight-bold" style="font-size: 15px;">
                        অর্ডার নম্বর: <strong class="text-primary"><?php echo e($order->order_number); ?></strong>
                    </span>
                </div>
            </div>

            <!-- Customer & Delivery Info Grid -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="p-3 rounded bg-light border h-100">
                        <h6 class="font-weight-bold text-dark mb-2"><i class="fa fa-user mr-1 text-primary"></i> কাস্টমার তথ্য:</h6>
                        <p class="m-0 text-muted small"><strong>নাম:</strong> <?php echo e($order->customer_name); ?></p>
                        <p class="m-0 text-muted small"><strong>ফোন নম্বর:</strong> <?php echo e($order->phone); ?></p>
                        <?php if($order->alt_phone): ?>
                            <p class="m-0 text-muted small"><strong>বিকল্প ফোন:</strong> <?php echo e($order->alt_phone); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded bg-light border h-100">
                        <h6 class="font-weight-bold text-dark mb-2"><i class="fa fa-truck mr-1 text-primary"></i> ডেলিভারি ঠিকানা:</h6>
                        <p class="m-0 text-muted small"><strong>ঠিকানা:</strong> <?php echo e($order->address); ?></p>
                        <p class="m-0 text-muted small"><strong>জেলা / এরিয়া:</strong> <?php echo e($order->district); ?> <?php if($order->upazila): ?> (<?php echo e($order->upazila); ?>) <?php endif; ?></p>
                        <p class="m-0 text-muted small mt-1"><strong>পেমেন্ট মেথড:</strong> <span class="badge badge-info"><?php echo e($order->payment_method); ?></span></p>
                        <p class="m-0 text-muted small mt-1"><strong>বর্তমান অবস্থা (Status):</strong> 
                            <span class="badge badge-<?php echo e($order->order_status == 'Pending' ? 'warning' : ($order->order_status == 'Processing' ? 'primary' : ($order->order_status == 'Completed' ? 'success' : 'danger'))); ?>" style="font-size: 13px;"><?php echo e($order->order_status); ?></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>পণ্য</th>
                            <th class="text-center">মূল্য</th>
                            <th class="text-center">পরিমাণ</th>
                            <th class="text-right">মোট</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo e(asset($item->product_image ?? 'assets/ecommerce/dist/images/default.png')); ?>" class="rounded mr-2 border" width="40" height="40" style="object-fit: cover;">
                                        <div>
                                            <span class="font-weight-bold text-dark"><?php echo e($item->product_name); ?></span>
                                            <?php if($item->variant_name): ?>
                                                <br><small class="text-muted">সাইজ: <?php echo e($item->variant_name); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-dark"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($item->price)); ?></td>
                                <td class="text-center font-weight-bold text-dark"><?php echo e($item->quantity); ?></td>
                                <td class="text-right font-weight-bold text-dark"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($item->subtotal)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">সাবটোটাল:</th>
                            <th class="text-right"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($order->subtotal)); ?></th>
                        </tr>
                        <?php if($order->discount > 0): ?>
                            <tr>
                                <th colspan="3" class="text-right text-success">ডিসকাউন্ট:</th>
                                <th class="text-right text-success">- <?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($order->discount)); ?></th>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th colspan="3" class="text-right">ডেলিভারি চার্জ:</th>
                            <th class="text-right"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($order->shipping_cost)); ?></th>
                        </tr>
                        <tr class="bg-light">
                            <th colspan="3" class="text-right font-weight-bold text-danger h5 m-0">সর্বমোট প্রদেয় টাকা:</th>
                            <th class="text-right font-weight-bold text-danger h5 m-0"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($order->grand_total)); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center pt-3 border-top no-print">
                <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-secondary"><i class="fa fa-arrow-left mr-1"></i> হোম পেজে ফিরে যান</a>
                <button type="button" class="btn btn-dark" onclick="window.print()"><i class="fa fa-print mr-1"></i> ইনভয়েস প্রিন্ট করুন</button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print, header, footer, .main-slider-area, .breadcrumb {
            display: none !important;
        }
        body {
            background: #fff !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\regin\Downloads\miswan-fashion\miswan-fashion\resources\views/frontend/track_order_details.blade.php ENDPATH**/ ?>