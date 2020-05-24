<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Admin;
use App\Teachers;
use App\Students;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $id = auth()->user()->uuid;
    $role = auth()->user()->role;

    switch($role) {
        case 'admin':
            $u = Admin::where('uuid', $id)->first()->get();
        break;
        case 'teacher':
            $u = Teachers::where('uuid', $id)->first()->get();
        break;
        case 'student':
            $u = Student::where('uuid', $id)->first()->get();
        break;
    }

    return response()->json([
        'user' => auth()->user(),
        'details' => $u
    ]);
});

Route::middleware('auth:api')->get('logout', function (Request $request) {
    auth()->user()->token()->revoke();

    return response();
});