<footer class="footer-area bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- Col 1: About & Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <img src="<?php echo e(asset($globalSetting->logo ?? 'assets/app_assets/image_directory/site/685ed7e04a0218.78429304.png')); ?>" alt="<?php echo e($globalSetting->site_name ?? 'Miswan Fashion'); ?>" style="max-height: 45px; filter: brightness(0) invert(1);" class="mb-3">
                    <p class="text-muted" style="font-size: 14px; line-height: 1.6;">
                        Miswan Fashion is one of Bangladesh’s leading lifestyle brands, providing authentic products, exclusive fragrances, and the trendiest fashion collections with fast nationwide delivery.
                    </p>
                    <ul class="list-unstyled text-muted" style="font-size: 14px;">
                        <li class="mb-2"><i class="fa fa-map-marker text-primary mr-2"></i> <?php echo e($globalSetting->address ?? 'Dhaka, Bangladesh'); ?></li>
                        <li class="mb-2"><i class="fa fa-phone text-primary mr-2"></i> <?php echo e($globalSetting->phone ?? '+8801700000000'); ?></li>
                        <li class="mb-2"><i class="fa fa-envelope text-primary mr-2"></i> <?php echo e($globalSetting->email ?? 'support@miswanfashion.com'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5 class="text-white font-weight-bold mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">Quick Links</h5>
                    <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                        <li><a href="<?php echo e(route('page.show', 'About-Us-2')); ?>" class="text-muted">About Us</a></li>
                        <li><a href="<?php echo e(route('page.show', 'Terms-&-Conditions-4')); ?>" class="text-muted">Terms & Conditions</a></li>
                        <li><a href="<?php echo e(route('page.show', 'Privacy-Policy-3')); ?>" class="text-muted">Privacy Policy</a></li>
                        <li><a href="<?php echo e(route('page.show', 'Refund-&-Return-Policy-5')); ?>" class="text-muted">Return Policy</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-muted">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Col 3: Customer Care -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5 class="text-white font-weight-bold mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">Customer Care</h5>
                    <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                        <li><a href="<?php echo e(route('login')); ?>" class="text-muted">My Account</a></li>
                        <li><a href="<?php echo e(route('user.orders')); ?>" class="text-muted">Order History</a></li>
                        <li><a href="<?php echo e(route('wishlist.index')); ?>" class="text-muted">My Wishlist</a></li>
                        <li><a href="<?php echo e(route('cart.index')); ?>" class="text-muted">Shopping Cart</a></li>
                        <li><a href="<?php echo e(route('checkout.index')); ?>" class="text-muted">Checkout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Col 4: Payment Gateways & Socials -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5 class="text-white font-weight-bold mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">We Accept</h5>
                    <p class="text-muted" style="font-size: 13px;">100% Safe & Secure Payment Channels and Cash on Delivery across Bangladesh.</p>
                    
                    <!-- <div class="payment-methods mb-3">
                        <img src="<?php echo e(asset('assets/ecommerce/dist/images/payments.png')); ?>" alt="Payment Channels" class="img-fluid rounded mb-2">
                        <img src="<?php echo e(asset('assets/image_directory/commerz.jpg')); ?>" alt="SSLCommerz" class="img-fluid rounded" style="max-height: 35px;">
                    </div> -->

                    <div class="footer-social mt-3">
                        <span class="text-muted mr-2">Stay Connected:</span>
                        <?php if(!empty($globalSetting->facebook_url)): ?>
                            <a href="<?php echo e($globalSetting->facebook_url); ?>" target="_blank" class="btn btn-sm btn-outline-light rounded-circle mr-1"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if(!empty($globalSetting->youtube_url)): ?>
                            <a href="<?php echo e($globalSetting->youtube_url); ?>" target="_blank" class="btn btn-sm btn-outline-light rounded-circle mr-1"><i class="fa fa-youtube"></i></a>
                        <?php endif; ?>
                        <?php if(!empty($globalSetting->instagram_url)): ?>
                            <a href="<?php echo e($globalSetting->instagram_url); ?>" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="fa fa-instagram"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row pt-3 mt-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
            <div class="col-md-6 text-center text-md-left">
                <p class="text-muted small m-0">&copy; <?php echo e(date('Y')); ?> <?php echo e($globalSetting->site_name ?? 'Miswan Fashion'); ?>. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-right mt-2 mt-md-0">
                <p class="text-muted small m-0">Designed & Powered by Miswan Fashion Engineering Team</p>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /Volumes/2BT/Ridoy/miswan-ashion/resources/views/layouts/partials/footer.blade.php ENDPATH**/ ?>