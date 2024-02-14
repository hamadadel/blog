<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class FollowController extends Controller
{
    public function follow(User $user)
    {
        if (auth()->id() === $user->id)
            return abort(403);

        auth()->user()->toggleFollow($user);
        return redirect('/profile/' . auth()->user()->username);
    }

    public function followers(User $user)
    {
        $user->load('followers');
        return view('user.followers', ['user' => $user]);
    }

    public function following(User $user)
    {
        $user->load('following');
        return view('user.following', ['user' => $user]);
    }
}
