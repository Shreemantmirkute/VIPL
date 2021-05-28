<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Illuminate\Notifications\Notification;
use App\Notifications\TaskCompleted;

class SubuserController extends Controller
{
    public function add_user()
    {        
    	$subusers = DB::table('users')->where('parent', Auth::user()->id)->get();
    	$users = DB::table('users')->where('id', Auth::user()->id)->get();
        return view('pages/add_user', ['subusers'=>$subusers, 'users'=>$users]);
    }

    public function subuserstore(Request $request)
    {        
        $subuser = new User;
        $subuser->name = $request->input('name');
        $subuser->email = $request->input('email');
        $subuser->parent = $request->input('parent');
        $subuser->password = Hash::make($request->input('password')); 
        $subuser->role = $request->input('role');
        $subuser->subusercount = 'NA';
        $subuser->save();

        User::where('id', Auth::user()->id)->increment('subusercount');

        $notification = 'New Subuser:'.$request->input('name').' Added';
        User::find(Auth::user()->id)->notify(new TaskCompleted($notification));
        User::find(1)->notify(new TaskCompleted($notification));

    	return redirect('/add_user')->with('success','User created successfully');
    }
}
