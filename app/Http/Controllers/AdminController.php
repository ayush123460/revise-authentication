<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Admin;

class AdminController extends Controller
{
    public function create(Request $request)
    {
        return view('dash.admin.create', [
            'err' => $request->err ?? null
        ]);
    }

    public function create_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            'fname' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'lname' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'required|email:rfc|unique:users,email',
            'password' => 'required',
            'cpassword' => 'required',
            'empno' => 'required|regex:/^[0-9]+$/u'
        ]);

        if($v->fails()) {
            return redirect()->route('dashboard.admin.create', [
                'err' => $v->errors()->all()
            ]);
        }

        if($request->password != $request->cpassword) {
            return redirect()->route('dashboard.admin.create', [
                'err' => "Passwords do not match."
            ]);
        }

        $u = User::create([
            'uuid' => Str::uuid(),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin'
        ]);

        $a = Admin::create([
            'uuid' => $u->uuid,
            'empno' => $request->empno
        ]);

        return redirect()->route('dashboard.admin');
    }

    public function update($e)
    {
        $a = Admin::where('empno', $e)->get()->first();

        if(auth()->user()->uuid == $a->uuid) {
            return redirect()->route('dashboard.profile');
        }

        return view('dash.admin.update', [
            'a' => $a,
            'err' => session()->get('err') ? session()->get('err') : null
        ]);
    }

    public function update_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            'fname' => 'regex:/^[a-zA-Z]+$/u|max:20',
            'lname' => 'regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'email'
        ]);

        if($v->fails()) {
            $err = "";

            if($v->errors()->get('fname') || $v->errors()->get('lname')) {
                $err .= "Please enter only alphabets for the name.";
            } 
            
            if($v->errors()->get('email')) {
                $err .= "Email invalid or already in use.";
            }

            return back()->with('err', $err);
        }

        if($request->password) {
            if($request->password != $request->cpassword) {
                return redirect()->route('dashboard.admin.update', $request->route('e'), [
                    'err' => 'Passwords do not match.'
                ]);
            }
        }

        $a = Admin::where('empno', $request->emp)->with('user')->get()->first();
        $a->user->fname = $request->fname ?? $a->user->fname;
        $a->user->lname = $request->lname ?? $a->user->lname;
        $a->user->email = $request->email ?? $a->user->email;
        $a->user->password = bcrypt($request->password) ?? $a->user->password;
        $a->user->save();
        $a->empno = $request->empno;
        $a->save();

        return redirect()->route('dashboard.admin');
    }
    
    public function delete($e)
    {
        $a = Admin::where('empno', $e)->with('user')->get()->first();

        if(auth()->user()->uuid == $a->uuid) {
            return back()->with('err', 'You cannot delete yourself.');
        }

        $u = $a->user;
        $a->delete();
        $u->delete();

        return back()->with('msg', 'Deleted successfully.');
    }
}
