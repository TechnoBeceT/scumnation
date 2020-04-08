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

Route::get('auth/login', 'Auth\SteamLoginController@login')->name('login.steam');
Route::get('auth/steam', 'Auth\SteamLoginController@authenticate')->name('auth.steam');
Route::get('auth/isLoggedIn', 'Auth\SteamLoginController@isLoggedIn');
Route::post('auth/logout', 'Auth\SteamLoginController@logout');
Route::get('auth/postman', 'Auth\SteamLoginController@loginForPostman'); //For Test Purposes
