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

Route::get('/', [
    'uses' => 'PagesController@index',
    'as' => 'home'
]);

Route::post('/login', [
    'uses' => 'LoginController@login',
    'as' => 'login.post'
]);

Route::get('/logout', [
    'uses' => 'LoginController@logout',
    'as' => 'logout'
])->middleware('auth');

Route::view('/login', 'main')->name('login');

Route::prefix('/dashboard')->group(function() {
    Route::get('', [
        'uses' => 'DashController@index',
        'as' => 'dashboard.home'
    ]);

    Route::get('admin', [
        'uses' => 'DashController@index',
        'as' => 'dashboard.admin'
    ]);

    Route::get('profile', [
        'uses' => 'DashController@profile',
        'as' => 'dashboard.profile'
    ]);

    Route::post('profile', [
        'uses' => 'DashController@update_profile',
        'as' => 'dashboard.profile.update'
    ]);
});