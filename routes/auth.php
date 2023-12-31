<?php

use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
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

    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'store'])->name('password.update');
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


