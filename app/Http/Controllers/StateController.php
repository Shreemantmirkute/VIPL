<?php

namespace App\Http\Controllers;
use App\State;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Notifications\Notification;
use App\User;
use App\Notifications\TaskCompleted;

class StateController extends Controller
{
    public function create_state (Request $request)
    {
    	
    	State::create($request->all());
        $notification = 'New State:'.$request->input('name').' Added';
        User::find(1)->notify(new TaskCompleted($notification));
    	return redirect()->back()->with('success','State created successfully');
    }
    public function view_state (Request $request)
    {
    	$states = DB::table('states')->get();
    	$countries = DB::table('countries')->get();
    	return view('/admin/state',['states'=>$states,'countries'=>$countries]);
    }
    public function delete_state (Request $request)
    {
        /*$catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){*/
        DB::table('states')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','State deleted successfully');
       /* }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }*/
    }
    public function allstate(Request $request)
    {
        $name = $_GET['cid'];
        $mydata = DB::table('states')->where('country_name', $name)->get();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }
}
