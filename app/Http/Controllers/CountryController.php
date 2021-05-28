<?php

namespace App\Http\Controllers;
use App\Country;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class CountryController extends Controller
{
    public function create_country (Request $request)
    {
    	
    	Country::create($request->all());
    	return redirect()->back()->with('success','Country created successfully');
    }
    public function view_country (Request $request)
    {
    	$countries = DB::table('countries')->get();
    	return view('/admin/country',['countries'=>$countries]);
    }
    public function delete_country (Request $request)
    {
        /*$catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){*/
        DB::table('countries')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','Country deleted successfully');
       /* }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }*/
    }
    public function allcountry()
    {
        $mydata = DB::table('countries')->get();
        return Response::json($mydata);
    }
}
