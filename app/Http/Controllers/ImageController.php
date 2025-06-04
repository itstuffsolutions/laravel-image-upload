<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function postImage(Request $request){
         $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048 |dimensions:min_width=100,max_width=500',
        ]);
        $imageName = time(). '_' . Str::random(10).'.'.$request->image->extension();
        //store file in public folder
        $request->image->move(public_path('uploads'), $imageName);
       //store file in storage folder
       //$path = $request->file('image')->storeAs($imageName);
       

        return back()->with('success', 'Image uploaded successfully!');
    }
}
