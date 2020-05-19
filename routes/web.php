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

    Route::prefix('admin')->group(function() {
        Route::get('/', [
            'uses' => 'DashController@admin',
            'as' => 'dashboard.admin'
        ]);
    
        Route::get('create', [
            'uses' => 'AdminController@create',
            'as' => 'dashboard.admin.create'
        ]);

        Route::post('create', [
            'uses' => 'AdminController@create_post',
            'as' => 'dashboard.admin.create'
        ]);
    
        Route::get('update/{e}', [
            'uses' => 'AdminController@update',
            'as' => 'dashboard.admin.update'
        ]);

        Route::post('update/{e}', [
            'uses' => 'AdminController@update_post',
            'as' => 'dashboard.admin.update'
        ]);
    
        Route::get('delete/{e}', [
            'uses' => 'AdminController@delete',
            'as' => 'dashboard.admin.delete'
        ]);
    });

    Route::get('profile', [
        'uses' => 'DashController@profile',
        'as' => 'dashboard.profile'
    ]);

    Route::post('profile', [
        'uses' => 'DashController@update_profile',
        'as' => 'dashboard.profile.update'
    ]);
});