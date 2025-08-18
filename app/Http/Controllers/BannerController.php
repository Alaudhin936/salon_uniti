<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('banners', compact('banners'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'redirect_url' => 'required|url',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $path = $request->file('banner_image')->store('banners', 'public');
        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'redirect_url' => $request->redirect_url,
            'image' => isset($path) ? $path : null,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['status' => 200]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $banner = Banner::findOrFail($id);

        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->redirect_url = $request->redirect_url;
        $banner->is_active = $request->is_active;

        if ($request->hasFile('banner_image')) {
            // delete old image if exists
            if ($banner->image && \Storage::exists('public/' . $banner->image)) {
                \Storage::delete('public/' . $banner->image);
            }

            $path = $request->file('banner_image')->store('banners', 'public');
            $banner->image = $path;
        }

        $banner->save();

        return response()->json(['success' => true, 'banner' => $banner]);
    }

    public function delete(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && \Storage::exists('public/' . $banner->image)) {
            \Storage::delete('public/' . $banner->image);
        }

        $banner->delete();

        return response()->json(['success' => true]);
    }
}
