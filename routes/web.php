<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
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

Route::controller(ArticleController::class)->middleware('can.write.article')->group(function () {
    Route::get('articles/table', 'table')->name('articles.table');
    Route::put('articles/{article}/update-status', 'updateStatus')->name('articles.update-status');
});
# Articles
Route::resource('articles', ArticleController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::controller(CommentController::class)->group(function () {
    Route::post('comments/{article}', 'store')->name('comments.store');
    Route::delete('comments/{comment}', 'destroy')->name('comments.delete');
});

require __DIR__.'/auth.php';

# Change Password
Route::controller(ChangePasswordController::class)->middleware('auth')->group(function () {
    Route::get('account/password-edit', 'edit')->name('change-password.edit');
    Route::put('account/password-edit', 'update')->name('change-password');
});

# Roles
Route::controller(RoleController::class)->middleware('only.admin')->group(function () {
    Route::post('roles/assign/{user}', 'assign')->name('roles.assign');
});

# Users
Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users');
    Route::get('/account/edit', 'edit')->name('users.edit');
    Route::put('/account/edit', 'update')->name('users.update');
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
});
