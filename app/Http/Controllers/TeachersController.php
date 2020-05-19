<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Teachers;

class TeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        return view('dash.teacher.create', [
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
            'empno' => 'required|regex:/^[0-9]+$/u',
            'cabinno' => 'required',
            'phone' => 'required|regex:/^[0-9]+$/u'
        ]);

        if($v->fails()) {
            $err = "";

            foreach($v->errors()->all() as $e) {
                $err .= $e;
            }

            return redirect()->route('dashboard.teacher.create', [
                'err' => $err
            ]);
        }

        if($request->password != $request->cpassword) {
            return redirect()->route('dashboard.teacher.create', [
                'err' => "Passwords do not match."
            ]);
        }

        $u = User::create([
            'uuid' => Str::uuid(),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'teacher'
        ]);

        $a = Teachers::create([
            'uuid' => $u->uuid,
            'empno' => $request->empno,
            'cabinno' => $request->cabinno,
            'phone' => $request->phone
        ]);

        return redirect()->route('dashboard.teacher')->with('msg', 'Added successfully');
    }

    public function update($e)
    {
        $t = Teachers::where('empno', $e)->get()->first();

        return view('dash.teacher.update', [
            't' => $t,
            'err' => session()->get('err') ? session()->get('err') : null
        ]);
    }

    public function update_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            'fname' => 'regex:/^[a-zA-Z]+$/u|max:20',
            'lname' => 'regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'email',
            'cabinno' => '',
            'phone' => 'regex:/^[0-9]+$/u'
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

        $a = Teachers::where('empno', $request->emp)->with('user')->get()->first();
        $a->user->fname = $request->fname ?? $a->user->fname;
        $a->user->lname = $request->lname ?? $a->user->lname;
        $a->user->email = $request->email ?? $a->user->email;
        $a->user->password = bcrypt($request->password) ?? $a->user->password;
        $a->user->save();
        $a->empno = $request->empno ?? $a->empno;
        $a->cabinno = $request->cabinno ?? $a->cabinno;
        $a->phone = $request->phone ?? $a->phone;
        $a->save();

        return redirect()->route('dashboard.teacher')->with('msg', 'Updated successfully');
    }
    
    public function delete($e)
    {
        $a = Teachers::where('empno', $e)->with('user')->get()->first();

        $u = $a->user;
        $a->delete();
        $u->delete();

        return back()->with('msg', 'Deleted successfully.');
    }
}
