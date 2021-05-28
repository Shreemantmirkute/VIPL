<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Item;
use App\Category;
use App\State;
use App\Product;
use App\Subproduct;
use App\Mail\RegistrationMail;
use App\Country;
use App\Businesstype;
use App\Currency;
use App\Unit;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function getall(){
    	$unit = DB::select('SHOW TABLES');
    	$unit = array_map('current',$unit);
    	foreach($unit as $un)
    	{
    	    $u->$un = DB::select($un)->get();
    	}
    	return response()->json($u);
    }
    public function updateuser(Request $request, $id){
    	$users = User::find($id);
    	$users->name = $request->input('name');
    	$users->save();
    	return response()->json($users);
    }

    public function getusers(){
    	$users = User::get();
    	return response()->json($users);
    }

    public function getprofiles(){
    	$profiles = Profile::get();
    	return response()->json($profiles);
    }

    public function getitems(){
    	$items = Item::get();
    	return response()->json($items);
    }

    public function getcategories(){
    	$categories = Category::get();
    	return response()->json($categories);
    }

    public function getproducts(Request $request){
    	$products = Product::where('category', $request->category)->get();
    	return response()->json($products);
    }

    public function getsubproducts(Request $request){
    	$subproducts = Subproduct::where('product', $request->product)->get();
    	return response()->json($subproducts);
    }

    public function getcountry(){
    	$countries = Country::get();
    	return response()->json($countries);
    }

    public function getstate(Request $request){
    	$country = $request->country;
    	$state = State::where('country_name', $country)->get();
    	return response()->json($state);
    }

    public function getareyou(){
    	$areyou = Businesstype::get();
    	return response()->json($areyou);
    }

    public function getcurrency(){
    	$currencies = Currency::get();
    	return response()->json($currencies);
    }

    public function getunit(){
    	$unit = Unit::get();
    	return response()->json($unit);
    }

    public function getregisterdetails(){
        $categories = Category::get();
        $products = Product::get();
        $subproducts = Subproduct::get();
        $countries = Country::get();
        $state = State::get();
        $areyou = Businesstype::get();
        $unit = Unit::get();
        $currencies = Currency::get();

        $getregisterdetails = (object) array();
        $getregisterdetails->categories = $categories;
        $getregisterdetails->products = $products;
        $getregisterdetails->subproducts = $subproducts;
        $getregisterdetails->countries = $countries;
        $getregisterdetails->state = $state;
        $getregisterdetails->areyou = $areyou;
        $getregisterdetails->unit = $unit;
        $getregisterdetails->currencies = $currencies;
        return response()->json($getregisterdetails);
    }

    public function registeruser(Request $request){
        
    	$xyz1 = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);
        $xyz2 = json_decode($xyz1);
        $data = $xyz2->id;

        $company_logo = $request->input('company_logo');
        if ($company_logo != "")
        {
			$extension = explode('/', explode(':', substr($company_logo, 0, strpos($company_logo, ';')))[1])[1];   // .jpg .png .pdf
			$replace = substr($company_logo, 0, strpos($company_logo, ',')+1);
			$cl_image = str_replace($replace, '', $company_logo); 
			$cl_image = str_replace(' ', '+', $cl_image); 
			$companylogo = 'cl'.Str::random(5).time().'.'.$extension;
			Storage::disk('mypublic')->put($companylogo, base64_decode($cl_image));
        }

        $gstimg = $request->input('gstimg');
        if ($gstimg != "")
        {
            $extension2 = explode('/', explode(':', substr($gstimg, 0, strpos($gstimg, ';')))[1])[1];   // .jpg .png .pdf
			$replace2 = substr($gstimg, 0, strpos($gstimg, ',')+1);
			$gi_image = str_replace($replace2, '', $gstimg); 
			$gi_image = str_replace(' ', '+', $gi_image); 
			$gstimage = 'gi'.Str::random(5).time().'.'.$extension2;
			Storage::disk('mypublic')->put($gstimage, base64_decode($gi_image));
        }

        $panimg = $request->input('panimg');
        if ($panimg != "")
        {
            $extension3 = explode('/', explode(':', substr($panimg, 0, strpos($panimg, ';')))[1])[1];   // .jpg .png .pdf
			$replace3 = substr($panimg, 0, strpos($panimg, ',')+1);
			$pi_image = str_replace($replace3, '', $panimg); 
			$pi_image = str_replace(' ', '+', $pi_image); 
			$panimage = 'gi'.Str::random(5).time().'.'.$extension3;
			Storage::disk('mypublic')->put($panimage, base64_decode($pi_image));
        }

        $Upload_model = new Profile;
        $Upload_model->company_logo = $companylogo;
        $Upload_model->gstimg = $gstimage;
        $Upload_model->panimg = $panimage;
        $Upload_model->name = $request->input('name');
        $Upload_model->email = $request->input('email');
        $Upload_model->phone = $request->input('phone');
        $Upload_model->user_name = $request->input('user_name');
        $Upload_model->user_id = $data;
        $Upload_model->company_name = $request->input('company_name');
        $Upload_model->contact_person = $request->input('contact_person');
        $Upload_model->office_number = $request->input('office_number');
        $Upload_model->alternate_number = $request->input('alternate_number');
        $Upload_model->mobile_number = $request->input('mobile_number');
        $Upload_model->office_email = $request->input('office_email');
        $Upload_model->office_address = $request->input('office_address');
        $Upload_model->office_area = $request->input('office_area');
        $Upload_model->office_city = $request->input('office_city');
        $Upload_model->office_state = $request->input('office_state');
        $Upload_model->office_pincode = $request->input('office_pincode');
        $Upload_model->factory_address = $request->input('factory_address');
        $Upload_model->factory_area = $request->input('factory_area');
        $Upload_model->factory_city = $request->input('factory_city');
        $Upload_model->factory_state = $request->input('factory_state');
        $Upload_model->factory_pincode = $request->input('factory_pincode');
        $Upload_model->factory_country = $request->input('factory_country');
        $Upload_model->company_country = $request->input('company_country');
        $Upload_model->office_country = $request->input('office_country');
        $Upload_model->are_you = $request->input('are_you');
        $Upload_model->gstin = $request->input('gstin');
        $Upload_model->iec_code = $request->input('iec_code');
        $Upload_model->currency = "";
        $Upload_model->register_as = "";
        $Upload_model->registration_no = $request->input('registration_no');
        $Upload_model->category = "";
        $Upload_model->subcategory = "";
        $Upload_model->product = "";
        $Upload_model->comission = "";
        $Upload_model->perunit = "";
        $Upload_model->save();

        $size = count(collect($request->input('category')));
        for ($i = 0; $i < $size-1; $i++)
        {
            $Upload_mode = new Item;
            $Upload_mode->register_as = $request->input('register_as.'.$i);
            $Upload_mode->category = $request->input('category.'.$i);
            $Upload_mode->subcategory = $request->input('subcategory.'.$i);
            $Upload_mode->product = $request->input('product.'.$i);
            $Upload_mode->comission = $request->input('comission.'.$i);
            $Upload_mode->currency = $request->input('currency.'.$i);
            $Upload_mode->perunit = $request->input('perunit.'.$i);
            $Upload_mode->user_type = 'default';
            $Upload_mode->created_by = $data;
            $Upload_mode->save();
        }

        $email1 = $request->input('email');
        $objDemo = new \stdClass();
        $objDemo->name = $request->input('name');
        $objDemo->email = $email1;

        Mail::to($email1)->send(new RegistrationMail($objDemo));
        Mail::to('support@webtactic.in')->send(new RegistrationMail($objDemo));
    	return response()->json($xyz1);
    }

    public function login(Request $request)
    {
    	$username = $request->input('username');
    	$password = $request->input('password');
    	$user = User::where('email', $username)->orWhere('phone', $username)->first();
    	if (Hash::check($password , $user->password))
    	{
            $time1 = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('His');
            $date1 = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Ymd');
            $user->token = substr($user->name, 0, 3).$time1.substr($user->email, 0, 2).$date1.'tkn';
            $data = new \stdClass();
            $data->basic_detais = $user;
            $data->profile = Profile::where('user_id', $user->id)->get();
		 	return response()->json($data);
		}
		else
		{
			return response()->json('status:Failed');
		}
    }

    public function checkphone(Request $request)
    {
    	$phone = $request->input('phone');
    	$user = User::where('phone', $phone)->first();
    	if ($user)
    	{
            $ctime = time();
            $resuser = ['timestamp'=>$ctime, 'status'=>'success', 'code'=>'200', 'message'=>'phone number found'];
            return response()->json($resuser);
		}
		else
		{
            $ctime = time();
            $resuser = ['timestamp'=>$ctime, 'status'=>'success', 'code'=>'200', 'message'=>'phone not found'];
            return response()->json($resuser);
		}
    }

    public function checkemail(Request $request)
    {
    	$email = $request->input('email');
    	$user = User::where('email', $email)->first();
    	if ($user)
    	{
            $ctime = time();
            $resuser = ['timestamp'=>$ctime, 'status'=>'success', 'code'=>'200', 'message'=>'Email found'];
            return response()->json($resuser);
		}
		else
		{
			$ctime = time();
            $resuser = ['timestamp'=>$ctime, 'status'=>'fail', 'code'=>'200', 'message'=>'Email not found'];
            return response()->json($resuser);
		}
    }

    public function forgotpassword(Request $request)
{
    $input = $request->all();
    $rules = array(
        'email' => "required|email",
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    } else {
        try {
            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                case Password::INVALID_USER:
                    return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
            }
        } catch (\Swift_TransportException $ex) {
            $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
        } catch (Exception $ex) {
            $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
        }
    }
    return \Response::json($arr);
}
	
	public function addsubuser(Request $request)
    {
    	$parent = $request->input('parent');
    	$user = User::where('id', $parent)->first();
    	$subuser = User::where('email', $request->input('email'))->first();
    	if ($user && !$subuser)
    	{
            $ctime = time();
            $subuser = new User;
	        $subuser->name = $request->input('name');
	        $subuser->email = $request->input('email');
	        $subuser->parent = $request->input('parent');
	        $subuser->password = Hash::make($request->input('password')); 
	        $subuser->role = $request->input('role');
	        $subuser->subusercount = 'NA';
	        $subuser->save();
	        User::where('id', $parent)->increment('subusercount');
            $resuser = ['timestamp'=>$ctime, 'status'=>'success', 'code'=>'200', 'message'=>'Subuser Created Successfully', 'data', $subuser];
            return response()->json($resuser);
        }
        else
        {
        	$ctime = time();
            $resuser = ['timestamp'=>$ctime, 'status'=>'fail', 'code'=>'200', 'message'=>'Parent User Not Found or Subuser Exist'];
            return response()->json($resuser);
        }
    }

    public function addEnquiryOffer(Request $request) {
        if ($request->register_as == "Seller") {

            $this->validate($request, [
                    'product_image' => 'required',
                    'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ]);

            if($request->hasfile('product_image'))
            {
                foreach($request->file('product_image') as $image)
                {
                    $name=time().'_'.$image->getClientOriginalName();
                    $image->move(public_path().'/imageupload/offer', $name);
                    $data[] = $name;  
                }
            }        

            $Upload_model = new Seller;
            $Upload_model->product_image = json_encode($data);
            $Upload_model->product = $request->input('product');
            $Upload_model->product_name = DB::table('items')->where('id', $Upload_model->product)->pluck('product')->first();
            $Upload_model->created_by = $request->input('created_by');
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
            $Upload_model->save();
            $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Seller')->get();
            $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();

            $cities = DB::table('cities')->get();
            $states = DB::table('cities')->distinct("city_state")->get();
        }

        if($request->register_as == "Buyer") {
            if($request->hasfile('product_image'))
            {
                foreach($request->file('product_image') as $image)
                {
                    $name=time().'_'.$image->getClientOriginalName();
                    $image->move(public_path().'/imageupload/enquiry', $name); 
                    $data[] = $name;  
                }

            }
            $Upload_model = new Buyer;
            $Upload_model->product_image = json_encode($data);
            $Upload_model->product = $request->input('product');
            $Upload_model->product_name = DB::table('items')->where('id', $Upload_model->product)->pluck('product')->first();
            $Upload_model->created_by = $request->input('created_by');
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
            $Upload_model->save();
            $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->where('register_as', 'Buyer')->get();
            $buyers = DB::table('buyers')->where('created_by' , Auth::user()->id)->get();

            $cities = DB::table('cities')->get();
            $states = DB::table('cities')->distinct('city_state')->get();
        }
            return response()->json($Upload_model);
    }
}
