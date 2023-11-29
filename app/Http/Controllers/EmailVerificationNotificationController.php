<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class EmailVerificationNotificationController extends Controller
{
    public function notice(Request $request){
        return $request->user()->hasVerifiedEmail() ? redirect()->intended(RouteServiceProvider::HOME) : view('auth.verify-email');
    }

    public function sendVerification(Request $request){
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $request->user()->sendEmailVerificationNotification();
        session()->flash('status', 'Link verification email has been sent into your email address.');
        return back();
    }
}
