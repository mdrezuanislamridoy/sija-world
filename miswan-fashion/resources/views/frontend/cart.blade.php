@extends('layouts.app')

@section('title', 'Shopping Cart - ' . ($globalSetting->site_name ?? 'Miswan Fashion'))

@section('content')
<div class="cart-page-area py-5 bg-light">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </nav>

        @if(!empty($cart) && count($cart) > 0)
            <div class="row">
                <!-- Cart Items Table -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm rounded-lg p-3 p-md-4 bg-white" id="cartPageTable">
                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                            <h4 class="font-weight-bold text-dark m-0"><i class="fa fa-shopping-bag text-primary mr-2"></i> Items in Cart ({{ count($cart) }})</h4>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" style="min-width: 250px;">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" style="min-width: 140px;">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                        <tr data-cart-id="{{ $id }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($item['image'] ?? 'assets/ecommerce/dist/images/default.png') }}" class="rounded mr-3 border" width="65" height="65" style="object-fit: cover;">
                                                    <div>
                                                        <h6 class="font-weight-bold text-dark m-0">{{ $item['name'] }}</h6>
                                                        @if(!empty($item['variant_name']))
                                                            <small class="badge badge-light border text-muted mt-1">Size / Variant: {{ $item['variant_name'] }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="font-weight-bold text-dark">
                                                {{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item['price']) }}
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm" style="width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary px-2" type="button" onclick="updateItemQty('{{ $id }}', -1)"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                    <input type="text" class="form-control text-center font-weight-bold" id="item-qty-{{ $id }}" value="{{ $item['quantity'] }}" readonly>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary px-2" type="button" onclick="updateItemQty('{{ $id }}', 1)"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="font-weight-bold text-primary">
                                                {{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item['price'] * $item['quantity']) }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-danger remove-from-cart-btn" data-cart-id="{{ $id }}" title="Remove item">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left mr-1"></i> Continue Shopping</a>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
                        <h5 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="font-weight-bold text-dark">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($subtotal) }}</span>
                        </div>

                        @if($discount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>Discount:</span>
                                <span class="font-weight-bold">- {{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($discount) }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-3 text-muted small">
                            <span>Shipping Cost:</span>
                            <span>Calculated at checkout</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4 border-top pt-3">
                            <span class="font-weight-bold h5 m-0 text-dark">Estimated Total:</span>
                            <span class="font-weight-bold h5 m-0 text-primary">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($grandTotal) }}</span>
                        </div>

                        <!-- Apply Coupon Section -->
                        <div class="coupon-section mb-4">
                            <form id="applyCouponForm" onsubmit="handleCouponSubmit(event)">
                                <div class="input-group">
                                    <input type="text" id="coupon_code" name="code" class="form-control" placeholder="Promo / Coupon Code" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="submit">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block py-3 font-weight-bold shadow-sm" style="font-size: 16px;">
                            Proceed to Checkout <i class="fa fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="card border-0 shadow-sm rounded-lg p-5 bg-white text-center">
                <i class="fa fa-shopping-basket fa-5x text-muted mb-4 d-block"></i>
                <h3 class="font-weight-bold text-dark mb-2">Your Shopping Cart is Empty</h3>
                <p class="text-muted mb-4">Looks like you haven't added any fashion items to your cart yet.</p>
                <div>
                    <a href="{{ url('/') }}" class="btn btn-primary px-5 py-3 font-weight-bold">Start Shopping Now</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateItemQty(cartId, delta) {
        var $input = $('#item-qty-' + cartId);
        var current = parseInt($input.val()) || 1;
        var next = current + delta;
        if (next >= 1) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: "POST",
                data: {
                    cart_id: cartId,
                    quantity: next
                },
                success: function (res) {
                    if (res.status === 'success') {
                        location.reload();
                    }
                }
            });
        }
    }

    function handleCouponSubmit(e) {
        e.preventDefault();
        var code = $('#coupon_code').val();
        $.ajax({
            url: "{{ route('cart.coupon') }}",
            method: "POST",
            data: { code: code },
            success: function (res) {
                if (res.status === 'success') {
                    alertify.success(res.message);
                    setTimeout(function() { location.reload(); }, 800);
                } else {
                    alertify.error(res.message);
                }
            }
        });
    }
</script>
@endpush
