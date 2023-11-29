<?php

use App\Http\Controllers\EmailVerificationNotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifyEmailController;

# Register and Login
Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'registerUser')->name('register');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'loginUser')->name('login');
    });
});

# Verify Email dan Logout
Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationNotificationController::class, 'notice'])->name('verification.notice');

    Route::middleware('throttle:6,1')->group(function () {
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed'])->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'sendVerification'])->name('verification.send');
    });

    Route::post('logout', LogoutController::class)->middleware('auth')->name('logout');
});


