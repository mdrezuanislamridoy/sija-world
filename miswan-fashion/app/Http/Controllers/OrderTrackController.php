<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Setting;

class OrderTrackController extends Controller
{
    public function index()
    {
        return view('frontend.track_order');
    }

    public function track(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'customer_name' => 'required|string',
        ], [
            'phone.required' => 'ফোন নম্বর প্রদান করুন।',
            'customer_name.required' => 'কাস্টমারের নাম প্রদান করুন।',
        ]);

        $order = Order::with('items')
            ->where('phone', trim($request->phone))
            ->where('customer_name', 'like', '%' . trim($request->customer_name) . '%')
            ->latest()
            ->first();

        if (!$order) {
            return back()->with('error', 'দুঃখিত, এই ফোন নম্বর এবং নামের সাথে কোন অর্ডার পাওয়া যায়নি। সঠিক তথ্য দিয়ে আবার চেষ্টা করুন।');
        }

        $globalSetting = Setting::first();
        return view('frontend.track_order_details', compact('order', 'globalSetting'));
    }
}
