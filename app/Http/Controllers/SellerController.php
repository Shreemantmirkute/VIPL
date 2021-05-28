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
use App\Seller;
use App\Buyer;
use Illuminate\Support\Facades\Response;
use Image;
use App\Bidaccept;
use App\Product;

use Notification;
use App\User;
use App\Notifications\TaskCompleted;

class SellerController extends Controller
{
    public function offerview (Request $request)
    {
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller')->get();
        $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        $cities = DB::table('cities')->get();
        $items = DB::table('items')->get();
        $states = DB::table('cities')->distinct("city_state")->get();
        return view('pages/offer', ['useritems'=>$useritems , 'sellers'=>$sellers, 'cities'=>$cities, 'states'=>$states, 'items'=>$items]);
    }

    public function offerlistview (Request $request)
    {
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller')->get();
        $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        $cities = DB::table('cities')->get();
        $states = DB::table('cities')->distinct("city_state")->get();
        $items = DB::table('items')->get();
        return view('pages/offer_list', ['useritems'=>$useritems , 'sellers'=>$sellers, 'cities'=>$cities, 'states'=>$states, 'items'=>$items]);
    }

    public function save(Request $request)
    {
        $registered_as = DB::select("select businesstypes.registered_as from users
                        left join profiles
                        on users.id = profiles.user_id
                        left join businesstypes
                        on businesstypes.name = profiles.are_you
                        where users.id=".Auth()->user()->id."
        ");
        $registered_as = $registered_as[0]->registered_as;
        $registered_as = str_replace('"',"",$registered_as);
        $registered_as = str_replace("[","",$registered_as);
        $registered_as = str_replace("]","",$registered_as);
        $registered_as =  explode(",", $registered_as);
        // dd($registered_as);
        if (in_array("Seller", $registered_as)) {

            $this->validate($request, [
                    'product_image' => 'required',
                    'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ]);
            
            if($request->hasfile('product_image'))
            {
                foreach($request->file('product_image') as $image)
                {
                    $name=time().'_'.$image->getClientOriginalName();
                    $image->move(public_path().'/imageupload/offer', $name);  // your folder path
                    $data[] = $name;  
                }
            }       
            $Upload_model = new Seller;
            $Upload_model->product_image = json_encode($data);
            $Upload_model->product = $request->input('product');
            $Upload_model->product_name = DB::table('items')->where('id', $Upload_model->product)->pluck('product')->first();
            $Upload_model->created_by = $request->input('created_by');
            // $Upload_model->origin = $request->input('origin');
            $Upload_model->state = $request->input('state');
            $Upload_model->price = $request->input('price');
            $Upload_model->minimum_order_quantity = $request->input('minimum_order_quantity');
            $Upload_model->quantity = $request->input('quantity');
            $Upload_model->currency = $request->input('currency');
            $Upload_model->unit = $request->input('unit');
            $Upload_model->minimum_order_unit = $request->input('minimum_order_unit');
            $Upload_model->perunit = $request->input('perunit');
            $Upload_model->chemical_specification = $request->input('chemical_specification');
            $Upload_model->physical_specification = $request->input('physical_specification');
            $Upload_model->tandc = $request->input('tandc');
            $Upload_model->otandc = $request->input('otandc');
            $Upload_model->save();
            $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller')->get();
            $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();

            $cities = DB::table('cities')->get();
            $states = DB::table('cities')->distinct("city_state")->get();
            // return view('pages/offer', ['useritems'=>$useritems , 'sellers'=>$sellers, 'cities'=>$cities, 'states'=>$states]);
            $notification = 'New Offer Added For:'.$Upload_model->product_name;
            User::find(1)->notify(new TaskCompleted($notification));
            User::find(Auth::user()->id)->notify(new TaskCompleted($notification));
            return redirect()->back()->with('success','Offer created successfully');
        }
        else if(in_array("Buyer", $registered_as)) {
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
            $Upload_model->from_date = $request->input('from_date');
            $Upload_model->to_date = $request->input('to_date');
            $Upload_model->save();
            $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
            $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();

            $cities = DB::table('cities')->get();
            $states = DB::table('cities')->distinct('city_state')->get();
            $notification = 'New Enquiry Added For:'.$Upload_model->product_name;
            User::find(1)->notify(new TaskCompleted($notification));
            User::find(Auth::user()->id)->notify(new TaskCompleted($notification));
            //return view('pages/enquiry', ['useritems'=>$useritems , 'buyers'=>$buyers, 'cities'=>$cities, 'states'=>$states]);
            return redirect('/enquiry-view')->with('success', 'Enquiry Added Successfully');
        }

    }
    public function update (Request $request)
    {
        $useller = Seller::where('id', $request->input('id'))->first();
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
        return redirect('/offer-view')->with('success','Offer updated successfully');
    }

    public function activate_offer(Request $request)
    {
        DB::table('sellers')->where('id', $request->id)->update(['status' => 'Active']);
        return redirect()->back()->with('success','Offer activated successfully');
    }

    public function statuson(Request $request)
    {
        DB::table('sellers')->where('id', $request->status)->update(['status' => 'Active']);
        return 1;
    }

    public function statusoff(Request $request)
    {
        DB::table('sellers')->where('id', $request->status)->update(['status' => 'Deactive']);
        return 1;
    }

    public function statusonenquiry(Request $request)
    {
        DB::table('buyers')->where('id', $request->status)->update(['status' => 'Active']);
        return 1;
    }

    public function statusoffenquiry(Request $request)
    {
        DB::table('buyers')->where('id', $request->status)->update(['status' => 'Deactive']);
        return 1;
    }

    public function deactivate_offer(Request $request)
    {
        DB::table('sellers')->where('id', $request->id)->update(['status' => 'Deactive']);
        return redirect()->back()->with('success','Offer deactivated successfully');
    }

    public function addEquiryOffer()
    {   

        $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();
        $allsellers = DB::table('sellers')->get();
        $allbuyers = DB::table('buyers')->get();
        $profiles = DB::table('profiles')->where('user_id', Auth::user()->id)->get();
        $businesstypes = DB::table('businesstypes')->get();
        $cities = DB::table('cities')->get();
        $items = DB::table('items')->get();
        $states = DB::table('cities')->get();
        $sellerstate = [];
        $buyerstate = [];
        foreach ($allbuyers as $ab) {
            array_push($buyerstate, json_decode($ab->state));
        }
        foreach ($allsellers as $as) {
            array_push($sellerstate, json_decode($as->state));
        }
        // $sellerstate = array_unique($sellerstate);
        $allstates = DB::table('profiles')->get()->pluck('office_state');
        // $buyerstate = array_unique($buyerstate);
        $taxclass = DB::table('tax_classes')->get();
        $thisuserproducts = DB::table('items')->where('created_by' , Auth::user()->id)->where('status' , 'Approved')->get();
        return view('pages/add_enquiry_offer', ['sellers'=>$sellers,'buyers'=>$buyers, 'cities'=>$cities,'businesstypes'=>$businesstypes,'profiles'=>$profiles, 'states'=>$states, 'items'=>$items, 'taxclass'=>$taxclass, 'thisuserproducts'=>$thisuserproducts, 'sellerstate'=>$sellerstate, 'buyerstate'=>$buyerstate, 'allstate'=>$allstates]);
    }

    public function productsBusinessTypeWise(Request $request) {

        $businesstypes = $request->businesstype;
        if ($businesstypes == "Buyer") {
            $useritems = DB::table('items')->select('product')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
        }
        else if($businesstypes == "Seller"){
            $useritems = DB::table('items')->select('product')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller')->get();
        }

        return json_encode($useritems);
    }

    public function getbusinesstype(Request $request) {

        $businesstypes = $request->thisUserProduct;
        $useritems = DB::table('items')->where('id' , $businesstypes)->pluck('register_as')->first();
        return json_encode($useritems);
    }

    public function saveEnquiryOffer(Request $request) {
       // dd($request->all());
       // exit();
          //$items = DB::table('items')->where('created_by' , Auth::user()->id)->where('id' , $request->product)->get()->pluck('status')->first();
          //dd($items);
         
        //dd($items[0]->status);
       //  if ($items == 'Pending') {
             // return redirect('/add-enquiry-offer')->with('Product not approved by admin');
          //    return redirect()->back()->with('fail','Product not approved by admin');
       //  }
        // else{
       // dd($request->all());exit();
        if ($request->register_as == "Seller") {

            $this->validate($request, [
                    //'product_image' => 'required',
                    'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ]);

            if($request->hasfile('product_image'))
            {
                foreach($request->file('product_image') as $image)
                {
                    $name=time().'_'.$image->getClientOriginalName();
                    $image->move(public_path().'/imageupload/offer', $name);  // your folder path
                    $data[] = $name;  
                }
            }
            else
            {
                $data[] = "";
            }       

            $Upload_model = new Seller;
            $Upload_model->product_image = json_encode($data);
            $Upload_model->product = $request->input('product');
            $Upload_model->product_name = DB::table('items')->where('id', $Upload_model->product)->pluck('product')->first();
            $Upload_model->created_by = $request->input('created_by');
            $Upload_model->origin = $request->input('origin');
            $Upload_model->state = json_encode($request->input('state'));
            $Upload_model->taxclass = $request->input('taxclass');
            $Upload_model->price = $request->input('price');
            $Upload_model->minimum_order_quantity = $request->input('minimum_order_quantity');
            $Upload_model->quantity = $request->input('quantity');
            $Upload_model->from_date = $request->input('from_date');
            $Upload_model->to_date = $request->input('to_date');
            $Upload_model->currency = $request->input('currency');
            $Upload_model->unit = $request->input('unit');
            $Upload_model->minimum_order_unit = $request->input('minimum_order_unit');
            $Upload_model->perunit = $request->input('perunit');
            $Upload_model->chemical_specification = $request->input('chemical_specification');
            $Upload_model->physical_specification = $request->input('physical_specification');
            $Upload_model->tandc = $request->input('tandc');
            $Upload_model->otandc = $request->input('otandc');
            $Upload_model->status = 'Active';
            $Upload_model->save();
            $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller')->get();
            $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
            $created_by_company_name = DB::table('profiles')->where('user_id', $Upload_model->created_by)->get()->pluck('company_name')->first();

            $cities = DB::table('cities')->get();
            $states = DB::table('cities')->distinct("city_state")->get();

            $notification = 'New Offer Added For:'.$Upload_model->product_name.' By '.$created_by_company_name;
            $allbuyers = DB::table('items')->where('product', $Upload_model->product_name)->where('register_as', 'Buyer')->get()->pluck('created_by')->toArray();
            $users = User::whereIn('id',$allbuyers)->get();
            Notification::send($users, new TaskCompleted($notification));
            
           
            // return view('pages/offer', ['useritems'=>$useritems , 'sellers'=>$sellers, 'cities'=>$cities, 'states'=>$states]);
            // return redirect()->back()->with('success','Offer created successfully');
        }
        // dd(in_array("Buyer", $registered_as));
        // dd($registered_as);
    //dd($request->register_as);
    //dd($items[0]->status);
        if($request->register_as == "Buyer") {
            // dd($request->file('product_image'));
            if($request->hasfile('product_image'))
            {
                foreach($request->file('product_image') as $image)
                {
                    $name=time().'_'.$image->getClientOriginalName();
                    $image->move(public_path().'/imageupload/enquiry', $name);  // your folder path
                    $data[] = $name;  
                }

            }
            else
            {
                $data[] = "";
            }
            $Upload_model = new Buyer;
            $Upload_model->product_image = json_encode($data);
            $Upload_model->product = $request->input('product');
            $Upload_model->product_name = DB::table('items')->where('id', $Upload_model->product)->pluck('product')->first();
            $Upload_model->created_by = $request->input('created_by');
            $Upload_model->origin = $request->input('origin');
            $Upload_model->state = json_encode($request->input('state'));
            $Upload_model->taxclass = $request->input('taxclass');
            $Upload_model->price = $request->input('price');
            $Upload_model->currency = $request->input('currency');
            $Upload_model->unit = $request->input('unit');
            $Upload_model->minimum_order_quantity = $request->input('minimum_order_quantity');
            $Upload_model->minimum_order_unit = $request->input('minimum_order_unit');
            $Upload_model->perunit = $request->input('perunit');
            $Upload_model->quantity = $request->input('quantity');
            $Upload_model->from_date = $request->input('from_date');
            $Upload_model->to_date = $request->input('to_date');
            $Upload_model->chemical_specification = $request->input('chemical_specification');
            $Upload_model->physical_specification = $request->input('physical_specification');
            $Upload_model->tandc = $request->input('tandc');
            $Upload_model->otandc = $request->input('otandc');
            $Upload_model->status = 'Active';
            $Upload_model->save();
            $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
            $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();
            $created_by_company_name = DB::table('profiles')->where('user_id', $Upload_model->created_by)->get()->pluck('company_name')->first();

            $cities = DB::table('cities')->get();
            $states = DB::table('cities')->distinct('city_state')->get();

            $notification = 'New Enquiry Added For:'.$Upload_model->product_name.' By '.$created_by_company_name;
            $allbuyers = DB::table('items')->where('product', $Upload_model->product_name)->where('register_as', 'Seller')->get()->pluck('created_by')->toArray();
            $users = User::whereIn('id',$allbuyers)->get();
            Notification::send($users, new TaskCompleted($notification));
            
            $this->SendNotificationPush($notification);
            //return view('pages/enquiry', ['useritems'=>$useritems , 'buyers'=>$buyers, 'cities'=>$cities, 'states'=>$states]);
        }
            return redirect('/add-enquiry-offer')->with('success', 'Enquiry/Offer Added Successfully');
        // }
    }
    
  public function SendNotificationPush($dataone)
    {
        //dd($dataone);
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        //dd($firebaseToken);
          
        $SERVER_API_KEY = 'AAAA_qJYtbg:APA91bF5Yg3u8JqjGojpphEAHHtjuTrDx6suIKGr5-soWdwOn62Vyi8vFeU_zmiml73udNGu7ToodfpdH-XjWmRWnBOYeNUJk8ZSQEtThV6vIoWM9uX_WhJIXMODZt1V5TmiwLKMNTVR';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $dataone,
                //"body" => $datatwo,  
            ]
        ];
       // dd($data);
        
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        //dd($response);
    }


    public function enquiryOfferView()
    {   
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller','Buyer')->get();

        $productname1 = DB::table('items')->where('created_by', Auth::user()->id)->where('register_as', 'Buyer')->get()->pluck('product')->toArray();
       // dd(productname1);
       // exit();

        $productname2 = DB::table('items')->where('register_as', 'Seller')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();
       //  dd($productname2);
//exit();

        $alprofiles = DB::table('profiles')->get();
        $alusers = DB::table('users')->get();
        //$sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        
        $sellers = DB::table('sellers')
        ->select('profiles.factory_state','sellers.*')
        ->join('profiles','profiles.user_id','=','sellers.created_by')
        ->where('created_by' , Auth::user()->id)->get();

       // dd($sellers);
       // exit();
       // $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();
          $buyers = DB::table('buyers')
        ->select('profiles.factory_state','buyers.*')
        ->join('profiles','profiles.user_id','=','buyers.created_by')
        ->where('created_by' , Auth::user()->id)->get();
        
        $cities = DB::table('cities')->get();
        $states = DB::table('cities')->distinct("city_state")->get();
        $items = DB::table('items')->get();
        $availableproducts_one = Seller::join('profiles','profiles.user_id','=','sellers.created_by')->select('profiles.factory_state','sellers.*')->whereIn('product_name', $productname1)->get();
       // dd($availableproducts_one);
        //exit();
        $availableproducts_two = Buyer::join('profiles','profiles.user_id','=','buyers.created_by')->select('profiles.factory_state','buyers.*')->whereIn('product_name', $productname2)->get();
        // dd($availableproducts_two);
        // exit();
       return view('pages/enquiry_offer_view', ['useritems'=>$useritems , 'productname1'=>$productname1, 'sellers'=>$sellers, 'cities'=>$cities, 'states'=>$states,'alprofiles'=>$alprofiles,'availableproducts_one'=>$availableproducts_one,'availableproducts_two'=>$availableproducts_two,'productname2'=>$productname2,'buyers'=>$buyers,'alusers'=>$alusers, 'items'=>$items]);
    }

}
