<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('product')->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $categories = Category::where('status', 1)->orderBy('priority', 'asc')->get();
        $bestSellingProducts = Product::where('status', 1)->where('is_bestseller', 1)->latest()->take(10)->get();
        $featuredProducts = Product::where('status', 1)->where('is_featured', 1)->latest()->take(10)->get();
        $topBanners = Banner::with('product')->where('status', 1)->where('position', 'top_banner')->latest()->take(2)->get();
        $middleBanners = Banner::with('product')->where('status', 1)->where('position', 'middle_banner')->latest()->take(2)->get();

        return view('frontend.index', compact(
            'sliders',
            'categories',
            'bestSellingProducts',
            'featuredProducts',
            'topBanners',
            'middleBanners'
        ));
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }
}
