<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Profile;
use App\Item;
use DB;
use Auth;
use App\Mail\PasswordChangeMail;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;
use App\Seller;
use App\Buyer;
use Illuminate\Support\Facades\Response;
use Image;
use App\User;
use Illuminate\Notifications\Notification;
use App\Notifications\TaskCompleted;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function create (Request $request)
    {
        $validateData = $request->validate([
            'company_logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gstimg' => 'required',
            'gstimg.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'panimg' => 'required',
            'panimg.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
        ]);

        if($request->hasfile('company_logo'))
        {
        $image1 = $request->file('company_logo');
        $image2 = $request->file('gstimg');
        $image3 = $request->file('panimg');
        $name1 = time().'_'.$image1->getClientOriginalName();
        $name2 = time().'_'.$image2->getClientOriginalName();
        $name3 = time().'_'.$image3->getClientOriginalName();
        $image1->move(public_path().'/imageupload/profile', $name1);
        $image2->move(public_path().'/imageupload/profile', $name2);
        $image3->move(public_path().'/imageupload/profile', $name3);
        }

        //Profile::create($request->all());
        dd($request->all());

        $Upload_model = new Profile;
        $Upload_model->company_logo = $name1;
        $Upload_model->gstimg = $name2;
        $Upload_model->panimg = $name3;
        $Upload_model->name = $request->input('name');
        $Upload_model->email = $request->input('email');
        $Upload_model->phone = $request->input('phone');
        $Upload_model->user_name = $request->input('user_name');
        $Upload_model->user_id = $request->input('user_id');
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
        $Upload_model->are_you = $request->input('are_you');
        $Upload_model->gstin = $request->input('gstin');
        $Upload_model->iec_code = $request->input('iec_code');
        $Upload_model->currency = $request->input('currency');
        $Upload_model->register_as = $request->input('register_as');
        $Upload_model->registration_no = $request->input('registration_no');
        $Upload_model->category = $request->input('category');
        $Upload_model->subcategory = $request->input('subcategory');
        $Upload_model->product = $request->input('product');
        $Upload_model->comission = $request->input('comission');
        $Upload_model->perunit = $request->input('perunit');
        $Upload_model->save();


        $Upload_mode = new Item;
        $Upload_mode->register_as = $request->input('register_as');
        $Upload_mode->category = $request->input('category');
        $Upload_mode->subcategory = $request->input('subcategory');
        $Upload_mode->product = $request->input('product');
        $Upload_mode->comission = $request->input('comission');
        $Upload_mode->currency = $request->input('currency');
        $Upload_mode->perunit = $request->input('perunit');
        $Upload_mode->user_type = Auth::user()->type;
        $Upload_mode->created_by = Auth::user()->id;
        $Upload_mode->save();


        return redirect('/add_product');
    }

    public function update_profile(Request $request)
    {
        // $validateData = $request->validate([
            
        //     'company_logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            
        //     'gstimg.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        //     'panimg.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        // ]);

        if($request->hasfile('company_logo'))
        {
            $image1 = $request->file('company_logo');
            $name1 = time().'_'.$image1->getClientOriginalName();
            $image1->move(public_path().'/imageupload/profile', $name1);
        }else
        {
            $name1="NA";
        }

        if($request->hasfile('gstimg'))
        {
        $image2 = $request->file('gstimg');
        $name2 = time().'_'.$image2->getClientOriginalName();
        $image2->move(public_path().'/imageupload/profile', $name2);
        }else
        {
            $name2="NA";
        }

        if($request->hasfile('panimg'))
        {
        $image3 = $request->file('panimg');
        $name3 = time().'_'.$image3->getClientOriginalName();
        $image3->move(public_path().'/imageupload/profile', $name3);
        }else
        {
            $name3="NA";
        }

        //Profile::create($request->all());

        $Upload_model = Profile::where('id', $request->input('user_id'))->first();
        if($name1 != "NA")
        {
            $Upload_model->company_logo = $name1;
        }

        if($name2 != "NA")
        {
            $Upload_model->gstimg = $name2;
        }
        
        if($name3 != "NA")
        {
            $Upload_model->panimg = $name3;
        }        
        $Upload_model->user_id = $request->input('price');
        $Upload_model->name = $request->input('name');
        $Upload_model->email = $request->input('email');
        $Upload_model->phone = $request->input('phone');
        $Upload_model->user_name = $request->input('user_name');
        $Upload_model->user_id = $request->input('user_id');
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
        $Upload_model->are_you = $request->input('are_you');
        $Upload_model->gstin = $request->input('gstin');
        $Upload_model->iec_code = $request->input('iec_code');
        $Upload_model->currency = $request->input('currency');
        $Upload_model->register_as = $request->input('register_as');

        $Upload_model->save();

        return redirect('/user_profile');
    }
    public function update_password(Request $request)
    {
        //dd($request);
        User::where('id', Auth::user()->id)->update(['password'=>Hash::make($request->password)]);
        return redirect()->back()->with('success','Password Updated Successfully');
    }
    public function changepassword (Request $request)
    {
        $validateData = $request->validate([
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        if (!Hash::check($request['old_password'], Auth::user()->password))
        {
            return redirect()->back()->with('fail','Current Password Is Wrong Please Retry');
        }
        else
        {
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();
            #send mail logic
            $name1  = Auth::user()->name ;
            $email1 = Auth::user()->email;

            $objDemo = new \stdClass();
            $objDemo->name = $name1;
            $objDemo->email = $email1;
      
            Mail::to($email1)->send(new PasswordChangeMail($objDemo));
            Mail::to('support@webtactic.in')->send(new PasswordChangeMail($objDemo));
            return redirect()->back()->with('success','Password Updated Successfully');
        }
        
    }

    public function offerview (Request $request)
    {
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->get();
        $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        return view('pages/offer', ['useritems'=>$useritems , 'sellers'=>$sellers]);
    }

    public function offerpost (Request $request)
    {
        $request->validate([
          'product_image' => 'image|max:2048'
         ]);
        
        $image_file = $request->product_image;
        $image = Image::make($image_file->getRealPath());
        Response::make($image->encode('jpeg'));
        $request->product_image = $image;
        Seller::create($request->all());

        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->get();
        $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        return view('pages/offer', ['useritems'=>$useritems , 'sellers'=>$sellers])->with('success','Offer Made Successfully');;
    }

    public function fetchimage($id)
    {
     $image = Seller::findOrFail($id);
     $image_file = Image::make($image->product_image);
     $response = Response::make($image_file->encode('jpeg'));
     $response->header('Content-Type', 'image/jpeg');
     return $response;
    }

    public function enquiryview (Request $request)
    {
        return view('pages/enquiry');
    }

    public function bidacceptanceview (Request $request)
    {
        $buyerproduct = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();
        $productforbuyers = Seller::whereIn('product', $buyerproduct)->where('created_by', '!=', Auth::user()->id)->get();
        $productforbuyersss = Seller::whereIn('product', $buyerproduct)->where('created_by', '!=', Auth::user()->id)->get()->count();

        $sellerproduct = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();
        $productforsellers = Buyer::whereIn('product', $sellerproduct)->where('created_by', '!=', Auth::user()->id)->get();
        $productforsellersss = Buyer::whereIn('product', $sellerproduct)->where('created_by', '!=', Auth::user()->id)->get()->count();
        // dd($productforbuyers);
        
        return view('pages/bidacceptance', ['productforbuyers'=>$productforbuyers, 'productforsellers'=>$productforsellers, 'productforbuyersss'=>$productforbuyersss, 'productforsellersss'=>$productforsellersss, 'buyerproduct'=>$buyerproduct, 'sellerproduct'=>$sellerproduct]);
    }

    public function delete_seller (Request $request)
    {
        DB::table('sellers')->where('id', $request->id)->delete();
        $useritems = DB::table('items')->where('created_by' , Auth::user()->id)->get();
        $sellers = DB::table('sellers')->where('created_by' , Auth::user()->id)->get();
        // return view('pages/offer', ['useritems'=>$useritems , 'sellers'=>$sellers])->with('successdeleted','Offer Deleted Successfully');
        return redirect()->back()->with('successdeleted','Offer Deleted Successfully');
    }

    public function test001(Request $request)
    {
        // dd($request->all()); exit();
        // $validateData = $request->validate([
        //     'company_logo' => ['mimes:jpeg,png,jpg,gif,svg|max:2048'],
        //     'gstimg' => ['mimes:jpeg,png,jpg,gif,svg,pdf|max:5120'],
        //     'panimg' => ['mimes:jpeg,png,jpg,gif,svg,pdf|max:5120'],
        // ]);
        request()->validate([
            'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gstimg' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'panimg' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|max:13',
            'office_number' => 'required|string|min:10|max:13',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $xyz1 = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);
        $notification = 'New Account Created By'.$request->input('name');
        User::find(1)->notify(new TaskCompleted($notification));
        $xyz2 = json_decode($xyz1);
        $data = $xyz2->id;
        
        if($request->file('company_logo'))
        {
        $image11 = $request->file('company_logo');
        $name11 = time().'_'.$image11->getClientOriginalName();
        $image11->move(public_path().'/imageupload/profile', $name11);
        }
        if($request->file('gstimg'))
        {
        $image21 = $request->file('gstimg');
        $name21 = time().'_'.$image21->getClientOriginalName();
        $image21->move(public_path().'/imageupload/profile', $name21);
        }
        if($request->file('panimg'))
        {
        $image31 = $request->file('panimg');
        $name31 = time().'_'.$image31->getClientOriginalName();
        $image31->move(public_path().'/imageupload/profile', $name31);
        }

        //Profile::create($request->all());

        $Upload_model = new Profile;
        if($request->file('company_logo'))
        {
            $Upload_model->company_logo = $name11;
        }
        else
        {
            $Upload_model->company_logo = $request->input('company_logo');
        }
        if($request->file('gstimg'))
        {
            $Upload_model->gstimg = $name21;
        }
        else
        {
            $Upload_model->gstimg = $request->input('gstimg');
        }
        if($request->file('panimg'))
        {
            $Upload_model->panimg = $name31;
        }
        else
        {
            $Upload_model->panimg = $request->input('panimg');
        }
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
        $Upload_model->factory_number = $request->input('factory_number');
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
        $saved_or_not = $Upload_model->save();
        if($saved_or_not == false)
        {
            $xyz1->delete();
            return redirect()->back()->with('fail', 'Error Occured Please Try After Some Time');
        }

        $size = count(collect($request->input('category')));
        for ($i = 0; $i < $size; $i++)
        {
            //$qwert[$i] = $request->input('category.'.$i);
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
        return redirect('thankyou')->with('success','Thankyou for connecting with us, please login to continue');
    }

    public function test002(Request $request)
    {
        $size = count(collect($request->input('category')));
        $count11 = $size-1;
        for ($i = 0; $i < $size-1; $i++){
            $qwert[$i] = $request->input('category.'.$i);
        }
        $category1 = $request->input('category.1');

        return view('test', ['category1'=>$count11, 'qwert'=>$qwert]);
    }
    
     public function saveToken(Request $request)
    {
        // dd($request->token);
        // exit();
        User::where('email', $request->email)->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function newBidAcceptanceView()
    {   
        $buyerproduct = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();

        $productforbuyers = Seller::whereIn('product', $buyerproduct)->where('created_by', '!=', Auth::user()->id)->get();
        $productforbuyersss = Seller::whereIn('product', $buyerproduct)->where('created_by', '!=', Auth::user()->id)->get()->count();

        $sellerproduct = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();
        $productforsellers = Buyer::whereIn('product', $sellerproduct)->where('created_by', '!=', Auth::user()->id)->get();
        $productforsellersss = Buyer::whereIn('product', $sellerproduct)->where('created_by', '!=', Auth::user()->id)->get()->count();
        // dd($productforbuyers);
        // dd($allbids);
        return view('pages/new_bidacceptance', ['productforbuyers'=>$productforbuyers, 'productforsellers'=>$productforsellers, 'productforbuyersss'=>$productforbuyersss, 'productforsellersss'=>$productforsellersss, 'buyerproduct'=>$buyerproduct, 'sellerproduct'=>$sellerproduct]);
    }
}
