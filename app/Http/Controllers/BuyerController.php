<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Profile;
use App\Item;
use DB;
use Auth;
use App\Mail\PasswordChangeMail;
use Illuminate\Support\Facades\Mail;
use App\Buyer;
use App\Seller;
use Illuminate\Support\Facades\Response;
use Image;

class BuyerController extends Controller
{
    public function enquiryview (Request $request)
    {
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
        $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();
        $cities = DB::table('cities')->get();
        $states = DB::table('cities')->distinct('city_state')->get();
        return view('pages/enquiry', ['useritems'=>$useritems , 'buyers'=>$buyers, 'cities'=>$cities, 'states'=>$states]);
    }

    public function enquirylistview (Request $request)
    {
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
        $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();
        $cities = DB::table('cities')->get();
        $items = DB::table('items')->get();
        $states = DB::table('cities')->distinct('city_state')->get();
        return view('pages/enquiry_list', ['useritems'=>$useritems , 'buyers'=>$buyers, 'cities'=>$cities, 'items'=>$items, 'states'=>$states]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
                'product_image' => 'required',
                'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);
        
        if($request->hasfile('product_image'))
        {
            foreach($request->file('product_image') as $image)
            {
                $name=time().'_'.$image->getClientOriginalName();
                $image->move(public_path().'/imageupload/enquiry', $name);  // your folder path
                $data[] = $name;  
            }
        }        
        $Upload_model = new Buyer;
        $Upload_model->product_image = json_encode($data);
        $Upload_model->product = $request->input('product');
        $Upload_model->product_name = DB::table('items')->where('id', $Upload_model->product)->pluck('product')->first();
        $Upload_model->created_by = $request->input('created_by');
        // $Upload_model->origin = $request->input('origin');
        $Upload_model->state = $request->input('state');
        $Upload_model->price = $request->input('price');
        $Upload_model->currency = $request->input('currency');
        $Upload_model->unit = $request->input('unit');
        $Upload_model->minimum_order_quantity = $request->input('minimum_order_quantity');
        $Upload_model->minimum_order_unit = $request->input('minimum_order_unit');
        $Upload_model->perunit = $request->input('perunit');
        $Upload_model->quantity = $request->input('quantity');
        $Upload_model->chemical_specification = $request->input('chemical_specification');
        $Upload_model->physical_specification = $request->input('physical_specification');
        $Upload_model->tandc = $request->input('tandc');
        $Upload_model->otandc = $request->input('otandc');
        $Upload_model->save();
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
        $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();

        $cities = DB::table('cities')->get();
        $states = DB::table('cities')->distinct('city_state')->get();
        //return view('pages/enquiry', ['useritems'=>$useritems , 'buyers'=>$buyers, 'cities'=>$cities, 'states'=>$states]);
        return redirect('/enquiry-view')->with('success', 'Enquiry Added Successfully');
    }

    public function delete_buyer (Request $request)
    {
        DB::table('buyers')->where('id', $request->id)->delete();
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->get();
        $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();
        return redirect('/enquiry-view')->with('successdeleted','Enquiry Deleted Successfully');
    }

    public function update (Request $request)
    {
        $useller = Buyer::where('id', $request->input('id'))->first();
        $useller->price = $request->input('price');
        $useller->quantity = $request->input('quantity');
        $useller->origin = $request->input('origin');
        $useller->currency = $request->input('currency');
        $useller->unit = $request->input('unit');
        $useller->perunit = $request->input('perunit');
        $useller->tandc = $request->input('tandc');
        $useller->otandc = $request->input('otandc');
        $useller->chemical_specification = $request->input('chemical_specification');
        $useller->physical_specification = $request->input('physical_specification');
        $useller->save();
        return redirect('/enquiry-view')->with('success','Enquiry updated successfully');
    }

    public function activate_enquiry(Request $request)
    {
        DB::table('buyers')->where('id', $request->id)->update(['status' => 'Active']);
        return redirect()->back()->with('success','Enquiry activated successfully');
    }

    public function deactivate_enquiry(Request $request)
    {
        DB::table('buyers')->where('id', $request->id)->update(['status' => 'Deactive']);
        return redirect()->back()->with('success','Enquiry deactivated successfully');
    }

    public function buyerbidacceptance(Request $request)
    {
        $buyers = DB::table('buyers')->where('id', $request->id)->get();   
        return view('pages/buyerbidacceptance', ['buyers'=>$buyers]);
    }

    public function ajax(Request $request)
    {
        $name = $_GET['cid'];
        $cities = DB::table('cities')->where('city_state', $name)->get()->pluck('city_name');
        return Response::json($cities);
    }
}
