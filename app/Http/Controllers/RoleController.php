<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use DB;

use Illuminate\Notifications\Notification;
use App\User;
use App\Notifications\TaskCompleted;

class RoleController extends Controller
{
    public function create_role (Request $request)
    {
    	$Upload_model = new Role;
    	$Upload_model->name = $request->input('name');
    	$Upload_model->save();
        $notification = 'New Role Created:'.$request->input('name');
        User::find(1)->notify(new TaskCompleted($notification));
    	return redirect()->back()->with('success', 'Role Created Successful');
    }

    public function view_role ()
    {
    	$roles = Role::get();
    	return view('admin/role', ['roles'=>$roles]);
    }

    public function updatedate(Request $request)
    {
        $pid = $request->pid;
        $dt = $request->dt;
        $var = DB::table('sellers')->where('id', $pid)->update(['to_date'=>$dt]);
        return json_encode($var);
    }
}
