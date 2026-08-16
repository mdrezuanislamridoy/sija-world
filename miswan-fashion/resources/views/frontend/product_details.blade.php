@extends('layouts.app')

@section('title', $product->name . ' - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="product-details-page py-4 bg-light">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                @if($product->category)
                    <li class="breadcrumb-item"><a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Product Main Showcase Card -->
        <div class="card border-0 shadow-sm rounded-lg p-3 p-md-4 mb-4 bg-white">
            <div class="row">
                <!-- Col 1: Images Gallery -->
                <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
                    <div class="product-gallery">
                        <!-- Main Preview Image -->
                        <div class="main-image-wrapper border rounded overflow-hidden mb-2 text-center" style="height: 380px;">
                            <img id="mainProductImg" src="{{ asset($product->thumbnail) }}" class="img-fluid h-100" style="object-fit: contain;" alt="{{ $product->name }}">
                        </div>

                        <!-- Thumbnails -->
                        @if($product->galleries && $product->galleries->count() > 0)
                            <div class="thumbnails-row d-flex gap-2">
                                <div class="thumb-item border rounded p-1 mr-2 cursor-pointer active" onclick="switchImage('{{ asset($product->thumbnail) }}', this)" style="width: 70px; height: 70px; cursor: pointer;">
                                    <img src="{{ asset($product->thumbnail) }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                                @foreach($product->galleries as $gallery)
                                    <div class="thumb-item border rounded p-1 mr-2 cursor-pointer" onclick="switchImage('{{ asset($gallery->image) }}', this)" style="width: 70px; height: 70px; cursor: pointer;">
                                        <img src="{{ asset($gallery->image) }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Product Specifications & Order Form -->
                <div class="col-lg-7 col-md-6">
                    <div class="product-info-content pl-lg-3">
                        <span class="badge badge-pill badge-primary mb-2">{{ $product->category->name ?? 'Collection' }}</span>
                        <h1 class="font-weight-bold text-dark mb-2" style="font-size: 24px;">{{ $product->name }}</h1>
                        <p class="text-muted small mb-2">SKU: <strong class="text-dark">{{ $product->sku ?? 'MSW-PROD-' . $product->id }}</strong></p>

                        <!-- Price Section -->
                        <div class="price-box d-flex align-items-center mb-3 bg-light p-3 rounded">
                            <span class="h3 font-weight-bold text-primary m-0 mr-3" id="displayProductPrice">
                                {{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($product->price) }}
                            </span>
                            @if($product->previous_price && $product->previous_price > $product->price)
                                <span class="text-muted h5 m-0 mr-3 text-decoration-line-through">
                                    <del>{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($product->previous_price) }}</del>
                                </span>
                                <span class="badge badge-danger font-weight-bold p-2" style="font-size: 13px;">-{{ $product->discount_percent }}% Discount</span>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="stock-status-box mb-3">
                            <span class="text-success font-weight-bold" id="displayProductStock">
                                <i class="fa fa-check-circle mr-1"></i> Stock Remaining: {{ number_format($product->stock) }} Items
                            </span>
                        </div>

                        <!-- Short Description -->
                        @if($product->short_description)
                            <div class="short-desc text-muted mb-4" style="line-height: 1.6;">
                                {{ $product->short_description }}
                            </div>
                        @endif

                        <!-- Product Form -->
                        <form method="POST" action="{{ route('cart.add') }}" id="productPurchaseForm">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" id="selected_variant_id" value="{{ $product->variants->first()->id ?? '' }}">

                            <!-- Variants Selector (Size / Color) -->
                            <div class="variant-selection mb-4">
                                <label class="font-weight-bold text-dark d-block mb-2">Select Size <span class="text-danger">*</span></label>
                                @if($product->variants && $product->variants->count() > 0)
                                    <div class="variant-buttons d-flex flex-wrap gap-2">
                                        @foreach($product->variants as $index => $variant)
                                            <button type="button" 
                                                    class="btn btn-outline-dark mr-2 mb-2 variant-pill {{ $index == 0 ? 'active' : '' }}" 
                                                    data-variant-id="{{ $variant->id }}"
                                                    data-price="{{ $variant->price ?? $product->price }}"
                                                    data-stock="{{ $variant->stock }}"
                                                    data-image="{{ $variant->image ? asset($variant->image) : '' }}"
                                                    onclick="selectVariant(this)">
                                                {{ $variant->variant_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                @else
                                    <input type="hidden" name="size" id="selected_size" value="M (38)">
                                    <div class="variant-buttons d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-dark mr-2 mb-2 size-pill active" data-size="M (38)" onclick="selectSize(this)">M (38)</button>
                                        <button type="button" class="btn btn-outline-dark mr-2 mb-2 size-pill" data-size="L (40)" onclick="selectSize(this)">L (40)</button>
                                        <button type="button" class="btn btn-outline-dark mr-2 mb-2 size-pill" data-size="XL (42)" onclick="selectSize(this)">XL (42)</button>
                                        <!-- <button type="button" class="btn btn-outline-dark mr-2 mb-2 size-pill" data-size="XXL (44)" onclick="selectSize(this)">XXL (44)</button> -->
                                    </div>
                                @endif
                            </div>

                            <!-- Colors Selector -->
                            <div class="color-selection mb-4">
                                <label class="font-weight-bold text-dark d-block mb-2">Select Color <span class="text-danger">*</span></label>
                                <select name="color" class="form-control" style="max-width: 200px; border-radius: 8px;" required>
                                    <option value="" disabled selected>-- Select Color --</option>
                                    @if(!empty($product->colors))
                                        @php $colorList = array_map('trim', explode(',', $product->colors)); @endphp
                                        @foreach($colorList as $color)
                                            <option value="{{ $color }}">{{ $color }}</option>
                                        @endforeach
                                    @else
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Red">Red</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Navy">Navy</option>
                                        <option value="Grey">Grey</option>
                                    @endif
                                </select>
                            </div>

                            <!-- Quantity & Action Buttons -->
                            <div class="purchase-action-row d-flex flex-wrap align-items-center mb-4">
                                <div class="quantity-input-group d-flex justify-content-between align-items-center border rounded mr-3 mb-2 bg-light" style="width: 130px; height: 45px; overflow: hidden;">
                                    <button type="button" class="btn btn-light h-100 border-0 rounded-0 d-flex align-items-center justify-content-center" style="width: 40px; background: transparent; box-shadow: none;" onclick="changeQty(-1)"><i class="fa fa-minus"></i></button>
                                    <input type="text" id="product_quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="text-center border-0 font-weight-bold m-0 p-0" style="width: 40px; background: transparent; outline: none; box-shadow: none; font-size: 16px;" readonly>
                                    <button type="button" class="btn btn-light h-100 border-0 rounded-0 d-flex align-items-center justify-content-center" style="width: 40px; background: transparent; box-shadow: none;" onclick="changeQty(1)"><i class="fa fa-plus"></i></button>
                                </div>

                                <button type="button" class="btn btn-outline-primary h-100 px-4 mr-2 mb-2 ajax-add-to-cart" data-product-id="{{ $product->id }}" style="height: 45px;">
                                    <i class="fa fa-shopping-bag mr-1"></i> Add to Cart
                                </button>

                                <button type="button" class="btn btn-primary h-100 px-4 mb-2" onclick="buyNow()" style="height: 45px;">
                                    <i class="fa fa-bolt mr-1"></i> Buy Now
                                </button>
                            </div>
                        </form>

                        <!-- Delivery Features Badges -->
                        <div class="delivery-perks border-top pt-3 mt-3 d-flex flex-wrap text-muted small">
                            <div class="perk-item mr-4 mb-2"><i class="fa fa-truck text-primary mr-1"></i> Fast Nationwide Delivery</div>
                            <div class="perk-item mr-4 mb-2"><i class="fa fa-shield text-primary mr-1"></i> 100% Authentic Product</div>
                            <div class="perk-item mb-2"><i class="fa fa-refresh text-primary mr-1"></i> 7 Days Easy Return</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Description Tabs -->
        <div class="card border-0 shadow-sm rounded-lg p-3 p-md-4 mb-5 bg-white">
            <ul class="nav nav-tabs border-bottom mb-3" id="productTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active font-weight-bold" id="desc-tab" data-toggle="tab" href="#descContent" role="tab">Product Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" id="shipping-tab" data-toggle="tab" href="#shippingContent" role="tab">Delivery & Returns</a>
                </li>
            </ul>
            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade show active p-2" id="descContent" role="tabpanel">
                    {!! nl2br(e($product->description ?? $product->short_description)) !!}
                </div>
                <div class="tab-pane fade p-2" id="shippingContent" role="tabpanel">
                    <h5>Delivery Information</h5>
                    <p class="text-muted">Home delivery inside Dhaka takes 24-48 hours. Delivery outside Dhaka takes 2-4 business days via courier partners. Cash on Delivery is available across all 64 districts in Bangladesh.</p>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="related-products-section">
            <div class="heading mb-3 border-bottom pb-2">
                <h3 class="font-weight-bold text-dark m-0" style="font-size: 20px;">Related Products You May Like</h3>
            </div>
            <div class="row">
                @foreach($relatedProducts as $rel)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="product border rounded bg-white p-2 h-100 shadow-sm">
                            <a href="{{ route('product.show', ['slug' => $rel->slug, 'id' => $rel->id]) }}" class="text-decoration-none">
                                <div class="thumb rounded overflow-hidden mb-2" style="height: 180px;">
                                    <img src="{{ asset($rel->thumbnail) }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                                <h6 class="title text-center text-dark text-truncate mb-1">{{ $rel->name }}</h6>
                                <p class="text-center font-weight-bold text-primary m-0">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($rel->price) }}</p>
                            </a>
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
    function switchImage(src, element) {
        $('#mainProductImg').attr('src', src);
        $('.thumb-item').removeClass('active');
        $(element).addClass('active');
    }

    function selectVariant(element) {
        var $el = $(element);
        var variantId = $el.data('variant-id');
        var price = $el.data('price');
        var stock = $el.data('stock');
        var img = $el.data('image');

        $('#selected_variant_id').val(variantId);
        $('.variant-pill').removeClass('active btn-dark').addClass('btn-outline-dark');
        $el.addClass('active btn-dark').removeClass('btn-outline-dark');

        if (img) {
            $('#mainProductImg').attr('src', img);
        }
    }

    function selectSize(element) {
        var $el = $(element);
        var size = $el.data('size');
        $('#selected_size').val(size);
        $('.size-pill').removeClass('active btn-dark').addClass('btn-outline-dark');
        $el.addClass('active btn-dark').removeClass('btn-outline-dark');
    }

    function changeQty(delta) {
        var $qty = $('#product_quantity');
        var current = parseInt($qty.val()) || 1;
        var max = parseInt($qty.attr('max')) || 9999;
        var next = current + delta;
        if (next >= 1 && next <= max) {
            $qty.val(next);
        }
    }

    function buyNow() {
        var form = document.getElementById('productPurchaseForm');
        if(!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        var formData = new FormData(form);

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                product_id: formData.get('product_id'),
                variant_id: formData.get('variant_id'),
                size: formData.get('size'),
                color: formData.get('color'),
                quantity: formData.get('quantity')
            },
            success: function(res) {
                if (res.status === 'success') {
                    window.location.href = "{{ route('checkout.index') }}";
                } else {
                    alertify.error(res.message || 'Error occurred');
                }
            }
        });
    }
</script>
@endpush
