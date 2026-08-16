<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is currently empty.');
        }

        $districts = District::orderBy('name', 'asc')->get();
        $setting = Setting::first();

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $coupon = session()->get('coupon', null);
        $discount = 0;
        if ($coupon) {
            $discount = $coupon['type'] == 'percentage' ? ($subtotal * ($coupon['value'] / 100)) : $coupon['value'];
        }

        $shippingCost = $setting->shipping_inside_city ?? 80.00;
        $grandTotal = max(0, $subtotal - $discount + $shippingCost);

        return view('frontend.checkout', compact('cart', 'districts', 'subtotal', 'discount', 'shippingCost', 'grandTotal', 'setting'));
    }

    public function getShippingCost(Request $request)
    {
        $districtId = $request->input('district_id');

        if ($districtId == 'inside_dhaka') {
            $shippingCost = 80.00;
        } elseif ($districtId == 'outside_dhaka') {
            $shippingCost = 130.00;
        } else {
            $setting = Setting::first();
            $shippingCost = (float)($setting->shipping_inside_city ?? 80.00);
        }

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

        $grandTotal = max(0, $subtotal - $discount + $shippingCost);
        $currency = Setting::first()->currency_symbol ?? 'TK';

        return response()->json([
            'status' => 'success',
            'shipping_cost' => $shippingCost,
            'shipping_formatted' => "{$currency} " . number_format($shippingCost, 2),
            'grand_total' => $grandTotal,
            'grand_total_formatted' => "{$currency} " . number_format($grandTotal),
        ]);
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:191',
            'phone' => ['required', 'regex:/^(?:\+?88)?01[3-9][0-9]{8}$/'],
            'alt_phone' => 'nullable|string|max:20',
            'district_id' => 'required',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'order_notes' => 'nullable|string',
        ], [
            'phone.regex' => 'অনুগ্রহ করে সঠিক ১১ ডিজিটের মোবাইল নম্বর প্রদান করুন (যেমন: 01712345678)।',
            'customer_name.required' => 'আপনার নাম লিখুন।',
            'address.required' => 'ডেলিভারি ঠিকানা লিখুন।',
            'district_id.required' => 'লোকেশন / জেলা নির্বাচন করুন।',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $coupon = session()->get('coupon', null);
        $discount = 0;
        if ($coupon) {
            $discount = $coupon['type'] == 'percentage' ? ($subtotal * ($coupon['value'] / 100)) : $coupon['value'];
        }

        $districtId = $request->district_id;
        if ($districtId == 'inside_dhaka') {
            $districtName = 'Inside Dhaka';
            $shippingCost = 80.00;
        } elseif ($districtId == 'outside_dhaka') {
            $districtName = 'Outside Dhaka';
            $shippingCost = 130.00;
        } else {
            $districtName = 'Dhaka';
            $shippingCost = 80.00;
        }

        $grandTotal = max(0, $subtotal - $discount + $shippingCost);
        $orderNumber = 'MSW-' . date('ymd') . '-' . strtoupper(substr(uniqid(), -4));

        try {
            DB::beginTransaction();

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => Auth::check() ? Auth::id() : null,
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'alt_phone' => $validated['alt_phone'] ?? null,
                'email' => $request->email ?? null,
                'district' => $districtName,
                'upazila' => $request->upazila ?? null,
                'address' => $validated['address'],
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
                'grand_total' => $grandTotal,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'Pending',
                'order_status' => 'Pending',
                'order_notes' => $validated['order_notes'] ?? null,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'] ?? null,
                    'product_name' => $item['name'],
                    'variant_name' => $item['variant_name'] ?? null,
                    'product_image' => $item['image'] ?? null,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Decrement stock
                Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // Clear session cart
            session()->forget(['cart', 'coupon']);

            return redirect()->route('order.success', $order->order_number)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Error: ' . $e->getMessage())->withInput();
        }
    }

    public function orderSuccess($orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
        return view('frontend.order_success', compact('order'));
    }
}
