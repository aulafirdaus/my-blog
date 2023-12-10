<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('password.edit');
    }
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', ''],
            'password' => ['required', 'confirmed', 'min:8', 'max:128'],
        ]);
        if (!Hash::check($request->current_password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The provided password does not match your current password.',
            ]);
        }
        Auth::user()->update(['password' => bcrypt($request->password)]);
        session()->flash('status', 'Password has been changed.');
        return back();
    }
}
