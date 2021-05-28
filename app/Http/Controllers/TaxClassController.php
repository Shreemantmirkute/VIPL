<?php

namespace App\Http\Controllers;
use App\TaxClass;
use DB;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use App\User;
use App\Notifications\TaskCompleted;

class TaxClassController extends Controller
{
    public function create_taxclass (Request $request)
    {

    	$Upload_mode = new TaxClass;
        $Upload_mode->name = $request->input('name');
        $Upload_mode->status = $request->input('status');
        $Upload_mode->save();

        $notification = 'New Taxclass Created:'.$request->input('name');
        User::find(1)->notify(new TaskCompleted($notification));
    	
    	return redirect()->back()->with('success','Tax Class created successfully');
    }
    public function view_taxclass (Request $request)
    {
    	$tax_classes = DB::table('tax_classes')->get();
    	return view('/admin/taxclass',['tax_classes'=>$tax_classes]);
    }
    public function delete_taxclass (Request $request)
    {
        DB::table('tax_classes')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','Taxclass deleted successfully');
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
