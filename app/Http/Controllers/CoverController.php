<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'images' => 'required|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    foreach ($request->file('images') as $image) {
        $path = $image->store('slides', 'public');
        Cover::create(['image_path' => $path]);
    }

    return redirect()->back()->with('success', 'Covers added successfully!');
}


    public function edit($id, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cover = Cover::findOrFail($id);

        $path = $request->file('image')->store('slides', 'public');

        $cover->update(['image_path' => $path]);

        return redirect()->back()->with('success', 'Cover updated successfully!');
    }

    public function destroy($id)
    {
        $cover = Cover::findOrFail($id);

        $cover->delete();

        return redirect()->back()->with('success', 'Cover deleted successfully!');
    }
}
