<?php

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

Route::get('/{any}', 'IndexController@index')->where('any', '.*');
Route::post( 'auth', 'LoginController@auth' );
Route::post( 'register', 'RegisterController@register' );
Route::post( 'login', 'LoginController@login' );
Route::post( 'logout', 'LogoutController@logout' );
Route::group(
    [
        'prefix' => ''
    ], function(){
        Route::post( 'getlist', 'HomeController@getlist' );
        Route::post( 'push', 'HomeController@push' );
        Route::post( 'clear', 'HomeController@clear' );
    }
);
Route::group(
    [
        'prefix' => 'detail'
    ], function(){
        Route::post( '{key}/getlist', 'DetailController@getlist' );
        Route::post( '{key}/push', 'DetailController@push' );
        Route::post( '{key}/clear', 'DetailController@clear' );

    }
);