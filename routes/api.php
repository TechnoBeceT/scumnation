<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([ 'middleware' => 'api'], function ($router) {
        /*
    |--------------------------------------------------------------------------
    | Logger Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'logger'], function () {
        Route::post('login', 'LogController@fetchLoginLogs');
        Route::post('kill', 'LogController@fetchKillLogs');
        Route::post('admin', 'LogController@fetchAdminLogs');
    });

    /*
    |--------------------------------------------------------------------------
    | Auth Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'auth'], function ($router) {
        Route::get('login', 'Auth\SteamLoginController@login')->name('login.steam');
        Route::get('steam', 'Auth\SteamLoginController@authenticate')->name('auth.steam');
        Route::get('isLoggedIn', 'Auth\SteamLoginController@isLoggedIn');
        Route::post('logout', 'Auth\SteamLoginController@logout');
        Route::get('postman', 'Auth\SteamLoginController@loginForPostman'); //For Test Purposes
    });

    /*
    |--------------------------------------------------------------------------
    | Not Authenticated Routes
    |--------------------------------------------------------------------------
    */
    

    /*
    |--------------------------------------------------------------------------
    | Authenticated Routes
    |--------------------------------------------------------------------------
    */
    
    Route::group(['middleware' => ['auth:api']], function () {
        
    });
});
