<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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

        tap(User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]), function ($user){
                    if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()){
                        $user->sendEmailVerificationNotification();
                    }
                    Auth::login($user);
                });
        return redirect(RouteServiceProvider::HOME);
    }
}
