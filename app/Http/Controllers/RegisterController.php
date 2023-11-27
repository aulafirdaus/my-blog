<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm(){
        return view('auth.register');
    }

    public function registerUser(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return to_route('home');
    }
}
