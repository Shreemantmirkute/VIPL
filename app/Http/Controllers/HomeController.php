<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\Mail\UserActivatedMail;
use App\Mail\UserDeactivatedMail;
use App\Mail\BidAccepted;
//use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Mail;
use App\Seller;
use App\Buyer;
use App\Product;
use App\Item;
use App\News;
use App\Finalbid;
use App\Subproduct;
use App\User;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->get();
        return view('home',['products'=>$products , 'categories'=>$categories]);
    }
    public function admin()
    {
        if (Auth::check()) 
        {
            $user=Auth::user();
            if($user->type == "admin")
            {
                $pendingproduct = DB::table('items')->where('status', 'Pending')->count();
                session(['pendingproduct' => $pendingproduct]);
                $pendingusers = DB::table('users')->where('status', 'Pending')->count();
                session(['pendingusers' => $pendingusers]);
                $totalrevenue = Finalbid::where('status', 'Completed')->sum(\DB::raw('new_price * new_quantity'));
                $totalquantity = Finalbid::where('status', 'Completed')->get()->sum('new_quantity');
                $totalproducts = Subproduct::all()->count();
                $completedbid = Finalbid::where('status', 'Completed')->count();
                $totalcustomers = User::all()->count();
                $finalbids = DB::table('finalbids')->get();
                $temp = Subproduct::all()->pluck('subproduct_code');
                $buyersdata = [];
                  $bidonalldata = DB::table('finalbids')->where('status','Ongoing')->orderBy('id', 'desc')->get();
                  //dd($bidonalldata);
                  
                  $totalongoingbids3 = DB::table('finalbids')->where('status','Ongoing')->count();
                  //dd($totalongoingbids3);
            
                $sellersdata = [];
                foreach ($temp as $t) {
                    $buyer = Buyer::where('product_name', $t)->sum('quantity');
                    array_push($buyersdata, $buyer);
                }
                foreach ($temp as $t) {
                    $seller = Seller::where('product_name', $t)->sum('quantity');
                    array_push($sellersdata, $seller);
                }
                $buyersdata = json_encode($buyersdata);
                $sellersdata = json_encode($sellersdata);
                $temp2 = json_encode($temp);
                $chart = (new LarapexChart)->setTitle('All Products')->setSubtitle('Quantity in MT')->setType('bar')->setXAxis(json_decode($temp2))->setGrid(true)
        ->setDataset([
            [
                'name'  => 'Offer',
                'data'  =>  json_decode($sellersdata)
            ],
            [
                'name'  => 'Enquiry',
                'data'  => json_decode($buyersdata)
            ]
        ])
        ->setStroke(1);
            /*cart */
                return view('admin', ['totalrevenue'=>$totalrevenue,'totalongoingbids3'=>$totalongoingbids3,'bidonalldata'=>$bidonalldata, 'totalquantity'=>$totalquantity, 'totalproducts'=>$totalproducts, 'completedbid'=>$completedbid, 'totalcustomers'=>$totalcustomers, 'finalbids'=>$finalbids, 'chart'=>$chart, 'temp'=>json_encode($buyersdata)]);
            }
            if($user->type == "default")
            {
               return view('welcome_page');
            }
        }
        else
        {
            return view('welcome_page');
        }
    }
    public function admin_users()
    {
        if (Auth::check()) 
        {
            $user=Auth::user();
            if($user->type == "admin")
            {
                //$users = DB::select('select * from users')->paginate(2  );
                $users = DB::table('users')->orderBy('id','DESC')->get();
                $profiles = DB::table('profiles')->orderBy('id','DESC')->get();
                return view('admin/users',['users'=>$users,'profiles'=>$profiles]);
            }
            if($user->type == "default")
            {
               return view('welcome_page');
            }
        }
        else
        {
            return view('welcome_page');
        }
    }

    public function user_details(Request $request)
    {
        if (Auth::check()) 
        {
            $user=Auth::user();
            if($user->type == "admin")
            {
                //$users = DB::select('select * from users')->paginate(2  );
                $users = DB::table('users')->where('id',$request->id)->get();
                $profiles = DB::table('profiles')->where('user_id',$request->id)->get();
                $items = DB::table('items')->where('created_by',$request->id)->paginate(5);
                return view('admin/user-details',['users'=>$users, 'profiles'=>$profiles, 'items'=>$items]);
            }
            if($user->type == "default")
            {
               return view('welcome_page');
            }
        }
        else
        {
            return view('welcome_page');
        }
    }

    public function admin_category()
    {
        if (Auth::check()) 
        {
            $user=Auth::user();
            if($user->type == "admin")
            {
                //$categories = DB::select('select * from categories');
                $categories = DB::table('categories')->orderBy('id','DESC')->get();
                return view('admin/category', ['categories'=>$categories]);
            }
            if($user->type == "default")
            {
               return view('welcome_page');
            }
        }
        else
        {
            return view('welcome_page');
        }
    }

    public function admin_product()
    {
        if (Auth::check()) 
        {
            $user=Auth::user();
            if($user->type == "admin")
            {
                //$categories = DB::select('select * from categories');
                $categories = DB::select('select * from categories');
                $products = DB::table('products')->orderBy('id','DESC')->get();
                $activeproducts = DB::table('products')->where('product_status' , 'Active')->orderBy('id','DESC')->paginate(5);
                $inactiveproducts = DB::table('products')->where('product_status' , 'Deactive')->orderBy('id','DESC')->paginate(5);
                $pendingproducts = DB::table('products')->where('product_status' , 'pending')->orderBy('id','DESC')->paginate(5);
                //$products = DB::select('select * from products');
                return view('admin/product',['products'=>$products , 'categories'=>$categories, 'activeproducts'=>$activeproducts, 'inactiveproducts'=>$inactiveproducts, 'pendingproducts'=>$pendingproducts ]);
            }
            if($user->type == "default")
            {
               return view('welcome_page');
            }
        }
        else
        {
            return view('welcome_page');
        }
    }

    public function admin_subproduct()
    {
        if (Auth::check()) 
        {
            $user=Auth::user();
            if($user->type == "admin")
            {
                //$categories = DB::select('select * from categories');
                $categories = DB::select('select * from categories');
                $products = DB::table('products')->orderBy('id','DESC')->get();
                $subproducts = DB::table('subproducts')->orderBy('id','DESC')->get();
                $activeproducts = DB::table('products')->where('product_status' , 'Active')->orderBy('id','DESC')->get();
                $inactiveproducts = DB::table('products')->where('product_status' , 'Deactive')->orderBy('id','DESC')->get();
                $pendingproducts = DB::table('products')->where('product_status' , 'pending')->orderBy('id','DESC')->get();
                //$products = DB::select('select * from products');
                return view('admin/subproduct',['products'=>$products , 'categories'=>$categories, 'activeproducts'=>$activeproducts, 'inactiveproducts'=>$inactiveproducts, 'subproducts'=>$subproducts, 'pendingproducts'=>$pendingproducts ]);
            }
            if($user->type == "default")
            {
               return view('welcome_page');
            }
        }
        else
        {
            return view('welcome_page');
        }
    }

    public function user_dashboard()
    {
        $users = User::all();
        $informationpages = DB::table('informationpages')->get();
        Session::put('informationpages', $informationpages);
        $online_users = 0;
        foreach ($users as $u) {
            if($u->isOnline())
            {
                $online_users+=1;
            }
        }
        $totalrevenue2 = Finalbid::where('status', 'Completed')->sum(\DB::raw('new_price * new_quantity'));
        $totalquantity2 = Finalbid::where('status', 'Completed')->get()->sum('new_quantity');
        $profiles = DB::table('profiles')->get();
        $pending_items = DB::table('items')->where('created_by', Auth::user()->id)->where('status', 'Pending')->count();
        $active_items = DB::table('items')->where('created_by', Auth::user()->id)->where('status', 'Approved')->count();
        $sellers = DB::table('sellers')->where('created_by', Auth::user()->id)->count();
        $buyers = DB::table('buyers')->where('created_by', Auth::user()->id)->count();
        $ongoing_bids = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Ongoing')->orWhere('buyer_id', Auth::user()->id)->groupby('enquiry_id')->count();
        $accepted_bids = DB::table('finalbids')->where('seller_id', Auth::user()->id)->orWhere('buyer_id', Auth::user()->id)->where('admin_confirmation', 'Accepted')->count();
        $news = DB::table('news')->get();

        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();       
        $buyerswise = DB::table('finalbids')->where('admin_confirmation', 'Approved')->where('seller_id', Auth::user()->id)->get();
         $bidonalldata = DB::table('finalbids')->orderBy('id', 'desc')->take(5)->get();
        // dd($bidonalldata);
        $sellerswise = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->get();
        $myallbids = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id)->get();
        $totalproducts = DB::table('items')->where('created_by', Auth::user()->id)->count();
        $totalongoingbids1 = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id)->get()->unique('seller_id')->count();
        
        $totalongoingbids3 = DB::table('finalbids')->where('status','Ongoing')->where(function($q) {
         $q->where('buyer_id', Auth::user()->id)
           ->orWhere('seller_id', Auth::user()->id);
            })->get()->unique('seller_id')->count();

        
        
        //dd($totalongoingbids3);
        //exit();
            
        
        $totalongoingbids2 = DB::table('finalbids')->Where('seller_id', Auth::user()->id)->orWhere('buyer_id', Auth::user()->id)->get()->unique('buyer_id')->count();
        $totalongoingbids = $totalongoingbids1+$totalongoingbids2;

        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        
        //count for ongoing bid
        
                                $bidOnMyOfferCount = 0; 
                            	foreach($bidonmyoffers->where('status', 'Ongoing') as $bomoc) {             
                               
                                $myoffer_to_date1 = \App\Seller::where('id', $bomoc->offer_id)->pluck('to_date')->first();
                                $mostart1 = \Carbon\Carbon::now();
                                $moend1 = \Carbon\Carbon::parse($myoffer_to_date1); 
                                if($bomoc->offer_id != '' && $mostart1 < $moend1){
                                 $bidOnMyOfferCount+=1; }
                            	}
                            	
                            	 $bidOnMyEnquiryCount = 0; 
                              	foreach($bidonmyenquiries as $bomec){
                                
                                $myenquiry_to_date2 = \App\Buyer::where('id', $bomec->enquiry_id)->pluck('to_date')->first();
                                $mestart2 = \Carbon\Carbon::now();
                                $meend2 = \Carbon\Carbon::parse($myenquiry_to_date2); 
                                if($bomec->enquiry_id != '' && $meend2 > $mestart2 && $bomec->status == 'Ongoing'){
                                 $bidOnMyEnquiryCount+=1; }
                              	}
                              	
                              $bidOnOtherOfferCount = 0; 
                              foreach($bidonoffers as $allbids3){
                              
                               $otheroffer_to_date3 = \App\Seller::where('id', $allbids3->offer_id)->pluck('to_date')->first();
                               $oostart3 = \Carbon\Carbon::now();
                               $ooend3 = \Carbon\Carbon::parse($otheroffer_to_date3); 
                               if($allbids3->offer_id != '' && $allbids3->status == 'Ongoing' && $ooend3 > $oostart3){
                               $bidOnOtherOfferCount+=1; }
                              }
                              
                               $bidOnOtherEnquiryCount = 0; 
                              	foreach($bidonenquiries as $allbids4){
                               
                               	$otherenquiry_to_date4 = \App\Buyer::where('id', $allbids4->enquiry_id)->pluck('to_date')->first();
                               	$oestart4 = \Carbon\Carbon::now();
                               	$oeend4 = \Carbon\Carbon::parse($otherenquiry_to_date4);
                                if($allbids4->enquiry_id != '' && $allbids4->status == 'Ongoing' && $oeend4 > $oestart4){
                                $bidOnOtherEnquiryCount+=1; }
                              	}
                              	
                              	$totalcount = $bidOnMyOfferCount + $bidOnMyEnquiryCount + $bidOnOtherOfferCount + $bidOnOtherEnquiryCount;
                              	//dd($totalcount);
                                

                $buyersdata = [];
                $sellersdata = [];
                $temp = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                foreach ($temp as $key=>$val) {
                    $buyerrevenue = Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->whereMonth('created_at', $key+1)->sum(\DB::raw('new_price * new_quantity'));
                    array_push($buyersdata, $buyerrevenue);
                }
                foreach ($temp as $key=>$val) {
                    $sellerrevenue = Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->whereMonth('created_at', $key+1)->sum(\DB::raw('new_price * new_quantity'));
                    array_push($sellersdata, $sellerrevenue);
                }
                $buyersdata = json_encode($buyersdata);
                $sellersdata = json_encode($sellersdata);
                $temp2 = json_encode($temp);
                $chart = (new LarapexChart)->setTitle('Revenue In Rs')->setSubtitle('')->setType('bar')->setXAxis(json_decode($temp2))->setGrid(true)
        ->setDataset([
            [
                'name'  => 'Sellers',
                'data'  =>  json_decode($sellersdata)
            ],
            [
                'name'  => 'Buyers',
                'data'  => json_decode($buyersdata)
            ]
        ])
        ->setStroke(1);

        $product_where_registered_as_buyer = Item::where('created_by', Auth::user()->id)->where('register_as', 'Buyer')->get()->pluck('product')->toArray();
        //dd($product_where_registered_as_buyer);
        //exit();
        $product_where_registered_as_seller = Item::where('created_by', Auth::user()->id)->where('register_as', 'Seller')->get()->pluck('product')->toArray();
       
        $top_buyers = Buyer::whereIn('product_name', $product_where_registered_as_seller)->get()->sortBy('price');
        $top_sellers = Seller::whereIn('product_name', $product_where_registered_as_buyer)->get()->sortBy('price');
       //   dd($top_buyers);
      //  exit();
        
    $buyershares = DB::table('finalbids')
    ->join('buyers', 'buyers.created_by', '=', 'finalbids.created_by')
    ->join('items', 'items.product', '=', 'buyers.product_name')
    ->join('users', 'users.id', '=', 'items.created_by')
     ->where('users.status', '=', 'Active')
     ->where('finalbids.admin_confirmation', 'Approved')
    //->where('items.created_by', Auth::user()->id)
    ->where('items.register_as', 'Seller')
    ->get()->sortBy('buyers.price');
  // dd($buyershares);
   
   
      /*$bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get()->toArray();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get()->toArray();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get()->toArray();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get()->toArray();*/
        
       /*$top = array_push($top, $bidonoffers);
       $top = array_push($top, $bidonenquiries);
       $top = array_push($top, $bidonmyoffers);
       $top = array_push($top, $bidonmyenquiries);*/
        
        
    
    $sellershares = DB::table('finalbids')
    ->join('buyers', 'buyers.created_by', '=', 'finalbids.created_by')
    ->join('items', 'items.product', '=', 'buyers.product_name')
     ->join('users', 'users.id', '=', 'items.created_by')
    ->where('users.status', '=', 'Active')
    ->where('finalbids.admin_confirmation', 'Approved')
   // ->where('items.created_by', Auth::user()->id)
    ->where('items.register_as', 'Buyer')
    ->get()->sortBy('buyers.price');
    //dd($shares);
   // exit();
   
    /*$bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();*/

        return view('user_dashboard',['profiles'=>$profiles,'totalcount'=>$totalcount, 'informationpages'=>$informationpages, 'pending_items'=>$pending_items, 'active_items'=>$active_items,'totalongoingbids3'=>$totalongoingbids3, 'sellers'=>$sellers, 'buyers'=>$buyers, 'ongoing_bids'=>$ongoing_bids, 'accepted_bids'=>$accepted_bids,'news'=>$news, 'buyerswise'=>$buyerswise,'bidonalldata'=>$bidonalldata, 'sellerswise'=>$sellerswise, 'myallbids'=>$myallbids, 'totalproducts'=>$totalproducts, 'totalongoingbids'=>$totalongoingbids, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries, 'users'=>$users, 'online_users'=>$online_users, 'chart'=>$chart, 'buyershares'=>$buyershares, 'sellershares'=>$sellershares]);
    }
    
     public function more_News()
    {
       
        $news = DB::table('news')->get();

        return view('more_news',['news'=>$news]);
    }
    
     public function user_information()
    {
       
        $informationpages = DB::table('informationpages')->get();

        return view('user-information',['informationpages'=>$informationpages]);
    }

    public function inactive_user_dashboard()
    {
        $profiles = DB::table('profiles')->get();
        return view('pages/inactive_user_dashboard',['profiles'=>$profiles]);
    }

    public function pending_user_dashboard()
    {
        $profiles = DB::table('profiles')->get();
        return view('pages/pending_user_dashboard',['profiles'=>$profiles]);
    }

    public function user_profile()
    {
        $profiles = DB::table('profiles')->get();
        return view('pages/user_profile', ['profiles'=>$profiles]);
    }

    public function edit_profile()
    {
        $profiles = DB::table('profiles')->get();
        return view('pages/edit_profile', ['profiles'=>$profiles]);
    }

    public function change_password()
    {
        $profiles = DB::table('profiles')->get();
        return view('pages/change_password', ['profiles'=>$profiles]);
    }

    public function delete_user(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        $pendingusers = DB::table('users')->where('status', 'Pending')->count();
                session(['pendingusers' => $pendingusers]);
        return redirect('/admin/users')->with('fail','User deleted successfully');
    }

    public function update_user (Request $request)
    {
        $uuser = User::where('id', $request->input('id'))->first();
        $uuser->name = $request->input('name');
        $uuser->email = $request->input('email');
        $uuser->phone = $request->input('phone');
        $uuser->save();
        return redirect('admin/users')->with('success','User updated successfully');
    }

    public function activate_user(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update(['status' => 'Active']);
            #send mail logic
            $name1  = Auth::user()->name ;
            $email1 = Auth::user()->email;

            $objDemo = new \stdClass();
            $objDemo->name = $name1;
            $objDemo->email = $email1;
     
            Mail::to($email1)->send(new UserActivatedMail($objDemo));
            Mail::to('support@webtactic.in')->send(new UserActivatedMail($objDemo));
            $pendingusers = DB::table('users')->where('status', 'Pending')->count();
                session(['pendingusers' => $pendingusers]);
        return redirect('/admin/users')->with('success','User activated successfully');
    }

    public function deactivate_user(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update(['status' => 'Deactive']);
            #send mail logic
            $name1  = Auth::user()->name ;
            $email1 = Auth::user()->email;

            $objDemo = new \stdClass();
            $objDemo->name = $name1;
            $objDemo->email = $email1;
     
            Mail::to($email1)->send(new UserDeactivatedMail($objDemo));
            Mail::to('support@webtactic.in')->send(new UserDeactivatedMail($objDemo));
            $pendingusers = DB::table('users')->where('status', 'Pending')->count();
                session(['pendingusers' => $pendingusers]);
        return redirect('/admin/users')->with('fail','User deactivated successfully');
    }

    public function admin_offer_view()
    {
        /*$useritems = DB::table('items')->where('register_as', 'Seller')->get();
        $sellers = DB::table('sellers')->orderBy('created_at', 'desc')->get();
        $thisusers = DB::table('users')->get();
        return view('admin/admin-offer', ['useritems'=>$useritems , 'sellers'=>$sellers, 'thisusers'=>$thisusers]);*/
        
        $useritemsSeller = DB::table('items')->where('register_as', 'Seller')->get();
         $useritemsBuyer = DB::table('items')->where('register_as', 'Buyer')->get();
        $sellers = DB::table('sellers')->orderBy('created_at', 'desc')->get();
         $buyers = DB::table('buyers')->orderBy('created_at', 'desc')->get();
        $thisusers = DB::table('users')->get();
        return view('admin/admin-offer', ['useritemsSeller'=>$useritemsSeller ,'useritemsBuyer'=>$useritemsBuyer , 'sellers'=>$sellers,'buyers'=>$buyers, 'thisusers'=>$thisusers]);
    }

    public function admin_enquiry_view()
    {
        $useritems = DB::table('items')->where('register_as', 'Buyer')->get();
        $buyers = DB::table('buyers')->orderBy('created_at', 'desc')->get();
        $thisusers = DB::table('users')->get();
        return view('admin/admin-enquiry', ['useritems'=>$useritems , 'buyers'=>$buyers, 'thisusers'=>$thisusers]);
    }

    public function admin_bidacceptance_view()
    {
        $thisusers = DB::table('users')->get();
        $buyerproduct = DB::table('buyers')->get()->pluck('product')->toArray();
        $productforbuyers = Seller::whereIn('product', $buyerproduct)->get();
        $productforbuyersss = Seller::whereIn('product', $buyerproduct)->get()->count();
        $sellerproduct = DB::table('sellers')->get()->pluck('product')->toArray();
        $productforsellers = Buyer::whereIn('product', $sellerproduct)->get();
        $productforsellersss = Buyer::whereIn('product', $sellerproduct)->get()->count();
        return view('admin/admin-bidacceptance', ['productforbuyers'=>$productforbuyers, 'productforsellers'=>$productforsellers, 'productforbuyersss'=>$productforbuyersss, 'productforsellersss'=>$productforsellersss, 'thisusers'=>$thisusers]);
    }

    public function admin_bidaccepted_view()
    { 
        $acceptedbids = DB::table('finalbids')->where('admin_confirmation','Approved')->get();        
        return view('admin/admin-bidaccepted', ['acceptedbids'=>$acceptedbids]);
    }
    
    public function admin_bidcompleted_view()
    {
        $completedbids = DB::table('finalbids')->where('status','Completed')->where('admin_confirmation','Pending')->get();        
        return view('admin/admin-bidcompleted', ['completedbids'=>$completedbids]);
    }
    
     public function admin_ongoing_view()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonenquiries = DB::table('finalbids')->orderBy('id', 'desc')->get()->unique('bid_tracker');
        
         $bidonalldata = DB::table('finalbids')->orderBy('id', 'desc')->take(5)->get();
         //dd($bidonalldata);
        // exit();
         
          //$bidonalldata = DB::table('finalbids')->where('buyer_id', Auth::user()->id || 'offer_id', $myoffers || 'seller_id', Auth::user()->id || 'enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
         // dd($bidonalldata);
        //  exit();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $profiles = DB::table('profiles')->get();
        // dd($bidonoffers);

        return view('admin/admin-ongoing',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }

    public function admin_bidaccepted_single_view(Request $request)
    {
        $acceptedbids = DB::table('finalbids')->where('status','Completed')->where('id', $request->id)->where('seller_id', $request->seller_id)->where('buyer_id', $request->buyer_id)->get();  
        $offer_id3 =  DB::table('finalbids')->where('id', $request->id)->pluck('offer_id')->first();
        $enquiry_id3 =  DB::table('finalbids')->where('id', $request->id)->pluck('enquiry_id')->first();
        return view('admin/admin-bidaccepted-single', ['acceptedbids'=>$acceptedbids, 'buyer_id3'=>$request->buyer_id, 'seller_id3'=>$request->seller_id, 'offer_id3'=>$offer_id3, 'enquiry_id3'=>$enquiry_id3]);
    }

    public function approve_acceptedbid(Request $request)
    {
        DB::table('finalbids')->where('id', $request->id)->update(['admin_confirmation' => 'Approved']);
        $name1  = Auth::user()->name ;
        $email1 = Auth::user()->email;
        $objDemo = new \stdClass();
        $objDemo->name = $name1;
        $objDemo->email = $email1;
        $objDemo->offer_id3 = $request->id;
        $objDemo->enquiry_id3 = $request->id;     
        Mail::to($email1)->send(new BidAccepted($objDemo));
        Mail::to('abhigdrv@gmail.com')->send(new BidAccepted($objDemo));
        return redirect('/admin/admin-bidaccepted-view')->with('success','Bid Approved successfully');
    }

    public function disapprove_acceptedbid(Request $request)
    {
        DB::table('finalbids')->where('id', $request->id)->update(['admin_confirmation' => 'Rejected']);
        return redirect('/admin/admin-bidaccepted-view')->with('success','Bid Disapproved successfully');
    }

    public function admin_item()
    {
        $users = DB::table('users')->get();
        $items = DB::table('items')->orderByRaw('id','DESC')->get();
        //dd($items);
        $pendingproduct = DB::table('items')->where('status', 'Pending')->count();
        session(['pendingproduct' => $pendingproduct]);
        return view('admin/admin-product', ['items'=>$items, 'users'=>$users]); 
    }

    public function approve_item(Request $request)
    {
        DB::table('items')->where('id', $request->id)->update(['status' => 'Approved']);
        $pendingproduct = DB::table('items')->where('status', 'Pending')->count();
        session(['pendingproduct' => $pendingproduct]);
        return redirect()->back()->with('success','Product Approved successfully');
    }

    public function disapprove_item(Request $request)
    {
        DB::table('items')->where('id', $request->id)->update(['status' => 'Rejected']);
        $pendingproduct = DB::table('items')->where('status', 'Pending')->count();
        session(['pendingproduct' => $pendingproduct]);
        return redirect()->back()->with('success','Product Disapproved successfully');
    }
   
}
