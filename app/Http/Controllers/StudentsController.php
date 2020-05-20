<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Students;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        return view('dash.student.create', [
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
            'regno' => 'required'
        ]);

        if($v->fails()) {
            $err = "";

            foreach($v->errors()->all() as $e) {
                $err .= $e;
            }

            return redirect()->route('dashboard.student.create', [
                'err' => $err
            ]);
        }

        if($request->password != $request->cpassword) {
            return redirect()->route('dashboard.student.create', [
                'err' => "Passwords do not match."
            ]);
        }

        $u = User::create([
            'uuid' => Str::uuid(),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student'
        ]);

        $a = Students::create([
            'uuid' => $u->uuid,
            'regno' => $request->regno,
        ]);

        return redirect()->route('dashboard.student')->with('msg', 'Added successfully');
    }

    public function update($r)
    {
        $s = Students::where('regno', $r)->get()->first();

        return view('dash.student.update', [
            't' => $s,
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
                return back()->with('err', 'Passwords do not match');
            }
        }

        $a = Students::where('regno', $request->reg)->with('user')->get()->first();
        $a->user->fname = $request->fname ?? $a->user->fname;
        $a->user->lname = $request->lname ?? $a->user->lname;
        $a->user->email = $request->email ?? $a->user->email;
        $a->user->password = bcrypt($request->password) ?? $a->user->password;
        $a->user->save();
        $a->regno = $request->regno ?? $a->regno;
        $a->save();

        return redirect()->route('dashboard.student')->with('msg', 'Updated successfully');
    }
    
    public function delete($r)
    {
        $a = Students::where('regno', $r)->with('user')->get()->first();

        $u = $a->user;
        $a->delete();
        $u->delete();

        return back()->with('msg', 'Deleted successfully.');
    }
}
