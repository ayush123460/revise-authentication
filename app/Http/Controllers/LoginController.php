<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if($v->fails()) {
            return view('main', [
                'e' => $v->errors()
            ]);
        }

        $user = $request->only('email', 'password');

        if(Auth::attempt($user)) {
            return redirect()->intended('/dashboard');
        }

        return view('main', [
            'err' => 'Please verify your credentials.'
        ]);
    }
}
