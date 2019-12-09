<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Tags
 */
Route::resource('tags', 'TagController', ['except' => ['create', 'edit']]);
Route::resource('posts', 'PostController', ['only' => ['index', 'show']]);
Route::resource('users.posts', 'UserPostController', ['except' => ['create', 'show', 'edit']]);
Route::resource('tags.users', 'TagUserController', ['only' => ['index']]);
Route::resource('users.tags', 'UserTagController', ['only' => ['index']]);
Route::resource('tags.posts', 'TagPostController', ['only' => ['index']]);
Route::resource('posts.tags', 'PostTagController', ['only' => ['index', 'update', 'destroy']]);