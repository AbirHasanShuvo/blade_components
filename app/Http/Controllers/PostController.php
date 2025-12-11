<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function ourFileStore(Request $request)
    {
        $post = new Post();

        $validator = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->name = $request->name;
        $post->description = $request->description;
        $post->image = $request->image;
        $post->save();

        //redirect to the home page
        return redirect()->route('home')->with('success', 'Your Post has been Created!');
    }
}
