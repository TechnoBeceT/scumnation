<?php

use App\Models\Trading\Item;
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
        Route::get('login', 'Auth\SteamLoginController@login')->name('login');
        Route::get('steam', 'Auth\SteamLoginController@authenticate')->name('auth');
        Route::get('isLoggedIn', 'Auth\SteamLoginController@isLoggedIn');
        Route::post('logout', 'Auth\SteamLoginController@logout');
        Route::get('postman', 'Auth\SteamLoginController@loginForPostman'); //For Test Purposes
    });

    /*
    |--------------------------------------------------------------------------
    | Not Authenticated Routes
    |--------------------------------------------------------------------------
    */

    Route::resource('ranks', 'RankController', ['only' => 'index']);
    Route::resource('killFeed', 'KillFeedController', ['only' => 'index']);

    /*
    |--------------------------------------------------------------------------
    | Authenticated Routes
    |--------------------------------------------------------------------------
    */
    
    Route::group(['middleware' => ['auth:api']], function () {
        Route::resource('kills', 'KillController', ['only' => 'index']);
        Route::resource('history', 'HistoryController', ['only' => 'index']);
        Route::resource('users', 'UserController', ['only' => 'show']);
        Route::resource('users.bounty', 'BountyController', ['only' => ['index', 'store']]);
        Route::resource('user/card', 'Finance\CardController', ['only' => ['store', 'destroy']]);
        Route::resource('user/tokens', 'Finance\PurchaseTokenController', ['only' => 'store']);
        Route::resource('user/subscription', 'Finance\SubscriptionController', ['only' => ['store', 'destroy']]);
        Route::resource('user/getpackage', 'Finance\SubscriptionDeployController', ['only' => 'index']);
        Route::resource('user/inventory', 'InventoryController', ['only' => 'index']);
        Route::resource('marketplace', 'MarketplaceController', ['only' => ['index', 'store']]);
    });
});
