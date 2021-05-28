<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use DB;
use Notification;
use App\User;
use App\Notifications\TaskCompleted;

class CategoryController extends Controller
{
    public function create_category (Request $request)
    {
    	$validateData = $request->validate([

    	]);
    	Category::create($request->all());
        $notification = 'New Category Added:'.$request->input('name');
        $users = User::where('id','>',1)->get();
        Notification::send($users, new TaskCompleted($notification));
    	return redirect('/admin/category')->with('success','Category created successfully');
    }

    public function delete_category (Request $request)
    {
        $catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){
    	DB::table('categories')->where('id', $request->id)->delete();
        return redirect('/admin/category')->with('successdeleted','Category deleted successfully');
        }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }
    }
}
