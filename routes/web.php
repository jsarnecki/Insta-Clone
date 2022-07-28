<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
// When visiting /p it checks the ProfilesController, and finds the 'create' method, which then points to the views/posts/create
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
// 'index' is simply the name of the method
// 'profile.show' is referring to the restful resource controllers (.index / .create / .edit / etc) 'show' is 'read' (from bread/crud)

