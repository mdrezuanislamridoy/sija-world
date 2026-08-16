@extends('layouts.app')

@section('title', $category->name . ' - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="category-page-area py-4 bg-light">
    <div class="container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                @if(isset($selectedSubCategory))
                    <li class="breadcrumb-item active" aria-current="page">{{ $selectedSubCategory->name }}</li>
                @endif
            </ol>
        </nav>

        <!-- Category Header Banner -->
        <div class="category-header-banner bg-primary text-white p-4 rounded mb-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #111827 0%, #1f2937 100%);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="font-weight-bold text-white mb-2">{{ $category->name }}</h1>
                    <p class="text-white-50 m-0">Explore our exclusive and authentic {{ strtolower($category->name) }} collection crafted for comfort and style.</p>
                </div>
            </div>
        </div>

        <!-- Filter & Sorting Bar -->
        <div class="catalog-toolbar d-flex flex-wrap justify-content-between align-items-center bg-white p-3 rounded mb-4 shadow-sm">
            <div class="results-count">
                <span class="text-muted font-weight-bold">Showing {{ $products->total() }} Products</span>
            </div>

            <!-- Subcategory Badges -->
            @if($category->subCategories && $category->subCategories->count() > 0)
                <div class="sub-category-pills my-2 my-md-0">
                    <a href="{{ route('category.show', $category->slug) }}" class="badge {{ !isset($selectedSubCategory) ? 'badge-primary' : 'badge-light text-dark' }} p-2 mr-1">All</a>
                    @foreach($category->subCategories as $sub)
                        <a href="{{ route('category.show', ['category' => $category->slug, 'subcategory' => $sub->slug]) }}" class="badge {{ (isset($selectedSubCategory) && $selectedSubCategory->id == $sub->id) ? 'badge-primary' : 'badge-light text-dark' }} p-2 mr-1">
                            {{ $sub->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Sort dropdown -->
            <div class="sort-selector">
                <form method="GET" id="sortForm" class="form-inline m-0">
                    <label class="mr-2 text-muted small">Sort By:</label>
                    <select name="sort" class="form-control form-control-sm" onchange="document.getElementById('sortForm').submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Arrivals</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            @forelse($products as $prod)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="product border rounded bg-white p-2 h-100 position-relative shadow-sm">
                        <article>
                            <a href="{{ route('product.show', ['slug' => $prod->slug, 'id' => $prod->id]) }}" class="text-decoration-none">
                                <div class="thumb position-relative overflow-hidden rounded mb-2" style="height: 230px;">
                                    <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="{{ asset($prod->thumbnail) }}" alt="{{ $prod->name }}">
                                    @if($prod->discount_percent > 0)
                                        <span class="badge badge-danger position-absolute" style="top: 8px; left: 8px;">-{{ $prod->discount_percent }}%</span>
                                    @endif
                                </div>
                                <h2 class="title text-center text-dark font-weight-bold text-truncate m-0 mb-1" style="font-size: 14px;">{{ $prod->name }}</h2>
                                
                                <div class="price price-center text-center mb-1">
                                    <span class="price-sign text-primary font-weight-bold">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($prod->price) }}</span>
                                    @if($prod->previous_price && $prod->previous_price > $prod->price)
                                        <small class="text-muted ml-1"><del>{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($prod->previous_price) }}</del></small>
                                    @endif
                                </div>

                                <div class="stock-info text-center mb-2">
                                    <span class="badge badge-light text-success font-weight-normal" style="font-size: 11px;">Stock: {{ number_format($prod->stock) }} In Stock</span>
                                </div>
                            </a>

                            <div class="product-actions d-flex">
                                <a href="{{ route('product.show', ['slug' => $prod->slug, 'id' => $prod->id]) }}" class="btn btn-sm btn-outline-secondary w-50 mr-1">Details</a>
                                <button type="button" class="btn btn-sm btn-primary w-50 ajax-add-to-cart" data-product-id="{{ $prod->id }}">
                                    <i class="fa fa-shopping-bag"></i> Buy
                                </button>
                            </div>
                        </article>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa fa-shopping-basket fa-4x text-muted mb-3 d-block"></i>
                    <h4>No products found in this category.</h4>
                    <p class="text-muted">Please check back soon for fresh arrivals!</p>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-2">Return to Home</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
