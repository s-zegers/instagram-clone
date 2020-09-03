<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function show(int $id)
    {
        $user = User::with('posts')->with('stories')->firstWhere('id', $id);
        $followers = User::whereIn('id', $user->follower_list)->get();

        return view('profile.show', compact('user', 'followers'));
    }

    public function edit(int $id)
    {
        if (auth()->user()->id !== $id) {
            return redirect()->route('profile.index');
        }

        return view('profile.edit');
    }

    public function update(Request $request, int $id)
    {
        if (auth()->user()->id !== $id) {
            return redirect()->route('profile.index');
        }

        $request->validate([
            'name' => 'required',
            'email' =>  'required|email',
            'profile_picture' => 'max:5120|image'
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            $user->profile_picture = substr($request->file('profile_picture')->store('public/profiles'), '7');
        }

        if (isset($request->password)) {
            if ($request->password !== $request->password_confirm) {
                return redirect()->back()->with('mismatch', "The password's don't match");
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.index');
    }

    public function destroy(int $id)
    {
        auth()->logout();

        User::destroy($id);

        return redirect()->route('home');
    }

    public function follow(int $id)
    {
        $user = User::find($id);
        
        if (! $user->follower_list->contains(auth()->user()->id)) {
            $follower_list = $user->follower_list;
            $follower_list->push(auth()->user()->id);
            $user->follower_list = $follower_list;
        }

        $user->save();

        return redirect()->route('profile.show', $id);
    }

    public function unfollow(int $id)
    {
        $user = User::find($id);

        if (($key = array_search(auth()->user()->id, $user->follower_list->toArray())) !== false) {
            $follower_list = $user->follower_list;
            $follower_list->forget($key);
            $user->follower_list = $follower_list;
        }

        $user->save();

        return redirect()->route('profile.show', $id);
    }
}
