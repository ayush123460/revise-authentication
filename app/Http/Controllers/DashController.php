<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
