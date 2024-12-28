<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'PostController@index')->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post', function () {
    return view('user.post.index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    //User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        route::get('', 'UserController@index')->name('index');
    });
    //Category
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        route::get('', Category::class)->name('index');
        route::post('', 'CategoryController@store')->name('store');
        route::delete('{uuid}', 'CategoryController@delete')->name('delete');
    });

    //Tag
    Route::group(['prefix' => 'tag', 'as' => 'tag.'], function () {
        route::get('', Tag::class)->name('index');
        route::post('', 'TagController@store')->name('store');
        route::delete('{uuid}', 'TagController@delete')->name('delete');
    });

    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        route::get('', 'PostController@index')->name('index');
        route::get('create', 'PostController@create')->name('create');
        route::post('', 'PostController@store')->name('store');
        route::post('{uuid}/approve', 'PostController@approve')->name('approve');
        route::get('{uuid}/edit', 'PostController@edit')->name('edit');
        route::put('{uuid}', 'PostController@update')->name('update');
        route::delete('{uuid}', 'PostController@delete')->name('delete');
    });

    Route::group(['prefix' => 'json', 'as' => 'json.'], function () {
        route::get('/category', 'JsonController@getCategory')->name('category');
        route::get('/tag', 'JsonController@getTag')->name('tag');
        route::get('/post/update', 'JsonController@updatePost')->name('update-post');
    });
});

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    route::get('', 'PostController@index')->name('index');
    route::get('create', 'PostController@create')->name('create');
    route::post('', 'PostController@store')->name('store');
    route::get('/{slug}', 'PostController@detail')->name('detail');
    route::get('setCookie', 'PostController@setCookie');
    route::get('getCookie', 'PostController@getCookie');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    route::get('', 'UserController@profile')->name('profile');
    route::put('{id}', 'UserController@store')->name('update');
});

Route::group(['prefix' => 'resource', 'as' => 'resource.'], function () {
    route::post('{uuid}/comment', 'ResourceController@comment')->name('comment');
});
