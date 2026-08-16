<!-- Cart Slide-Out Sheet & Overlay -->
<div id="cartshortsummery">
    <li class="cart-header dropdown head-cart-content">
        <a href="javascript:void(0)" id="cartTrigger" class="dropdown-toggle" aria-haspopup="dialog" aria-expanded="false">
            <span class="badge badge-secondary cart-count-badge">{{ count(session('cart', [])) }}</span>
            <img class="fa" src="{{ asset('assets/ecommerce/resources/cart_bag.svg') }}" alt="carticon" />
            <span class="block">
                <span class="items"><span class="cart-count-text">{{ count(session('cart', [])) }}</span>&nbsp;Item(s)</span>
            </span>
        </a>

        <div id="cartSheetPanel" class="shopping-cart dropdown-menu cart-sheet" aria-labelledby="cartTrigger">
            <div class="cart-sheet-header d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 class="m-0 font-weight-bold"><i class="fa fa-shopping-bag"></i> Your Shopping Bag</h5>
                <button type="button" class="sheet-close-btn btn btn-sm btn-light" aria-label="Close cart" id="cartCloseBtn">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <div class="cart-sheet-body p-3" style="max-height: calc(100vh - 220px); overflow-y: auto;">
                <ul class="shopping-cart-items list-unstyled m-0" id="cartDrawerItemsList">
                    @php
                        $cart = session('cart', []);
                        $cartSubtotal = 0;
                    @endphp
                    @forelse($cart as $id => $item)
                        @php $cartSubtotal += $item['price'] * $item['quantity']; @endphp
                        <li class="cart-drawer-item d-flex align-items-center justify-content-between py-2 border-bottom" data-cart-id="{{ $id }}">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($item['image'] ?? 'assets/ecommerce/dist/images/default.png') }}" width="50" height="50" class="rounded mr-2" style="object-fit: cover;" alt="{{ $item['name'] }}">
                                <div>
                                    <h6 class="m-0 text-truncate" style="max-width: 180px; font-size: 14px;">{{ $item['name'] }}</h6>
                                    @if(!empty($item['variant_name']))
                                        <small class="text-muted">{{ $item['variant_name'] }}</small><br>
                                    @endif
                                    <small class="text-primary font-weight-bold">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($item['price']) }} &times; {{ $item['quantity'] }}</small>
                                </div>
                            </div>
                            <button class="btn btn-sm text-danger remove-from-cart-btn" data-cart-id="{{ $id }}" title="Remove item">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </li>
                    @empty
                        <li class="emty-cart-msg text-center py-5">
                            <i class="fa fa-shopping-basket fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted">You have no items in your cart.</p>
                            <a href="{{ url('/') }}" class="btn btn-sm btn-primary mt-2">Start Shopping</a>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="cart-sheet-footer p-3 border-top bg-light" style="position: absolute; bottom: 0; left: 0; right: 0;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="font-weight-bold">Subtotal:</span>
                    <span class="font-weight-bold text-danger h5 m-0" id="cartDrawerSubtotal">{{ $globalSetting->currency_symbol ?? 'TK' }} {{ number_format($cartSubtotal) }}</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-block mr-2">View Cart</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block m-0">Checkout</a>
                </div>
            </div>
        </div>
    </li>
</div>

<div id="cartOverlay" class="cart-overlay"></div>

<style>
    .cart-sheet {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        left: auto !important;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        width: 380px !important;
        max-width: 90vw;
        height: 100vh !important;
        margin: 0 !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
        z-index: 99999;
        pointer-events: auto !important;
        background: #fff;
    }
    .cart-sheet.show {
        transform: translateX(0);
        display: block !important;
    }
    .cart-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: 99998;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease-in-out;
    }
    .cart-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    body.cart-sheet-open {
        overflow: hidden;
    }
</style>
