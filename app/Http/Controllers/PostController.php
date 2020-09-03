<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:32',
            'image' => 'max:5120|image',
            'description' => 'required|max:2000'
        ]);

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;

        if ($request->hasFile('image')) {
            $post->image = substr($request->file('image')->store('public/images'), '7');
        }

        $post->description = $request->description;
        $post->save();
        
        return redirect()->route('home');
    }

    public function show(int $id)
    {
        return view('posts.show', [
            'post' => Post::with('user')->firstWhere('id', $id)
        ]);
    }

    public function destroy(int $id)
    {
        Post::destroy($id);

        return redirect()->route('home');
    }
}
