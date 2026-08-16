<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banner;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order', 'asc')->get();
        $banners = Banner::all();
        return view('admin.sliders.index', compact('sliders', 'banners'));
    }

    public function storeSlider(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:191',
            'link' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/sliders'), $imageName);
            $imagePath = 'uploads/sliders/' . $imageName;
        }

        Slider::create([
            'title' => $validated['title'] ?? 'Slider Banner',
            'link' => $validated['link'] ?? '/',
            'image' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 1,
            'status' => 1,
        ]);

        return back()->with('success', 'Slider banner added successfully!');
    }

    public function destroySlider($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return back()->with('success', 'Slider banner deleted successfully!');
    }
}
