<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function create(){
        return view('auth.forgot-password');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
