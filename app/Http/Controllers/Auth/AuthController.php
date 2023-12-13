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
            'name' => ['required', 'min:5', 'max:70', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ],);

        return User::create($data) ? 'Register done' : 'Register fail';
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'loginname' => ['required', 'min:4', 'max:70'],
            'loginpassword' => ['required', 'min:4']
        ]);
        if (auth()->attempt(['name' => $data['loginname'], 'password' => $data['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Welcome back ' . $data['loginname']);
        }
        return redirect('/')->with('failure', 'Wrong credentials');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You logout successfully');
    }
}
