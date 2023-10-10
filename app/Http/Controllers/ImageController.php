<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller {
    public function getImageByUserId(string $id) {
        $localUrl = Image::where('user_id', $id)->get()[0]['image_path'];
        $fileName = explode("/", $localUrl)[1];
        return "http://localhost:8000/storage/".$fileName;
    }

    public function store(Request $request) {
        
        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public');

        // $imagePath = Storage::put('public', $request->get('image'));

        $image = new Image([
            'title' => $request->get('title'),
            'image_path' => $imagePath,
            'user_id' => $request->get('user_id')
        ]);
        $image->save();

        return $image;
    }
}
