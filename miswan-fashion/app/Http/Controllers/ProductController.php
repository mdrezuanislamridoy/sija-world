<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function category($categorySlug, $subcategorySlug = null)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $query = Product::where('status', 1)->where('category_id', $category->id);

        $selectedSubCategory = null;
        if ($subcategorySlug) {
            $selectedSubCategory = SubCategory::where('slug', $subcategorySlug)->where('category_id', $category->id)->first();
            if ($selectedSubCategory) {
                $query->where('sub_category_id', $selectedSubCategory->id);
            }
        }

        // Sorting
        if (request('sort') == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif (request('sort') == 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(16);

        return view('frontend.category', compact('category', 'selectedSubCategory', 'products'));
    }

    public function show($slug, $id = null)
    {
        $query = Product::where('status', 1);
        if ($id) {
            $query->where('id', $id);
        } else {
            $query->where('slug', $slug);
        }
        $product = $query->with(['category', 'galleries', 'attributes.values', 'variants'])->firstOrFail();

        // Increment views
        $product->increment('views');

        $relatedProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(8)
            ->get();

        return view('frontend.product_details', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $products = Product::where('status', 1)
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('sku', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(16);

        return view('frontend.search', compact('products', 'keyword'));
    }
}
