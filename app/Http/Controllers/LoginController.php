<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'password' => 'These credentials do not match our records.'
            ]);
        }
        $request->session()->regenerate();
        return to_route('home');
    }
}
