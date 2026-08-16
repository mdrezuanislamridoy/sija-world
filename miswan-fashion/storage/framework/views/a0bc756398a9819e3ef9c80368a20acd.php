<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', $globalSetting->site_title ?? 'Miswanfashion | Bangladesh’s Leading Fashion Brand'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Miswanfashion - Bangladesh\'s Leading Lifestyle & Fashion Brand'); ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset($globalSetting->favicon ?? 'assets/app_assets/image_directory/site/685ed7e04a0218.78429304.png')); ?>" type="image/png">

    <!-- Fonts & Core Stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style type="text/css">
        @font-face {font-family:'Montserrat';font-style:normal;font-weight:100 900;src:url(<?php echo e(asset('assets/cf-fonts/v/montserrat/5.2.8/latin/wght/normal.woff2')); ?>);font-display:swap;}
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor_assets/cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor_assets/cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css')); ?>">
    <link href="<?php echo e(asset('assets/vendor_assets/cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css')); ?>" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link href="<?php echo e(asset('assets/ecommerce/dist/css/app.css')); ?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/ecommerce/dist/css/font-awesome.css')); ?>" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor_assets/cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor_assets/cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css')); ?>" />
    <link href="<?php echo e(asset('assets/ecommerce/dist/css/custom-css.css')); ?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/ecommerce/dist/css/responsive.css')); ?>" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/ecommerce/dist/css/premium-theme.css')); ?>" media="all" rel="stylesheet" type="text/css" />

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body dir="ltr">
    <!-- Main Header -->
    <?php echo $__env->make('layouts.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content Area -->
    <main class="site-main" id="mainContent">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



    <!-- Mobile Bottom Navigation Bar -->
    <div class="mobile-bottom-nav d-md-none">
        <a href="<?php echo e(url('/')); ?>" class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">
            <i class="fa fa-home"></i>
            <span>Home</span>
        </a>
        <a href="<?php echo e(route('category.show', 'fashion-women')); ?>">
            <i class="fa fa-th-large"></i>
            <span>Categories</span>
        </a>
        <a href="<?php echo e(route('cart.index')); ?>" class="position-relative <?php echo e(request()->is('cart*') ? 'active' : ''); ?>">
            <i class="fa fa-shopping-bag"></i>
            <span>Cart</span>
        </a>
        <a href="<?php echo e(route('track.order')); ?>" class="<?php echo e(request()->is('track-order*') ? 'active' : ''); ?>">
            <i class="fa fa-map-marker"></i>
            <span>Track Order</span>
        </a>
    </div>

    <!-- Global Scripts -->
    <?php echo $__env->make('layouts.partials.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Volumes/2BT/Ridoy/fashion.picci/sija-world/miswan-fashion/resources/views/layouts/app.blade.php ENDPATH**/ ?>