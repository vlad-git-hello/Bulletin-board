<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::group([
        'namespace' => '\App\Http\Controllers\Auth',
    ], function () {
        Route::get('/verify/{token}', 'VerificationController@verify')->name('verify');
        Route::get('/resend', 'VerificationController@show')->name('verification.show');
        Route::post('/verify/resend', 'VerificationController@resend')->name('verification.resend');
        Route::get('/register/confirm', 'RegisterController@confirmRegistration')
            ->name('registration.confirm');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
        'namespace' => '\App\Http\Controllers\Category',
    ], function () {
        Route::resource('/category', 'CategoryController');

        Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
            Route::post('/up', 'TransformController@up')->name('up');
            Route::post('/down', 'TransformController@down')->name('down');
            Route::post('/first', 'TransformController@first')->name('first');
            Route::post('/last', 'TransformController@last')->name('last');
        });
    });


Route::group(['namespace' => '\App\Http\Controllers\Advert'], function () {
    Route::resource('/advert', 'AdvertController');
});

Route::group(['namespace' => '\App\Http\Controllers\Image'], function () {
    Route::post('dropzone/store', 'ImageController@store')->name('store');
    Route::delete('dropzone/destroy/{path}/{imageName}', 'ImageController@destroy')->name('destroy');
});

Route::group(['namespace' => '\App\Http\Controllers\UserProfile',], function () {
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

    Route::resource('/user/advert', 'AdvertController')->names('profile.advert');
});
