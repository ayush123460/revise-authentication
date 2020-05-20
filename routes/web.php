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

    Route::get('profile', [
        'uses' => 'DashController@profile',
        'as' => 'dashboard.profile'
    ]);

    Route::post('profile', [
        'uses' => 'DashController@update_profile',
        'as' => 'dashboard.profile.update'
    ]);

    Route::prefix('admin')->middleware('checkAdmin')->group(function() {
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

    Route::prefix('teacher')->middleware('checkAdmin')->group(function() {
        Route::get('/', [
            'uses' => 'DashController@teacher',
            'as' => 'dashboard.teacher'
        ]);
    
        Route::get('create', [
            'uses' => 'TeachersController@create',
            'as' => 'dashboard.teacher.create'
        ]);

        Route::post('create', [
            'uses' => 'TeachersController@create_post',
            'as' => 'dashboard.teacher.create'
        ]);
    
        Route::get('update/{e}', [
            'uses' => 'TeachersController@update',
            'as' => 'dashboard.teacher.update'
        ]);

        Route::post('update/{e}', [
            'uses' => 'TeachersController@update_post',
            'as' => 'dashboard.teacher.update'
        ]);
    
        Route::get('delete/{e}', [
            'uses' => 'TeachersController@delete',
            'as' => 'dashboard.teacher.delete'
        ]);
    });

    Route::prefix('student')->middleware('checkAdmin')->group(function() {
        Route::get('/', [
            'uses' => 'DashController@student',
            'as' => 'dashboard.student'
        ]);
    
        Route::get('create', [
            'uses' => 'StudentsController@create',
            'as' => 'dashboard.student.create'
        ]);

        Route::post('create', [
            'uses' => 'StudentsController@create_post',
            'as' => 'dashboard.student.create'
        ]);
    
        Route::get('update/{r}', [
            'uses' => 'StudentsController@update',
            'as' => 'dashboard.student.update'
        ]);

        Route::post('update/{r}', [
            'uses' => 'StudentsController@update_post',
            'as' => 'dashboard.student.update'
        ]);
    
        Route::get('delete/{r}', [
            'uses' => 'StudentsController@delete',
            'as' => 'dashboard.student.delete'
        ]);
    });
});