@extends('layouts.app')

@section('title', $globalSetting->site_title ?? 'Miswanfashion | Bangladesh’s Leading Fashion Brand')

@section('content')
<!-- Hero & Promotional Banners Area -->
<div class="container mt-3 mb-4">
    <div class="row">
        <!-- Main Slider (Left) -->
        <div class="col-lg-8 col-md-12 mb-3 mb-lg-0">
            @if(isset($sliders) && $sliders->count() > 0)
            <div class="main-slider-area h-100">
                <div id="heroCarousel" class="owl-carousel owl-theme hero-slider h-100 rounded-lg overflow-hidden shadow-sm" style="border-radius: 12px !important;">
                    @foreach($sliders as $slider)
                        <div class="item h-100">
                            <a href="{{ $slider->link ?? url('/') }}" class="d-block h-100">
                                <img src="{{ asset($slider->image) }}" class="d-block w-100 img-fluid" style="height: 420px; object-fit: cover;" alt="{{ $slider->title ?? 'Banner' }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Side Banners (Right) -->
        <div class="col-lg-4 d-none d-lg-block">
            <div class="d-flex flex-column justify-content-between h-100">
                @if(isset($middleBanners) && $middleBanners->count() > 0)
                    @foreach($middleBanners->take(2) as $index => $banner)
                    <a href="{{ $banner->link ?? url('/') }}" class="d-block rounded-lg overflow-hidden shadow-sm position-relative {{ $index === 0 ? 'mb-3' : '' }} promo-hover-zoom" style="border-radius: 12px !important;">
                        <img src="{{ asset($banner->image) }}" alt="{{ $banner->title ?? 'Promo' }}" class="img-fluid w-100" style="height: 202px; object-fit: cover; transition: transform 0.4s ease;">
                    </a>
                    @endforeach
                @else
                    <!-- Fallback placeholder if no banners exist -->
                    <div class="rounded-lg bg-light d-flex align-items-center justify-content-center h-100 border text-muted shadow-sm">
                        No Promotional Banners Found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
.promo-hover-zoom:hover img {
    transform: scale(1.05);
}
</style>

<div class="site-content">
    <div class="container">
        <!-- Circular Categories Section -->
        @if(isset($categories) && $categories->count() > 0)
        <div class="categories-area mb-4">
            <div class="heading text-center mb-3">
                <h2 class="font-weight-bold" style="font-size: 24px;">Shop by Categories</h2>
            </div>
            <div class="row justify-content-center">
                @foreach($categories as $cat)
                    <div class="col-4 col-sm-3 col-md-2 text-center mb-3">
                        <a href="{{ route('category.show', $cat->slug) }}" class="category-circle-item text-decoration-none d-block">
                            <div class="category-img-wrapper mx-auto mb-2 rounded-circle overflow-hidden shadow-sm border" style="width: 85px; height: 85px; transition: transform 0.3s;">
                                <img src="{{ asset($cat->image ?? 'assets/ecommerce/dist/images/default.png') }}" alt="{{ $cat->name }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <span class="category-title font-weight-bold text-dark d-block" style="font-size: 13px;">{{ $cat->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Best Selling Products Carousel -->
        @if(isset($bestSellingProducts) && $bestSellingProducts->count() > 0)
        <div class="products-section mb-5">
            <div class="heading d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h2 class="font-weight-bold text-dark m-0" style="font-size: 22px;">Best Selling Items</h2>
                <a href="{{ route('category.show', 'fashion-women') }}" class="btn btn-sm btn-outline-primary">See All <i class="fa fa-arrow-right ml-1"></i></a>
            </div>

            <div class="owl-carousel owl-theme products-carousel">
                @foreach($bestSellingProducts as $prod)
                    <div class="item">
                        <div class="product product-adjust border rounded bg-white p-2 h-100 position-relative shadow-sm" style="transition: all 0.3s;">
                            <article>
                                <a href="{{ route('product.show', ['slug' => $prod->slug, 'id' => $prod->id]) }}" class="text-decoration-none">
                                    <div class="thumb position-relative overflow-hidden rounded mb-2" style="height: 240px;">
                                        <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="{{ asset($prod->thumbnail) }}" alt="{{ $prod->name }}">
                                        @if($prod->discount_percent > 0)
                                            <span class="badge badge-danger position-absolute" style="top: 8px; left: 8px; font-size: 12px;">-{{ $prod->discount_percent }}%</span>
                                        @endif
                                    </div>
                                    <h2 class="title text-center text-dark font-weight-bold text-truncate m-0 mb-1" style="font-size: 15px;">{{ $prod->name }}</h2>
                                    
                                    <div class="price price-center text-center mb-1">
                                        <span class="price-sign text-primary font-weight-bold" style="font-size: 16px;">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($prod->price) }}</span>
                                        @if($prod->previous_price && $prod->previous_price > $prod->price)
                                            <span class="cur-price text-muted text-decoration-line-through small ml-1"><del>{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($prod->previous_price) }}</del></span>
                                        @endif
                                    </div>

                                    <div class="stock-info text-center mb-2">
                                        <span class="badge badge-light text-success font-weight-normal" style="font-size: 11px;">Stock: {{ number_format($prod->stock) }} Available</span>
                                    </div>
                                </a>

                                <div class="product-actions d-flex gap-2">
                                    <a href="{{ route('product.show', ['slug' => $prod->slug, 'id' => $prod->id]) }}" class="btn btn-sm btn-secondary flex-grow-1 mr-1">View</a>
                                    <button type="button" class="btn btn-sm btn-primary flex-grow-1 ajax-add-to-cart" data-product-id="{{ $prod->id }}">
                                        <i class="fa fa-shopping-bag"></i> Buy
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Promotional Banner Cards -->
        @if(isset($middleBanners) && $middleBanners->count() > 0)
        <div class="middle-banners-area mb-5">
            <div class="row">
                @foreach($middleBanners as $banner)
                    <div class="col-md-6 mb-3">
                        <a href="{{ $banner->link ?? url('/') }}" class="d-block overflow-hidden rounded shadow-sm">
                            <img src="{{ asset($banner->image) }}" class="img-fluid w-100" style="transition: transform 0.4s; object-fit: cover;" alt="{{ $banner->title ?? 'Promo Banner' }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Featured Products Grid -->
        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <div class="featured-products-section mb-5">
            <div class="heading d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h2 class="font-weight-bold text-dark m-0" style="font-size: 22px;">Trending & Featured Collections</h2>
                <a href="{{ route('category.show', 'fashion-women') }}" class="btn btn-sm btn-outline-primary">View More</a>
            </div>

            <div class="row">
                @foreach($featuredProducts as $prod)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="product border rounded bg-white p-2 h-100 position-relative shadow-sm">
                            <article>
                                <a href="{{ route('product.show', ['slug' => $prod->slug, 'id' => $prod->id]) }}" class="text-decoration-none">
                                    <div class="thumb position-relative overflow-hidden rounded mb-2" style="height: 220px;">
                                        <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="{{ asset($prod->thumbnail) }}" alt="{{ $prod->name }}">
                                        @if($prod->discount_percent > 0)
                                            <span class="badge badge-danger position-absolute" style="top: 8px; left: 8px;">-{{ $prod->discount_percent }}%</span>
                                        @endif
                                    </div>
                                    <h2 class="title text-center text-dark font-weight-bold text-truncate m-0 mb-1" style="font-size: 14px;">{{ $prod->name }}</h2>
                                    
                                    <div class="price price-center text-center mb-2">
                                        <span class="price-sign text-primary font-weight-bold">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($prod->price) }}</span>
                                        @if($prod->previous_price && $prod->previous_price > $prod->price)
                                            <small class="text-muted ml-1"><del>{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($prod->previous_price) }}</del></small>
                                        @endif
                                    </div>
                                </a>

                                <div class="product-actions d-flex">
                                    <a href="{{ route('product.show', ['slug' => $prod->slug, 'id' => $prod->id]) }}" class="btn btn-sm btn-outline-secondary w-50 mr-1">Details</a>
                                    <button type="button" class="btn btn-sm btn-primary w-50 ajax-add-to-cart" data-product-id="{{ $prod->id }}">
                                        <i class="fa fa-cart-plus"></i> Add
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
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
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
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
@endpush
