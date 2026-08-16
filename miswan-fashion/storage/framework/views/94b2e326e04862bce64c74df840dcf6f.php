<?php $__env->startSection('title', $globalSetting->site_title ?? 'Miswanfashion | Bangladesh’s Leading Fashion Brand'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Slider Area -->
<?php if(isset($sliders) && $sliders->count() > 0): ?>
<div class="main-slider-area">
    <div id="heroCarousel" class="owl-carousel owl-theme hero-slider">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <a href="<?php echo e($slider->link ?? url('/')); ?>">
                    <img src="<?php echo e(asset($slider->image)); ?>" class="d-block w-100 img-fluid" alt="<?php echo e($slider->title ?? 'Banner'); ?>">
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

<div class="site-content">
    <div class="container">
        <!-- Circular Categories Section -->
        <?php if(isset($categories) && $categories->count() > 0): ?>
        <div class="categories-area mb-4">
            <div class="heading text-center mb-3">
                <h2 class="font-weight-bold" style="font-size: 24px;">Shop by Categories</h2>
            </div>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4 col-sm-3 col-md-2 text-center mb-3">
                        <a href="<?php echo e(route('category.show', $cat->slug)); ?>" class="category-circle-item text-decoration-none d-block">
                            <div class="category-img-wrapper mx-auto mb-2 rounded-circle overflow-hidden shadow-sm border" style="width: 85px; height: 85px; transition: transform 0.3s;">
                                <img src="<?php echo e(asset($cat->image ?? 'assets/ecommerce/dist/images/default.png')); ?>" alt="<?php echo e($cat->name); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <span class="category-title font-weight-bold text-dark d-block" style="font-size: 13px;"><?php echo e($cat->name); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Best Selling Products Carousel -->
        <?php if(isset($bestSellingProducts) && $bestSellingProducts->count() > 0): ?>
        <div class="products-section mb-5">
            <div class="heading d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h2 class="font-weight-bold text-dark m-0" style="font-size: 22px;">Best Selling Items</h2>
                <a href="<?php echo e(route('category.show', 'fashion-women')); ?>" class="btn btn-sm btn-outline-primary">See All <i class="fa fa-arrow-right ml-1"></i></a>
            </div>

            <div class="owl-carousel owl-theme products-carousel">
                <?php $__currentLoopData = $bestSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="product product-adjust border rounded bg-white p-2 h-100 position-relative shadow-sm" style="transition: all 0.3s;">
                            <article>
                                <a href="<?php echo e(route('product.show', ['slug' => $prod->slug, 'id' => $prod->id])); ?>" class="text-decoration-none">
                                    <div class="thumb position-relative overflow-hidden rounded mb-2" style="height: 240px;">
                                        <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="<?php echo e(asset($prod->thumbnail)); ?>" alt="<?php echo e($prod->name); ?>">
                                        <?php if($prod->discount_percent > 0): ?>
                                            <span class="badge badge-danger position-absolute" style="top: 8px; left: 8px; font-size: 12px;">-<?php echo e($prod->discount_percent); ?>%</span>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="title text-center text-dark font-weight-bold text-truncate m-0 mb-1" style="font-size: 15px;"><?php echo e($prod->name); ?></h2>
                                    
                                    <div class="price price-center text-center mb-1">
                                        <span class="price-sign text-primary font-weight-bold" style="font-size: 16px;"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($prod->price)); ?></span>
                                        <?php if($prod->previous_price && $prod->previous_price > $prod->price): ?>
                                            <span class="cur-price text-muted text-decoration-line-through small ml-1"><del><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($prod->previous_price)); ?></del></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="stock-info text-center mb-2">
                                        <span class="badge badge-light text-success font-weight-normal" style="font-size: 11px;">Stock: <?php echo e(number_format($prod->stock)); ?> Available</span>
                                    </div>
                                </a>

                                <div class="product-actions d-flex gap-2">
                                    <a href="<?php echo e(route('product.show', ['slug' => $prod->slug, 'id' => $prod->id])); ?>" class="btn btn-sm btn-secondary flex-grow-1 mr-1">View</a>
                                    <button type="button" class="btn btn-sm btn-primary flex-grow-1 ajax-add-to-cart" data-product-id="<?php echo e($prod->id); ?>">
                                        <i class="fa fa-shopping-bag"></i> Buy
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Promotional Banner Cards -->
        <?php if(isset($middleBanners) && $middleBanners->count() > 0): ?>
        <div class="middle-banners-area mb-5">
            <div class="row">
                <?php $__currentLoopData = $middleBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-3">
                        <a href="<?php echo e($banner->link ?? url('/')); ?>" class="d-block overflow-hidden rounded shadow-sm">
                            <img src="<?php echo e(asset($banner->image)); ?>" class="img-fluid w-100" style="transition: transform 0.4s; object-fit: cover;" alt="<?php echo e($banner->title ?? 'Promo Banner'); ?>">
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Featured Products Grid -->
        <?php if(isset($featuredProducts) && $featuredProducts->count() > 0): ?>
        <div class="featured-products-section mb-5">
            <div class="heading d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h2 class="font-weight-bold text-dark m-0" style="font-size: 22px;">Trending & Featured Collections</h2>
                <a href="<?php echo e(route('category.show', 'fashion-women')); ?>" class="btn btn-sm btn-outline-primary">View More</a>
            </div>

            <div class="row">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="product border rounded bg-white p-2 h-100 position-relative shadow-sm">
                            <article>
                                <a href="<?php echo e(route('product.show', ['slug' => $prod->slug, 'id' => $prod->id])); ?>" class="text-decoration-none">
                                    <div class="thumb position-relative overflow-hidden rounded mb-2" style="height: 220px;">
                                        <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="<?php echo e(asset($prod->thumbnail)); ?>" alt="<?php echo e($prod->name); ?>">
                                        <?php if($prod->discount_percent > 0): ?>
                                            <span class="badge badge-danger position-absolute" style="top: 8px; left: 8px;">-<?php echo e($prod->discount_percent); ?>%</span>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="title text-center text-dark font-weight-bold text-truncate m-0 mb-1" style="font-size: 14px;"><?php echo e($prod->name); ?></h2>
                                    
                                    <div class="price price-center text-center mb-2">
                                        <span class="price-sign text-primary font-weight-bold"><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($prod->price)); ?></span>
                                        <?php if($prod->previous_price && $prod->previous_price > $prod->price): ?>
                                            <small class="text-muted ml-1"><del><?php echo e($globalSetting->currency_symbol ?? 'TK'); ?> <?php echo e(number_format($prod->previous_price)); ?></del></small>
                                        <?php endif; ?>
                                    </div>
                                </a>

                                <div class="product-actions d-flex">
                                    <a href="<?php echo e(route('product.show', ['slug' => $prod->slug, 'id' => $prod->id])); ?>" class="btn btn-sm btn-outline-secondary w-50 mr-1">Details</a>
                                    <button type="button" class="btn btn-sm btn-primary w-50 ajax-add-to-cart" data-product-id="<?php echo e($prod->id); ?>">
                                        <i class="fa fa-cart-plus"></i> Add
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function(){
        // Hero Slider
        $('#heroCarousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            items: 1,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
        });

        // Best Selling Products Carousel
        $('.products-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {
                0: { items: 2 },
                576: { items: 2 },
                768: { items: 3 },
                992: { items: 4 },
                1200: { items: 4 }
            },
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Volumes/2BT/Ridoy/miswan-fashion/resources/views/frontend/index.blade.php ENDPATH**/ ?>