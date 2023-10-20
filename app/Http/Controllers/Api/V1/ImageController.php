<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller {
    public function getImageByUserId(string $id) {
        $images = Image::where('user_id', $id)->get();

        $response = [];
        foreach($images as $i => $value) {
            $imgUrl = $images[$i]['image_path'];
            $fileName = explode("/", $imgUrl)[1];
            array_push($response, "http://localhost:8000/storage/".$fileName);
        }

        return $response;
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public');
        $image = new Image([
            'title' => $request->get('title'),
            'image_path' => $imagePath,
            'user_id' => $request->get('user_id')
        ]);
        $image->save();

        return $image;
    }
}
