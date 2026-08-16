@extends('layouts.app')

@section('title', 'Search results for "' . $keyword . '" - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="search-page-area py-4 bg-light">
    <div class="container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search: "{{ $keyword }}"</li>
            </ol>
        </nav>

        <div class="heading mb-4 border-bottom pb-2">
            <h2 class="font-weight-bold text-dark m-0" style="font-size: 22px;">Search Results for <span class="text-primary">"{{ $keyword }}"</span> ({{ $products->total() }} items)</h2>
        </div>

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
                    <i class="fa fa-search fa-4x text-muted mb-3 d-block"></i>
                    <h4>No products found matching "{{ $keyword }}".</h4>
                    <p class="text-muted">Try searching with a different keyword or browse our categories.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-2">Back to Catalog</a>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
