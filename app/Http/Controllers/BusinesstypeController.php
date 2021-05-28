<?php

namespace App\Http\Controllers;
use App\Businesstype;
use App\Currency;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class BusinesstypeController extends Controller
{
    public function create_businesstype (Request $request)
    {
        // dd($request->all());

    	foreach($request->input('default_currency') as $default_currency)
        {
            $data[] = $default_currency;  
        }
        foreach($request->input('registered_as') as $registered_as)
        {
            $data1[] = $registered_as;  
        }
        if ($request->work_details == null ) {
            $worked_as = null;
            $data2 = $worked_as;
        }
        else{

            foreach($request->input('work_details') as $worked_as)
        {
            $data2[] = $worked_as;   
        }

        }
        

    	$Upload_mode = new Businesstype;
        $Upload_mode->default_currency = json_encode($data);
        $Upload_mode->name = $request->input('name');
        $Upload_mode->registered_as = json_encode($data1);
        $Upload_mode->work_details = json_encode($data2);
        $Upload_mode->save();
    	
    	return redirect()->back()->with('success','Business type created successfully');
    }
    public function view_businesstype (Request $request)
    {
    	$businesstypes = DB::table('businesstypes')->get();
        // dd($businesstypes);
    	$currencies = DB::table('currencies')->get();
        // dd($currencies);
    	return view('/admin/businesstype',['businesstypes'=>$businesstypes,'currencies'=>$currencies]);
    }
    public function delete_businesstype (Request $request)
    {
        /*$catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){*/
        DB::table('businesstypes')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','Business type deleted successfully');
       /* }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }*/
    }
    public function allbusinesstype(Request $request)
    {
        $name = $_GET['cid'];
        $mydata = DB::table('businesstypes')->where('name', $name)->get();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }
     public function allbusinesstypelist()
    {
        $mydata = DB::table('businesstypes')->where('name', '!=', 'MtalandgfghjMinerals')->get();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }

    public function edit_businesstype($businesstype){
        // dd($businesstype);

        $businesstypeedit = Businesstype::find($businesstype);

        $string_version = explode(',', $businesstypeedit->registered_as);
        $string_version1 = explode(',', $businesstypeedit->work_details);
        $string_version2 = explode(',', $businesstypeedit->default_currency);
        // dd($string_version2);

        $registered_data =   str_replace (array('[', ']'), '' , $string_version);
        // dd($registered_data);
        $worked_data =   str_replace (array('[', ']'), '' , $string_version1);
        $currency_data =   str_replace (array('[', ']'), '' , $string_version2);
        $currencies = DB::table('currencies')->get();

        return view('admin.businesstype_edit',compact('currencies','businesstypeedit','registered_data','worked_data','businesstype','currency_data'));

    }

    public function updateBusinesstype(Request $request,$business_id){

        // dd($request->all());
        // dd($business_id);

        // dd($businessUpdate);

        foreach($request->input('default_currency') as $default_currency)
        {
            $data[] = $default_currency;  
        }
        foreach($request->input('registered_as') as $registered_as)
        {
            $data1[] = $registered_as;  
        }
        if ($request->work_details == null ) {
            $worked_as = null;
            $data2 = $worked_as;
        }
        else{

            foreach($request->input('work_details') as $worked_as)
        {
            $data2[] = $worked_as;   
        }

        }        

        $businessUpdate = Businesstype::find($business_id);
        $businessUpdate->default_currency = json_encode($data);
        $businessUpdate->name = $request->input('name');
        $businessUpdate->registered_as = json_encode($data1);
        $businessUpdate->work_details = json_encode($data2);
        $businessUpdate->save();
        
        return redirect('/admin/businesstype')->with('success','Business type updated successfully');

    }
}
