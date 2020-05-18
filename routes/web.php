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

Route::view('/login', 'main')->name('login');

Route::get('/dashboard', [
    'uses' => 'DashController@index',
    'as' => 'dashboard'
]);