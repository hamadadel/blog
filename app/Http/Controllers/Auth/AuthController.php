<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'min:5', 'alpha_dash', 'max:70', Rule::unique('users', 'username')],
            'name' => ['required', 'min:5', 'max:70'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $user = User::create($data);
        auth()->login($user);
        return redirect(route('dashboard'))->with('success', 'Thank you for choosing us');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'loginemail' => ['required', 'min:4', 'max:70'],
            'loginpassword' => ['required', 'min:4']
        ]);
        if (auth()->attempt(['email' => $data['loginemail'], 'password' => $data['loginpassword']])) {
            $request->session()->regenerate();
            return redirect(route('dashboard'))->with('success', 'Welcome back');
        }
        return back()->with('failure', 'Wrong credentials');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You logout successfully');
    }
}
