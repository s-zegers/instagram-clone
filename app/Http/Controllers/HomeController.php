<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'stories' => Story::with('user')->where('created_at', '>', Carbon::now()->subDay(1))->get()->sortDesc(),
            // 'stories' => Story::with('user')->where('created_at', '>', Carbon::now()->subDay(1))->where('created_at', '<', Carbon::now())->get()->sortDesc(),
            'posts' => Post::with('user')->get()->sortDesc()
        ]);
    }
}
