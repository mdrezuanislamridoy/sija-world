<header id="header_sticky" class="header-area">
    <!-- Top Announcement Bar (Desktop) -->
    <div class="header-top d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 col-sm-12">
                    <div class="header-top-left">
                        <div class="news-ticker-container">
                            <div class="news-ticker-label">
                                <i class="fa fa-bullhorn"></i> Offer & Updates
                            </div>
                            <div class="news-ticker text-white">
                                <?php echo e($globalSetting->announcement_text ?? 'Upto 50% Discount on selected product. Ending Soon.'); ?>

                                <a href="<?php echo e(url('/')); ?>" class="text-warning ml-2 font-weight-bold">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 text-md-right">
                    <div class="header-top-right text-white">
                        <div class="social-media-icons d-inline-block mr-3">
                            <span class="social-label text-muted mr-1">Follow Us:</span>
                            <?php if(!empty($globalSetting->facebook_url)): ?>
                                <a href="<?php echo e($globalSetting->facebook_url); ?>" target="_blank" class="social-icon facebook text-white mr-2"><i class="fa fa-facebook"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($globalSetting->instagram_url)): ?>
                                <a href="<?php echo e($globalSetting->instagram_url); ?>" target="_blank" class="social-icon instagram text-white"><i class="fa fa-instagram"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="auth-quick-links d-inline-block">
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('user.dashboard')); ?>" class="text-white"><i class="fa fa-user-circle mr-1"></i> <?php echo e(Auth::user()->name); ?></a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="text-white mr-2">Login</a>
                                <span class="text-muted">|</span>
                                <a href="<?php echo e(route('register')); ?>" class="text-white ml-2">Sign Up</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header (White Background) -->
    <div class="header-maxi py-2">
        <div class="container">
            <!-- Mobile Row (d-flex d-md-none) matching Image 1 -->
            <div class="mobile-header-row d-flex d-md-none align-items-center justify-content-between py-1">
                <!-- Hamburger Menu Button (3 Red Bars) -->
                <button class="mobile-menu-btn" type="button" data-toggle="collapse" data-target="#mainNavbarNav" aria-controls="mainNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="bar-line"></div>
                    <div class="bar-line"></div>
                    <div class="bar-line"></div>
                </button>

                <!-- Center Logo -->
                <a href="<?php echo e(url('/')); ?>" class="logo text-center">
                    <img src="<?php echo e(asset($globalSetting->logo ?? 'assets/app_assets/image_directory/site/685ed7e04a0218.78429304.png')); ?>" alt="<?php echo e($globalSetting->site_name ?? 'Miswan Fashion'); ?>" style="max-height: 42px;">
                </a>

                <!-- Right Shopping Bag with Red Badge -->
                <a href="javascript:void(0)" class="header-cart-icon-wrapper p-2" id="mobileCartTrigger" onclick="document.getElementById('cartTrigger').click()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e53131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="cart-badge cart-count-badge"><?php echo e(session('cart') ? count(session('cart')) : 0); ?></span>
                </a>
            </div>

            <!-- Desktop Row (d-none d-md-flex) -->
            <div class="row align-items-center d-none d-md-flex">
                <!-- Logo -->
                <div class="col-md-3">
                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <img src="<?php echo e(asset($globalSetting->logo ?? 'assets/app_assets/image_directory/site/685ed7e04a0218.78429304.png')); ?>" alt="<?php echo e($globalSetting->site_name ?? 'Miswan Fashion'); ?>" class="site-logo" style="max-height: 48px;">
                    </a>
                </div>

                <!-- Search Input -->
                <div class="col-md-6">
                    <form class="form-inline w-100" method="GET" action="<?php echo e(route('products.search')); ?>">
                        <div class="search-categories w-100 position-relative">
                            <input type="text" autocomplete="off" name="q" placeholder="What are you looking for?" id="search" value="<?php echo e(request('q')); ?>" class="form-control w-100">
                            <button type="submit" class="btn search-button position-absolute" style="top: 0; height: 100%;"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <!-- User & Cart Section -->
                <div class="col-md-3 text-right">
                    <div class="header-right-actions d-flex align-items-center justify-content-end">
                        <!-- Wishlist -->
                        <div class="wishlist-action mr-3">
                            <a href="<?php echo e(route('wishlist.index')); ?>" class="text-dark position-relative" title="Wishlist">
                                <i class="fa fa-heart-o" style="font-size: 22px; color: #1a202c;"></i>
                            </a>
                        </div>

                        <!-- Cart Trigger Partial -->
                        <ul class="top-right-list p-0 m-0 list-unstyled">
                            <?php echo $__env->make('layouts.partials.cart_drawer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Navigation Sub-bar (Matching Image 1: CELEBRATION, FASHION, GET 40% DISCOUNT) -->
    <div class="category-subbar">
        <div class="container">
            <ul class="category-subbar-list">
                <li><a href="<?php echo e(route('category.show', 'fashion-women')); ?>" class="<?php echo e(request()->is('*fashion*') ? 'active' : ''); ?>">Celebration</a></li>
                <li><a href="<?php echo e(route('category.show', 'man-fashion')); ?>" class="<?php echo e(request()->is('*man*') ? 'active' : ''); ?>">Fashion</a></li>
                <li><a href="<?php echo e(route('category.show', 'perfume')); ?>" class="<?php echo e(request()->is('*perfume*') ? 'active' : ''); ?>">Get 40% Discount</a></li>
                <?php if(isset($globalCategories) && $globalCategories->count() > 0): ?>
                    <?php $__currentLoopData = $globalCategories->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('category.show', $cat->slug)); ?>"><?php echo e($cat->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Mobile Collapsible Menu (When Hamburger is clicked) -->
    <div class="collapse" id="mainNavbarNav">
        <div class="bg-white border-top p-3 shadow-sm">
            <ul class="list-unstyled m-0">
                <li class="py-2 border-bottom"><a href="<?php echo e(url('/')); ?>" class="text-dark font-weight-bold"><i class="fa fa-home mr-2 text-danger"></i> Home</a></li>
                <?php if(isset($globalCategories) && $globalCategories->count() > 0): ?>
                    <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="py-2 border-bottom">
                            <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="text-dark font-weight-bold d-flex justify-content-between align-items-center">
                                <span><?php echo e($cat->name); ?></span>
                                <i class="fa fa-chevron-right text-muted small"></i>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <li class="py-2 border-bottom"><a href="<?php echo e(route('cart.index')); ?>" class="text-dark font-weight-bold"><i class="fa fa-shopping-bag mr-2 text-danger"></i> Shopping Cart</a></li>
                <li class="py-2"><a href="<?php echo e(auth()->check() ? route('user.dashboard') : route('login')); ?>" class="text-dark font-weight-bold"><i class="fa fa-user mr-2 text-danger"></i> <?php echo e(auth()->check() ? 'My Account' : 'Login / Register'); ?></a></li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH /Volumes/2BT/Ridoy/miswan-ashion/resources/views/layouts/partials/header.blade.php ENDPATH**/ ?>