<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Finalbid;
use App\Profile;
use App\Buyer;
use App\Seller;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function report()
    {
    	$buyers = DB::table('buyers')->get();
    	$sellers = DB::table('sellers')->get();
    	$finalbids = DB::table('finalbids')->get();
    	$items = DB::table('items')->get();
    	$myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
    	$myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();    	
    	$buyerswise = DB::table('finalbids')->where('seller_id', Auth::user()->id)->get();
    	$sellerswise = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->get();
    	$myallbids = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id)->get();
        return view('pages.report', ['buyers'=>$buyers, 'sellers'=>$sellers, 'finalbids'=>$finalbids, 'items'=>$items, 'buyerswise'=>$buyerswise, 'sellerswise'=>$sellerswise, 'myallbids'=>$myallbids]);
    }
    
     public function productWiseBuyerSeller()
    {
    	$buyers = DB::table('buyers')->get();
    	$sellers = DB::table('sellers')->get();
    	$finalbids = DB::table('finalbids')->get();
    	$items = DB::table('items')->get();
    	$myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
    	$myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();    	
    	$buyerswise = DB::table('finalbids')->where('seller_id', Auth::user()->id)->get();
    	$sellerswise = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->get();
    	$myallbids = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id)->get();
        return view('pages.product_wise_buyer_seller', ['buyers'=>$buyers, 'sellers'=>$sellers, 'finalbids'=>$finalbids, 'items'=>$items, 'buyerswise'=>$buyerswise, 'sellerswise'=>$sellerswise, 'myallbids'=>$myallbids]);
    }

    public function top_buyers()
    {
        $finalbids = DB::table('finalbids')->get();
        return view('admin.top_buyers', ['finalbids'=>$finalbids]);
    }

    public function top_sellers()
    {
        $finalbids = DB::table('finalbids')->get();
        return view('admin.top_sellers', ['finalbids'=>$finalbids]);
    }

    public function daily_sales()
    {
        $finalbids = DB::table('finalbids')->where('status', 'Completed')->whereDay('created_at', now()->day)->get();
        return view('admin.daily_sales', ['finalbids'=>$finalbids]);
    }

    public function amount_wise_turnover()
    {
        $finalbids = DB::table('finalbids')->where('status', 'Completed')->get();
        return view('admin.amount_wise_turnover', ['finalbids'=>$finalbids]);
    }

    public function admin_final_report()
    {
        $finalbids = DB::table('finalbids')->get();
        $items = DB::table('items')->get();
        $buyers = DB::table('buyers')->get();
        $sellers = DB::table('sellers')->get();
        return view('admin/admin_final_report', ['finalbids'=>$finalbids, 'items'=>$items, 'buyers'=>$buyers, 'sellers'=>$sellers]);
    }

    public function userfinalreport()
    {
        $finalbids = DB::table('finalbids')->get();
        $items = DB::table('items')->get();
        $buyers = DB::table('buyers')->get();
        $sellers = DB::table('sellers')->get();
        return view('pages/userfinalreport', ['finalbids'=>$finalbids, 'items'=>$items, 'buyers'=>$buyers, 'sellers'=>$sellers]);
    }

    public function ajax_get_item()
    {
        $name = $_GET['cid'];
        $users = DB::table('items')->where('product', $name)->get()->pluck('created_by')->toArray();
        $buyerseller = Profile::whereIn('user_id', $users)->get();
        return Response::json($buyerseller);
    }

    public function ajax_get_item_user()
    {
        $name = $_GET['cid'];
        $offers = Seller::where('product_name', $name)->pluck('created_by')->toArray();
        $enquiry = Buyer::where('product_name', $name)->pluck('created_by')->toArray();
        $allusers = array_merge($enquiry,$offers);
        $buyerseller = Profile::whereIn('user_id', $allusers)->get();
        return Response::json($buyerseller);
    }

    public function finalreport()
    {
        $name = $_GET['subproduct'];
        $buyerseller = $_GET['buyerseller'];
        $buyerseller = (int) filter_var($buyerseller, FILTER_SANITIZE_NUMBER_INT);  
        $fromdate = $_GET['fromdate'];
        $todate = $_GET['todate'];
        if($buyerseller == '')
        {
            if(Auth::user()->id == 1)
            {
                $items = DB::table('items')->where('product', $name)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
            }
            else
            {
                $items = DB::table('items')->where('product', $name)->where('created_by', Auth::user()->id)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
            }            
        }
        else
        {
            if(Auth::user()->id == 1)
            {
                $items = DB::table('items')->where('product', $name)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
            }
            else
            {
                $items = DB::table('items')->where('product', $name)->where('created_by', Auth::user()->id)->where('created_by', $buyerseller)->whereDate('created_at', '>=', $fromdate)->whereDate('created_at', '<=', $todate)->get();
            }            
        }
        
        $obj = array();
        if($items->count() > 0)
        {
            foreach ($items as $item) {
                if($item->register_as == 'Buyer')
                {
                    if($buyerseller == '')
                    {
                        $enquiry = Buyer::where('product_name', $item->product)->get()->pluck('id')->toArray();
                        $enquiry3 = json_encode($enquiry);
                        $totalqty = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->sum('new_quantity');
                        $totalunit = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('new_unit')->first();
                        $totalperunit = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('new_perunit')->first();
                        $totalcurrency = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('new_currency')->first();
                        $totalprice = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->sum('new_price');
                        $buyerid = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('buyer_id')->first();
                        $sellerid = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('seller_id')->first();
                        $buyer = Profile::where('user_id', $buyerid)->get()->pluck('company_name')->first();
                        $seller = Profile::where('user_id', $sellerid)->get()->pluck('company_name')->first();
                        $created_by = $buyer;
                        $type = 'Enquiry';
                    }
                    else
                    {
                        if(Auth::user()->id == 1)
                        {
                            $totalqty = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->sum('new_quantity');
                            $totalunit = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->pluck('new_unit')->first();
                            $totalperunit = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->pluck('new_perunit')->first();
                            $totalcurrency = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->pluck('new_currency')->first();
                            $totalprice = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->sum('new_price');
                            $buyerid = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->pluck('buyer_id')->first();
                            $sellerid = Finalbid::where('seller_id', $buyerseller)->orWhere('buyer_id', $buyerseller)->where('status', 'Completed')->get()->pluck('seller_id')->first();
                            $buyer = Profile::where('user_id', $buyerid)->get()->pluck('company_name')->first();
                            $seller = Profile::where('user_id', $sellerid)->get()->pluck('company_name')->first();
                            $created_by = $buyer;
                            $type = 'Enquiry';
                        }
                        else
                        {
                            $enquiry = Buyer::where('created_by', $buyerseller)->get()->pluck('id')->toArray();
                            $enquiry3 = json_encode($enquiry);
                            $totalqty = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->sum('new_quantity');
                            $totalunit = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('new_unit')->first();
                            $totalperunit = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('new_perunit')->first();
                            $totalcurrency = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('new_currency')->first();
                            $totalprice = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->sum('new_price');
                            $buyerid = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('buyer_id')->first();
                            $sellerid = Finalbid::whereIn('enquiry_id', $enquiry)->where('status', 'Completed')->get()->pluck('seller_id')->first();
                            $buyer = Profile::where('user_id', $buyerid)->get()->pluck('company_name')->first();
                            $seller = Profile::where('user_id', $sellerid)->get()->pluck('company_name')->first();
                            $created_by = $buyer;
                            $type = 'Enquiry';
                        }                        
                    }                    
                }
                else
                {
                    if($buyerseller == '')
                    {
                        $offer = Seller::where('product_name', $item->product)->get()->pluck('id')->toArray();
                        $offer3 = json_encode($offer);
                        $totalqty = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->sum('new_quantity');
                        $totalunit = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('new_unit')->first();
                        $totalperunit = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('new_perunit')->first();
                        $totalcurrency = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('new_currency')->first();
                        $totalprice = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->sum('new_price');
                        $buyerid = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('buyer_id')->first();
                        $sellerid = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('seller_id')->first();
                        $buyer = Profile::where('user_id', $buyerid)->get()->pluck('company_name')->first();
                        $seller = Profile::where('user_id', $sellerid)->get()->pluck('company_name')->first();
                        $created_by = $seller;
                        $type = 'Offer';

                    }
                    else
                    {
                        if(Auth::user()->id == 1)
                        {
                            $offer = Seller::where('created_by', $buyerseller)->get()->pluck('id')->toArray();
                            $offer3 = json_encode($offer);
                            $totalqty = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->sum('new_quantity');
                            $totalunit = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->pluck('new_unit')->first();
                            $totalperunit = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->pluck('new_perunit')->first();
                            $totalcurrency = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->pluck('new_currency')->first();
                            $totalprice = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->sum('new_price');
                            $buyerid = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->pluck('buyer_id')->first();
                            $sellerid = Finalbid::where('buyer_id', $buyerseller)->orWhere('seller_id', $buyerseller)->where('status', 'Completed')->get()->pluck('seller_id')->first();
                            $buyer = Profile::where('user_id', $buyerid)->get()->pluck('company_name')->first();
                            $seller = Profile::where('user_id', $sellerid)->get()->pluck('company_name')->first();
                            $created_by = $seller;
                            $type = 'Offer';
                        }
                        else
                        {
                            $offer = Seller::where('created_by', $buyerseller)->get()->pluck('id')->toArray();
                            $offer3 = json_encode($offer);
                            $totalqty = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->sum('new_quantity');
                            $totalunit = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('new_unit')->first();
                            $totalperunit = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('new_perunit')->first();
                            $totalcurrency = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('new_currency')->first();
                            $totalprice = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->sum('new_price');
                            $buyerid = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('buyer_id')->first();
                            $sellerid = Finalbid::whereIn('offer_id', $offer)->where('status', 'Completed')->get()->pluck('seller_id')->first();
                            $buyer = Profile::where('user_id', $buyerid)->get()->pluck('company_name')->first();
                            $seller = Profile::where('user_id', $sellerid)->get()->pluck('company_name')->first();
                            $created_by = $seller;
                            $type = 'Offer';
                        }                        

                    }
                }
                if($buyerid != '')
                {
                    $obj[] = array('created_at' => $item->created_at, 'id'=>$item->id,'product'=>$item->product,'register_as'=>$item->register_as,'totalqty'=>$totalqty.$totalperunit,'totalprice'=>$totalcurrency.$totalprice.$totalperunit, 'buyer'=>$buyer, 'seller'=>$seller, 'created_by'=>$created_by, 'type'=>$type);
                }                
               /*$result .= "<tr><td>".$item->created_at."</td><td>".$item->id."</td><td>".$item->product."</td><td>".$item->register_as."</td><td>".$totalqty.$totalunit."</td><td>".$totalcurrency.$totalprice.$totalperunit."</td></tr>";*/
            }
        }
        else
        {
            $obj[] = array('0 Result Found');
        }
        return Response::json($obj);
    }
}