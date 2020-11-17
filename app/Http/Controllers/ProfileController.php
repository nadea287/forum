<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $comments = Comment::where('user_id', $user->id)->where('commentable_type', 'App\Models\Thread')->get();

        $feeds = $user->feeds;
        return view('profile.show', compact('user', 'comments'));
    }

    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $data = $request->validated();
        if (request('image')) {
            $imagePath = $data['image']->store('profile', 'public');
            $imageArray = ['image' => $imagePath];
        }
        auth()->user()->profile()->update(array_merge(
            $imageArray ?? [],
        ));

        session()->flash('success', 'Profile was updated');

        return redirect('/profile/' . $user->id);
    }
}
