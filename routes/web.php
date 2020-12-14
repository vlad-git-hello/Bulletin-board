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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
        'namespace' => '\App\Http\Controllers\Category'
    ], function () {
    Route::resource('/category', 'CategoryController');

    Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
        Route::post('/up', 'TransformController@up')->name('up');
        Route::post('/down', 'TransformController@down')->name('down');
        Route::post('/first', 'TransformController@first')->name('first');
        Route::post('/last', 'TransformController@last')->name('last');
    });
});
