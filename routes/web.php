<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');

# Articles
Route::resource('articles', ArticleController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);

require __DIR__.'/auth.php';

# Change Password
Route::controller(ChangePasswordController::class)->middleware('auth')->group(function () {
    Route::get('account/password-edit', 'edit')->name('change-password.edit');
    Route::put('account/password-edit', 'update')->name('change-password');
});

# Users
Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/account/edit', 'edit')->name('users.edit');
    Route::put('/account/edit', 'update')->name('users.update');
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show')->withoutMiddleware('auth');
});
