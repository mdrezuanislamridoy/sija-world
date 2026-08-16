<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('priority', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'priority' => 'nullable|integer',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
            $imagePath = 'uploads/categories/' . $imageName;
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'image' => $imagePath,
            'priority' => $validated['priority'] ?? 1,
            'is_featured' => 1,
            'status' => 1,
        ]);

        return back()->with('success', 'Category added successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'priority' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName;
        }

        $category->update([
            'name' => $validated['name'],
            'image' => $category->image,
            'priority' => $validated['priority'] ?? 1,
        ]);

        return back()->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }
}
