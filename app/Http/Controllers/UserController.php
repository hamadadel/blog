<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile(User $user)
    {
        $user->load('posts', 'followers', 'following');
        return view('user.profile', ['user' => $user]);
    }

    public function avatar()
    {
        return view('user.avatar');
    }
    public function storeAvatar(Request $request)
    {
        $user = $request->user();
        // dd(str_contains($user->avatar, 'fallback-avatar.jp'));
        $request->validate([
            'avatar' => 'required|image'
        ]);
        $imageName = $user->id . '-' . uniqid() . '.png';
        // composer require intervention/image
        $rawImage = Image::make($request->avatar)->fit(120)->encode('png');
        Storage::put('avatars/' . $imageName, $rawImage);

        if (!str_contains($user->avatar, 'fallback-avatar.jp')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
        }
        $user->avatar = 'storage/avatars/' . $imageName;
        $user->save();

        return redirect('/profile/' . $user->username);
    }
}
