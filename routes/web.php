<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post', function () {
    return view('user.post.index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    //Category
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        route::get('', Category::class)->name('index');
        route::post('', 'CategoryController@store')->name('store');
    });

    //Tag
    Route::group(['prefix' => 'tag', 'as' => 'tag.'], function () {
        route::get('', Tag::class)->name('index');
        route::post('', 'TagController@store')->name('store');
    });

    route::resource('post', 'PostController');
});
