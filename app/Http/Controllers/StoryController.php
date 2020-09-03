<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function create()
    {
        return view('stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:5120|image',
        ]);

        $story = new Story;
        $story->user_id = auth()->user()->id;
        $story->image = substr($request->file('image')->store('public/stories'), '7');
        $story->save();

        return redirect()->route('home');
    }
}
