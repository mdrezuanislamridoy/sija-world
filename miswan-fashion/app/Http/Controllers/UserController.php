<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $recentOrders = Order::where('user_id', $user->id)->latest()->take(5)->get();
        $totalOrdersCount = Order::where('user_id', $user->id)->count();

        return view('user.dashboard', compact('user', 'recentOrders', 'totalOrdersCount'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::with('items')->where('user_id', $user->id)->latest()->paginate(10);

        return view('user.orders', compact('user', 'orders'));
    }

    public function orderDetails($orderNumber)
    {
        $user = Auth::user();
        $order = Order::with('items')->where('user_id', $user->id)->where('order_number', $orderNumber)->firstOrFail();

        return view('user.order_details', compact('user', 'order'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'district' => 'nullable|string|max:100',
            'upazila' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return back()->with('profile_success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('password_success', 'Password changed successfully!');
    }
}
