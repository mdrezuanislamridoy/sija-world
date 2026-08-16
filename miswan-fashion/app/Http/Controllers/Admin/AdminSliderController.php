<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Product;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('product')->orderBy('sort_order', 'asc')->get();
        $banners = Banner::with('product')->latest()->get();
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();

        return view('admin.sliders.index', compact('sliders', 'banners', 'products'));
    }

    public function storeSlider(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:191',
            'subtitle' => 'nullable|string|max:191',
            'product_id' => 'nullable|exists:products,id',
            'link' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'sort_order' => 'nullable|integer',
            'button_text' => 'nullable|string|max:50',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders'), $imageName);
            $imagePath = 'uploads/sliders/' . $imageName;
        }

        $link = $validated['link'] ?? '';
        if (!empty($validated['product_id']) && empty($link)) {
            $product = Product::find($validated['product_id']);
            if ($product) {
                $link = route('product.show', ['slug' => $product->slug, 'id' => $product->id]);
            }
        }

        Slider::create([
            'title' => $validated['title'] ?? 'Featured Slider',
            'subtitle' => $validated['subtitle'] ?? null,
            'product_id' => $validated['product_id'] ?? null,
            'link' => $link ?: '/',
            'image' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 1,
            'button_text' => $validated['button_text'] ?? 'Shop Now',
            'status' => 1,
        ]);

        return back()->with('success', 'Hero Slider added successfully!');
    }

    public function destroySlider($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image && file_exists(public_path($slider->image))) {
            @unlink(public_path($slider->image));
        }
        $slider->delete();

        return back()->with('success', 'Hero Slider deleted successfully!');
    }

    public function storeBanner(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:191',
            'subtitle' => 'nullable|string|max:191',
            'position' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
            'link' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            'button_text' => 'nullable|string|max:50',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $imageName);
            $imagePath = 'uploads/banners/' . $imageName;
        }

        $link = $validated['link'] ?? '';
        if (!empty($validated['product_id']) && empty($link)) {
            $product = Product::find($validated['product_id']);
            if ($product) {
                $link = route('product.show', ['slug' => $product->slug, 'id' => $product->id]);
            }
        }

        Banner::create([
            'title' => $validated['title'] ?? 'Promo Banner',
            'subtitle' => $validated['subtitle'] ?? null,
            'position' => $validated['position'],
            'product_id' => $validated['product_id'] ?? null,
            'link' => $link ?: '/',
            'image' => $imagePath,
            'button_text' => $validated['button_text'] ?? 'Buy Now',
            'status' => 1,
        ]);

        return back()->with('success', 'Promotional Banner added successfully!');
    }

    public function destroyBanner($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image && file_exists(public_path($banner->image))) {
            @unlink(public_path($banner->image));
        }
        $banner->delete();

        return back()->with('success', 'Promotional Banner deleted successfully!');
    }
}
