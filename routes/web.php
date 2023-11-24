<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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
Route::get('articles', [ArticleController::class, 'index'])->name('articles');
Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.delete');

# Users
Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('/users/create', fn () => 'Create New User');
Route::post('/users', fn () => 'Store user into db');
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('users/{user}/edit', fn ($user) => "Edit User {$user}");
Route::put('users/{user}', fn ($user) => "Update user {$user}");
Route::delete('/users/{user}', fn ($user) => "Delete user {$user}");

