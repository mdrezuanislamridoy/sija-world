<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\ProductVariant;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'previous_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'colors' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $imagePath = '';
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }

        $slug = Str::slug($validated['name']) . '-' . rand(100, 999);
        $discount = 0;
        if (!empty($validated['previous_price']) && $validated['previous_price'] > $validated['price']) {
            $discount = round((($validated['previous_price'] - $validated['price']) / $validated['previous_price']) * 100);
        }

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => 'MSW-' . strtoupper(Str::random(6)),
            'price' => $validated['price'],
            'previous_price' => $validated['previous_price'] ?? null,
            'discount_percent' => $discount,
            'stock' => $validated['stock'],
            'thumbnail' => $imagePath,
            'colors' => $validated['colors'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_bestseller' => $request->has('is_bestseller') ? 1 : 0,
            'status' => 1,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'previous_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'colors' => 'nullable|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $product->thumbnail = 'uploads/products/' . $imageName;
        }

        $discount = 0;
        if (!empty($validated['previous_price']) && $validated['previous_price'] > $validated['price']) {
            $discount = round((($validated['previous_price'] - $validated['price']) / $validated['previous_price']) * 100);
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'previous_price' => $validated['previous_price'] ?? null,
            'discount_percent' => $discount,
            'stock' => $validated['stock'],
            'thumbnail' => $product->thumbnail,
            'colors' => $validated['colors'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_bestseller' => $request->has('is_bestseller') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
