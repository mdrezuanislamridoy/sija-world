<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('order_status', '!=', 'Cancelled')->sum('grand_total');
        $totalProducts = Product::count();
        $totalUsers = User::count();

        $pendingOrders = Order::where('order_status', 'Pending')->count();
        $processingOrders = Order::where('order_status', 'Processing')->count();
        $deliveredOrders = Order::where('order_status', 'Delivered')->count();

        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalUsers',
            'pendingOrders',
            'processingOrders',
            'deliveredOrders',
            'recentOrders'
        ));
    }
}
