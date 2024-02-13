<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function profile(User $user)
    {
        $user->load('posts');
        return view('user.profile', ['user' => $user]);
    }

    public function avatar()
    {
        return view('user.avatar', ['user' => auth()->user()]);
    }
    public function storeAvatar(Request $request)
    {
        $request->file('avatar')->store('avatars');
    }
}
