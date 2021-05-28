<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Unit;
use DB;
use Illuminate\Notifications\Notification;
use App\User;
use App\Notifications\TaskCompleted;

class UnitController extends Controller
{
    public function create_unit (Request $request)
    {
    
    	Unit::create($request->all());
        $notification = 'New Unit Created:'.$request->input('name');
        User::find(1)->notify(new TaskCompleted($notification));
    	return redirect()->back()->with('success','Unit created successfully');
    }
    public function view_unit (Request $request)
    {
    	$units = DB::table('units')->get();
    	return view('/admin/unit',['units'=>$units]);
    }
    public function delete_unit (Request $request)
    {
        /*$catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){*/
        DB::table('units')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','Unit deleted successfully');
       /* }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }*/
    }
    public function allunit()
    {
        $mydata = DB::table('units')->where('name', '!=', 'MtalandgfghjMinerals')->get();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }
}
