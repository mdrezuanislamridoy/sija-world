<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Coupon;
use App\Models\Setting;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $coupon = session()->get('coupon', null);
        $discount = 0;
        if ($coupon) {
            $discount = $coupon['type'] == 'percentage' ? ($subtotal * ($coupon['value'] / 100)) : $coupon['value'];
        }

        $grandTotal = max(0, $subtotal - $discount);

        return view('frontend.cart', compact('cart', 'subtotal', 'discount', 'grandTotal'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $color = $request->input('color');
        $size = $request->input('size');
        $quantity = max(1, (int)$request->input('quantity', 1));

        $product = Product::findOrFail($productId);
        $variant = $variantId ? ProductVariant::find($variantId) : null;

        $cartKey = $variant ? "{$product->id}-{$variant->id}" : "{$product->id}";
        if ($size && !$variant) {
            $cartKey .= "-size-" . Str::slug($size);
        }
        if ($color) {
            $cartKey .= "-color-" . Str::slug($color);
        }
        $cart = session()->get('cart', []);

        $price = $product->price;
        $variantName = $variant ? $variant->variant_name : null;
        if (!$variantName && $size) {
            $variantName = "Size: {$size}";
        }
        if ($color) {
            $variantName = $variantName ? "{$variantName}, Color: {$color}" : "Color: {$color}";
        }
        $image = ($variant && $variant->image) ? $variant->image : $product->thumbnail;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'variant_id' => $variant ? $variant->id : null,
                'name' => $product->name,
                'variant_name' => $variantName,
                'price' => (float)$price,
                'quantity' => $quantity,
                'image' => $image,
            ];
        }

        session()->put('cart', $cart);

        // Generate drawer HTML
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $currency = Setting::first()->currency_symbol ?? 'TK';

        $drawerHtml = '';
        foreach ($cart as $id => $item) {
            $imgSrc = asset($item['image'] ?? 'assets/ecommerce/dist/images/default.png');
            $vName = $item['variant_name'] ? "<small class='text-muted'>{$item['variant_name']}</small><br>" : "";
            $formattedPrice = number_format($item['price']);
            $drawerHtml .= "
                <li class='cart-drawer-item d-flex align-items-center justify-content-between py-2 border-bottom' data-cart-id='{$id}'>
                    <div class='d-flex align-items-center'>
                        <img src='{$imgSrc}' width='50' height='50' class='rounded mr-2' style='object-fit: cover;' alt='{$item['name']}'>
                        <div>
                            <h6 class='m-0 text-truncate' style='max-width: 180px; font-size: 14px;'>{$item['name']}</h6>
                            {$vName}
                            <small class='text-primary font-weight-bold'>{$currency} {$formattedPrice} &times; {$item['quantity']}</small>
                        </div>
                    </div>
                    <button class='btn btn-sm text-danger remove-from-cart-btn' data-cart-id='{$id}' title='Remove item'>
                        <i class='fa fa-trash-o'></i>
                    </button>
                </li>
            ";
        }

        return response()->json([
            'status' => 'success',
            'message' => "{$product->name} added to your cart!",
            'cart_count' => count($cart),
            'subtotal_formatted' => "{$currency} " . number_format($subtotal),
            'drawer_html' => $drawerHtml,
        ]);
    }

    public function updateCart(Request $request)
    {
        $cartId = $request->input('cart_id');
        $quantity = max(1, (int)$request->input('quantity', 1));

        $cart = session()->get('cart', []);
        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return response()->json(['status' => 'success']);
    }

    public function removeFromCart(Request $request)
    {
        $cartId = $request->input('cart_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$cartId])) {
            unset($cart[$cartId]);
            session()->put('cart', $cart);
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $currency = Setting::first()->currency_symbol ?? 'TK';

        $drawerHtml = '';
        if (empty($cart)) {
            $drawerHtml = "
                <li class='emty-cart-msg text-center py-5'>
                    <i class='fa fa-shopping-basket fa-3x text-muted mb-3 d-block'></i>
                    <p class='text-muted'>You have no items in your cart.</p>
                    <a href='/' class='btn btn-sm btn-primary mt-2'>Start Shopping</a>
                </li>
            ";
        } else {
            foreach ($cart as $id => $item) {
                $imgSrc = asset($item['image'] ?? 'assets/ecommerce/dist/images/default.png');
                $vName = $item['variant_name'] ? "<small class='text-muted'>{$item['variant_name']}</small><br>" : "";
                $formattedPrice = number_format($item['price']);
                $drawerHtml .= "
                    <li class='cart-drawer-item d-flex align-items-center justify-content-between py-2 border-bottom' data-cart-id='{$id}'>
                        <div class='d-flex align-items-center'>
                            <img src='{$imgSrc}' width='50' height='50' class='rounded mr-2' style='object-fit: cover;' alt='{$item['name']}'>
                            <div>
                                <h6 class='m-0 text-truncate' style='max-width: 180px; font-size: 14px;'>{$item['name']}</h6>
                                {$vName}
                                <small class='text-primary font-weight-bold'>{$currency} {$formattedPrice} &times; {$item['quantity']}</small>
                            </div>
                        </div>
                        <button class='btn btn-sm text-danger remove-from-cart-btn' data-cart-id='{$id}' title='Remove item'>
                            <i class='fa fa-trash-o'></i>
                        </button>
                    </li>
                ";
            }
        }

        return response()->json([
            'status' => 'success',
            'cart_count' => count($cart),
            'subtotal_formatted' => "{$currency} " . number_format($subtotal),
            'drawer_html' => $drawerHtml,
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $code = trim($request->input('code'));
        $coupon = Coupon::where('code', $code)->where('status', 1)->first();

        if (!$coupon) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired coupon code.']);
        }

        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($subtotal < $coupon->min_purchase) {
            return response()->json(['status' => 'error', 'message' => "Minimum purchase required is TK {$coupon->min_purchase}"]);
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }
}
