<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Admin;
use App\Teachers;
use App\Students;

class DashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $u = User::get()->count();
        $a = Admin::get()->count();
        $t = Teachers::get()->count();
        $s = Students::get()->count();

        return view('dash.home', [
            'u' => $u,
            'a' => $a,
            't' => $t,
            's' => $s
        ]);
    }

    public function admin()
    {
        $a = Admin::with('user')->get();

        return view('dash.admin', [
            'a' => $a,
            'err' => session()->get('err') ?? null,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function teacher()
    {
        $t = Teachers::with('user')->get();

        return view('dash.teacher', [
            't' => $t,
            'err' => session()->get('err') ?? null,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function profile(Request $request)
    {
        $u = auth()->user();

        $d = null;

        if($u->role == "admin") {
            $d = Admin::where('uuid', $u->uuid)->get()->first();
        } else if($u->role == "teacher") {
            $d = Teachers::where('uuid', $u->uuid)->get()->first();
        } else if($u->role == "student") {
            $d = Students::where('uuid', $u->uuid)->get()->first();
        }

        return view('dash.profile', [
            'u' => $u,
            'd' => $d,
            'err' => ($request->err != null) ? $request->err : null,
            'msg' => ($request->msg != null) ? $request->msg : null
        ]);
    }

    public function update_profile(Request $request)
    {
        $v = Validator::make($request->all(), [
            'fname' => 'regex:/^[a-zA-Z]+$/u|max:20',
            'lname' => 'regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'email'
        ]);

        if($v->fails()) {
            $err = "";

            if($v->errors()->get('fname') || $v->errors()->get('lname')) {
                $err .= "Please enter only alphabets for your name.";
            } 
            
            if($v->errors()->get('email')) {
                $err .= "Please enter a valid email address.";
            }

            return redirect()->route('dashboard.profile', [
                'err' => $err
            ]);
        }

        if($request->password) {
            if($request->password != $request->cpassword) {
                return redirect()->route('dashboard.profile', [
                    'err' => 'Passwords do not match.'
                ]);
            }
        }

        $u = User::where('uuid', auth()->user()->uuid)->get()->first();

        $u->fname = ($request->fname) ? $request->fname : $u->fname;
        $u->lname = ($request->lname) ? $request->lname : $u->lname;
        $u->email = ($request->email) ? $request->email : $u->email;
        $u->password = ($request->password) ? bcrypt($request->password) : $u->password;
        $u->save();

        if(auth()->user()->role == 'admin') {
            if($request->empno) {
                $a = Admin::where('uuid', auth()->user()->uuid)->get()->first();
                $a->empno = $request->empno;
                $a->save();
            }
        }

        return redirect()->route('dashboard.profile', [
            'msg' => 'Profile updated successfully.'
        ]);
    }
}