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

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
// When visiting /p it checks the ProfilesController, and finds the 'create' method, which then points to the views/posts/create

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
// 'index' is simply the name of the method
// 'profile.show' is referring to the restful resource controllers (.index / .create / .edit / etc) 'show' is 'read' (from bread/crud)

