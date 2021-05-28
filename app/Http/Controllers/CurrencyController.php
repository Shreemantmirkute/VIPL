<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use DB;

class CurrencyController extends Controller
{
    public function create_currency (Request $request)
    {
    	
    	Currency::create($request->all());
    	return redirect()->back()->with('success','Currency created successfully');
    }
    public function view_currency (Request $request)
    {
    	$currencies = DB::table('currencies')->get();
    	return view('/admin/currency',['currencies'=>$currencies]);
    }
    public function delete_currency (Request $request)
    {
        /*$catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){*/
        DB::table('currencies')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','Currency deleted successfully');
       /* }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }*/
    }
    public function update_currency (Request $request)
    {
        $currency = Currency::where('id', $request->input('id'))->first();
        $currency->name = $request->input('name');
        $currency->code = $request->input('code');
        $currency->symbol = $request->input('symbol');
        $currency->save();
        return redirect()->back()->with('success1','Currency updated successfully');
    }
}
