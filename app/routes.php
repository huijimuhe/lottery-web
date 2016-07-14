  
<?php

/* * ************************
 *  HOME ROUTE
 * ************************ */
Route::get('test', ['as' => 'test', 'uses' => 'LotteryController@test']);
Route::get('setup', ['as' => 'test', 'uses' => 'HomeController@setup']);
/* * ************************
 *  Route patterns
 * ************************ */

Route::pattern('id', '[0-9a-z]+');

/* * ************************
 *  Auth Route
 * ************************ */
Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@getlogin']);
Route::post('login', 'AuthController@postLogin');
Route::get('logout', [ 'as' => 'logout', 'uses' => 'AuthController@getlogout']);

/* * ************************
 *  Lottery Route 
 * ************************ */
Route::group([ 'prefix' => 'mobile'], function() {
    Route::get('index', ['as' => 'mobile.lottery', 'uses' => 'LotteryController@getIndex']);
    Route::post('scratch', ['as' => 'mobile.scratch', 'uses' => 'LotteryController@postMobileScratch']);
    Route::get('scratch', ['as' => 'mobile.result', 'uses' => 'LotteryController@getMobileScratch']);
    Route::post('egg', ['as' => 'mobile.egg', 'uses' => 'LotteryController@postMobileEgg']);
    Route::get('egg', ['as' => 'mobile.getEgg', 'uses' => 'LotteryController@getMobileEgg']);
});

/* * ************************
 *  Admin Route 
 * ************************ */
Route::group([ 'before' => 'auth'], function() {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashBoard']);
    Route::get('rate', ['as' => 'gifts.rate', 'uses' => 'GiftsController@getTestRate']);

    Route::resource('gifts', 'GiftsController');
    Route::resource('confs', 'ConfsController');
    Route::resource('accounts', 'AccountsController');
    Route::resource('winnerlogs', 'WinnerLogsController');
});
