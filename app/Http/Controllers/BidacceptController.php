<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bidaccept;
use App\Bid;
use App\Finalbid;
use App\User;
use App\Counterbid;
use App\Seller;
use App\Buyer;
use App\Uploaddoc;
use Auth;
use Illuminate\Notifications\Notification;
use App\Notifications\TaskCompleted;

class BidacceptController extends Controller
{
    public function sellerbidacceptance(Request $request)
    {
        $sellers = DB::table('sellers')->where('id', $request->id)->get();
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();

        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        return view('pages/sellerbidacceptance', ['sellers'=>$sellers,'bids'=>$bids,'users'=>$users,'counterbids'=>$counterbids,'acceptedbids'=>$acceptedbids]);
    }

    public function bidbybuyer(Request $request)
    {   
        // dd($request->seller_id);

        $sellers = DB::table('sellers')->where('id',$request->seller_id)->get();
        // $sellers = DB::table('sellers')->get();
        $profiles = DB::table('profiles')->get();
        $bidbybuyers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->get();
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->seller_id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->seller_id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();

    
        return view('pages/bid/bidbybuyer', ['sellers'=>$sellers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbybuyers'=>$bidbybuyers,'profiles'=>$profiles, 'seller_id'=>$request->seller_id, 'seller_user_id'=>$request->seller_user_id, 'buyer_user_id'=>$request->buyer_user_id]);
    }

    public function ajaxbidbybuyer(Request $request)
    {   
        // dd($request->seller_id);

        $sellers = DB::table('sellers')->where('id',$request->seller_id)->get();
        // $sellers = DB::table('sellers')->get();
        $profiles = DB::table('profiles')->get();
        $bidbybuyers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->get();
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->seller_id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->seller_id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();

    
        return view('ajaxbidbybuyer', ['sellers'=>$sellers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbybuyers'=>$bidbybuyers,'profiles'=>$profiles, 'seller_user_id'=>$request->seller_user_id]);
    }

    public function bidbyseller(Request $request)
    {
        $buyers = DB::table('buyers')->where('id', $request->buyer_id)->get();
        $profiles = DB::table('profiles')->get();
        $qwer1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->orderBy('id', 'desc')->pluck('id')->skip(1)->first();
        if($qwer1)
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id', '>', $qwer1)->get();
        }
        else
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->get();
        }        
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        // dd($buyers);
        return view('pages/bid/bidbyseller', ['buyers'=>$buyers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles, 'seller_id'=>$request->buyer_id, 'seller_user_id'=>$request->seller_user_id, 'buyer_user_id'=>$request->buyer_user_id]);
    }

    public function ajaxbidbyseller(Request $request)
    {
        $buyers = DB::table('buyers')->where('id', $request->buyer_id)->get();
        $profiles = DB::table('profiles')->get();
        $qwer1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->orderBy('id', 'desc')->pluck('id')->skip(1)->first();
        if($qwer1)
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id', '>', $qwer1)->get();
        }
        else
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->get();
        }        
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        // dd($buyers);
        return view('ajaxbidbyseller', ['buyers'=>$buyers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles, 'buyer_user_id'=>$request->buyer_user_id]);
    }


    public function bidbysellerhistory(Request $request)
    {
        $users = DB::table('users')->get();
        $finalbids = DB::table('finalbids')->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('enquiry_id', $request->buyer_id)->where('admin_confirmation', 'Approved')->where('status', 'Completed')->get();
        return view('pages/bid/bidbysellerhistory', ['users'=>$users, 'finalbids'=>$finalbids]);
    }

    public function bidbybuyerhistory(Request $request)
    {
        $users = DB::table('users')->get();
        $finalbids = DB::table('finalbids')->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('offer_id', $request->seller_id)->where('admin_confirmation', 'Approved')->where('status', 'Completed')->get();
        return view('pages/bid/bidbybuyerhistory', ['users'=>$users, 'finalbids'=>$finalbids]);
    }

    public function bidbysellerhistorysingle(Request $request)
    {
        $buyers = DB::table('buyers')->where('id', $request->buyer_id)->get();
        $profiles = DB::table('profiles')->get();
        $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
        if($asdfg1)
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
        }
        else
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
        }
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        return view('pages/bid/bidbysellerhistorysingle', ['buyers'=>$buyers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
    }

    public function bidbybuyerhistorysingle(Request $request)
    {
        $sellers = DB::table('sellers')->where('id', $request->seller_id)->get();
        $profiles = DB::table('profiles')->get();
        $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
        if($asdfg1)
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
        }
        else
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
        }
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        return view('pages/bid/bidbybuyerhistorysingle', ['sellers'=>$sellers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
    }

    public function ajaxbidbysellerhistorysingle(Request $request)
    {
        $buyers = DB::table('buyers')->where('id', $request->buyer_id)->get();
        $profiles = DB::table('profiles')->get();
        $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
        if($asdfg1)
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
        }
        else
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
        }
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        return view('pages/bid/ajaxbidbysellerhistorysingle', ['buyers'=>$buyers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
    }

    public function ajaxbidbybuyerhistorysingle(Request $request)
    {
        $sellers = DB::table('sellers')->where('id', $request->seller_id)->get();
        $profiles = DB::table('profiles')->get();
        $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
        if($asdfg1)
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
        }
        else
        {
            $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
        }
        $users = DB::table('users')->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        return view('pages/bid/ajaxbidbybuyerhistorysingle', ['sellers'=>$sellers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
    }

    public function singletrail(Request $request)
    {
        if($request->seller_id != 'NA')
        {
            // $sellers = DB::table('sellers')->where('id', $request->seller_id)->get();
            // $profiles = DB::table('profiles')->get();
            // $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
            // if($asdfg1)
            // {
            //     $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
            // }
            // else
            // {
            //     $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
            // }
            // $users = DB::table('users')->get();
            // $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
            // $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
            // $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
            // $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
            // $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
            // return view('admin/singletrailb', ['sellers'=>$sellers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
            return redirect('admin/singletrailb/'.$request->seller_id.'/'.$request->seller_user_id.'/'.$request->buyer_user_id.'/'.$request->bidid);
        }
        else
        {
            // $buyers = DB::table('buyers')->where('id', $request->buyer_id)->get();
            // $profiles = DB::table('profiles')->get();
            // $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
            // if($asdfg1)
            // {
            //     $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
            // }
            // else
            // {
            //     $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
            // }
            // $users = DB::table('users')->get();
            // $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
            // $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
            // $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
            // $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
            // $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
            // return view('admin/singletrails', ['buyers'=>$buyers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
            return redirect('admin/singletrails/'.$request->buyer_id.'/'.$request->buyer_user_id.'/'.$request->seller_user_id.'/'.$request->bidid);
        }
        
    }

    public function ajaxsingletrail(Request $request)
    {
        if($request->seller_id != 'NA')
        {
            //return redirect('admin/ajaxsingletrailb/'.$request->seller_id.'/'.$request->seller_user_id.'/'.$request->buyer_user_id.'/'.$request->bidid);

            $sellers = DB::table('sellers')->where('id', $request->seller_id)->get();
            $profiles = DB::table('profiles')->get();
            $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
            if($asdfg1)
            {
                $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
            }
            else
            {
                $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
            }
            $users = DB::table('users')->get();
            $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
            $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
            $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
            $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
            $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
            return view('pages/bid/ajaxbidbybuyerhistorysingle', ['sellers'=>$sellers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
        }
        else
        {
            //return redirect('admin/ajaxsingletrails/'.$request->buyer_id.'/'.$request->buyer_user_id.'/'.$request->seller_user_id.'/'.$request->bidid);
            $buyers = DB::table('buyers')->where('id', $request->buyer_id)->get();
            $profiles = DB::table('profiles')->get();
            $asdfg1 = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('status', 'Completed')->where('id', '<', $request->bidid)->orderBy('id', 'DESC')->pluck('id')->first();
            if($asdfg1)
            {
                $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->where('id', '>', $asdfg1)->get();
            }
            else
            {
                $bidbysellers = DB::table('finalbids')->where('offer_id', $request->seller_id)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->where('id','<=', $request->bidid)->get();
            }
            $users = DB::table('users')->get();
            $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
            $bids = Bid::whereIn('seller_id', $sellersid)->where('buyer_user_id', Auth::user()->id)->get();
            $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
            $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
            $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
            return view('pages/bid/ajaxbidbysellerhistorysingle', ['buyers'=>$buyers,'users'=>$users,'bids'=>$bids,'bidss'=>$bidss,'counterbids'=>$counterbids, 'acceptedbids'=>$acceptedbids, 'bidbysellers'=>$bidbysellers,'profiles'=>$profiles]);
            }
        
    }

    public function acceptbid(Request $request)
    {
        $useller = new Bidaccept;
        $useller->seller_id = $request->sellerid;
        $useller->buyer_user_id = $request->userid;
        $useller->save();
        return redirect()->back()->with('success','Bid Accepted Successfully');
    }

    public function acceptbidbybuyer(Request $request)
    {

        $useller = new Finalbid;
        $useller->seller_id = $request->selleruserid;
        $useller->buyer_id = $request->buyeruserid;
        $useller->offer_id = $request->sellerid;
        $useller->new_price = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('price')->first();
        $useller->new_quantity = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('quantity')->first();
        $useller->new_unit = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('unit')->first();
        $useller->new_perunit = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('perunit')->first();
        $useller->new_currency = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('currency')->first();
        $useller->status = 'Completed';
        $useller->save();
        $notification = 'Bid By Buyer With Offer Id:'.$request->sellerid;
        User::find($request->selleruserid)->notify(new TaskCompleted($notification));
        User::find($request->buyeruserid)->notify(new TaskCompleted($notification));
       // SendNotificationPush('test001','test002');
       $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Bid Accepted Successfully');
    }
    
     

    public function acceptbidbyseller(Request $request)
    {

        $useller = new Finalbid;
        $useller->seller_id = $request->selleruserid;
        $useller->buyer_id = $request->buyeruserid;
        $useller->enquiry_id = $request->buyerid;
        $useller->new_price = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('price')->first();
        $useller->new_quantity = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('quantity')->first();
        $useller->new_unit = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('unit')->first();
        $useller->new_perunit = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('perunit')->first();
        $useller->new_currency = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('currency')->first();
        $useller->status = 'Completed';
        $useller->save();
        $seller_user_id = DB::table('sellers')->where('id', $useller->seller_id)->get()->pluck('created_by')->first();
        $seller_company = DB::table('profiles')->where('user_id', $seller_user_id)->get()->pluck('company_name')->first();
        $product_bidding_for = DB::table('sellers')->where('id', $useller->seller_id)->get()->pluck('product_name')->first();
        $notification = 'Bid By '.$seller_company.' For:'.$product_bidding_for;
        User::find($request->selleruserid)->notify(new TaskCompleted($notification));
        User::find($request->buyeruserid)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Bid Accepted Successfully');
    }

    public function acceptbyseller(Request $request)
    {

        $useller = Finalbid::where('id', $request->id)->first();
        $useller->status = 'Completed';
        $useller->save();
        $seller_company_name = DB::table('profiles')->where('user_id', Auth::user()->id)->get()->pluck('company_name')->first();
        $product_name = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('product_name')->first();
        $notification = 'Bid Accepted By '.$seller_company_name.' For :'.$product_name;
        User::find(1)->notify(new TaskCompleted($notification));
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
      // $this->SendNotificationPush('test001','test002');
       $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Bid Accepted Successfully');
    }

    public function acceptbybuyer(Request $request)
    {

        $useller = Finalbid::where('id', $request->id)->first();
        $useller->status = 'Completed';
        $useller->save();
        $buyer_company_name = DB::table('profiles')->where('user_id', Auth::user()->id)->get()->pluck('company_name')->first();
        $product_name = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('product_name')->first();
        $notification = 'Bid Accepted By '.$buyer_company_name.' For:'.$product_name;
        User::find(1)->notify(new TaskCompleted($notification));
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Bid Accepted Successfully');
    }

    public function declinebyseller(Request $request)
    {

        $useller = Finalbid::where('id', $request->id)->first();
        $useller->status = 'Decline';
        $useller->save();
        $seller_company_name = DB::table('profiles')->where('user_id', $useller->seller_id)->get()->pluck('company_name')->first();
        $product_name = DB::table('sellers')->where('id', $useller->offer_id)->get()->pluck('product_name')->first();
        $notification = 'Bid Decline By '.$seller_company_name.' For :'.$product_name;
        User::find(1)->notify(new TaskCompleted($notification));
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Bid Declined');
    }

    public function declinebybuyer(Request $request)
    {

        $useller = Finalbid::where('id', $request->id)->first();
        $useller->status = 'Decline';
        $useller->save();
        $buyer_company_name = DB::table('profiles')->where('user_id', $useller->buyer_id)->get()->pluck('company_name')->first();
        $product_name = DB::table('buyers')->where('id', $useller->enquiry_id)->get()->pluck('product_name')->first();
        $notification = 'Bid Decline By '.$buyer_company_name.' For:'.$product_name;
        User::find(1)->notify(new TaskCompleted($notification));
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Bid Declined');
    }

    public function acceptbids(Request $request)
    {
        $useller = new Bidaccept;
        $useller->seller_id = $request->sellerid;
        $useller->buyer_user_id = $request->userid;
        $useller->price = $request->price;
        $useller->quantity = $request->quantity;
        $useller->bidid = $request->bidid;
        $useller->save();
        return redirect('/bidacceptance-view')->with('success','Bid Accepted Successfully');
    }

    public function bid(Request $request)
    {
        $useller = new Bid;
        $useller->seller_id = $request->seller_id;
        $useller->buyer_user_id = $request->user_id;
        $useller->new_price = $request->new_price;
        $useller->new_quantity = $request->new_quantity;
        $useller->instruction = $request->instruction;
        $useller->save();
        return redirect()->back()->with('success','Bid Completed Successfully');
    }

    public function start_bidding(Request $request)
    {
        //print_r($request->all()); exit();
        $useller = new Finalbid;
        $useller->offer_id = $request->offer_id;
        $useller->enquiry_id = $request->enquiry_id;
        $useller->seller_id = $request->seller_id;
        $useller->buyer_id = $request->buyer_id;
        $useller->new_currency = $request->new_currency;
        $useller->new_price = $request->new_price;
        $useller->new_perunit = $request->new_perunit;
        $useller->new_quantity = $request->new_quantity;
        $useller->new_unit = $request->new_unit;
        $useller->instruction = $request->instruction;
        $useller->bid_tracker = $request->bid_tracker;
        $useller->created_by = Auth::user()->id;

        if($request->status != '')
        {
            $useller->status = $request->status;
        }else{
            $useller->status = 'Ongoing';
        }        
        $useller->bidtype = 'bid';
        $useller->save();
        if($useller->offer_id == '')
        {
            $product_name = DB::table('buyers')->where('id', $request->enquiry_id)->get()->pluck('product_name')->first();
            $notification = 'Bid For :'.$product_name;
        }
        else
        {
            $product_name = DB::table('sellers')->where('id', $request->offer_id)->get()->pluck('product_name')->first();
            $notification = 'Bid For :'.$product_name;
        }
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        
        return redirect()->back()->with('success','Bid Completed Successfully');
    }
    
    
        public function start_bidding_reject(Request $request)
    {
        //print_r($request->all()); exit();
        $useller = new Finalbid;
        $useller->offer_id = $request->offer_id;
        $useller->enquiry_id = $request->enquiry_id;
        $useller->seller_id = $request->seller_id;
        $useller->buyer_id = $request->buyer_id;
        $useller->new_currency = $request->new_currency;
        $useller->new_price = $request->new_price;
        $useller->new_perunit = $request->new_perunit;
        $useller->new_quantity = $request->new_quantity;
        $useller->new_unit = $request->new_unit;
        $useller->instruction = $request->instruction;
        $useller->bid_tracker = $request->bid_tracker;
        $useller->created_by = Auth::user()->id;

        if($request->status != '')
        {
            $useller->status = $request->status;
        }else{
            $useller->status = 'Ongoing';
        }        
        $useller->bidtype = 'bid';
        $useller->save();
        if($useller->offer_id == '')
        {
            $product_name = DB::table('buyers')->where('id', $request->enquiry_id)->get()->pluck('product_name')->first();
            $notification = 'Bid For :'.$product_name;
        }
        else
        {
            $product_name = DB::table('sellers')->where('id', $request->offer_id)->get()->pluck('product_name')->first();
            $notification = 'Bid For :'.$product_name;
        }
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        
        return redirect()->back();
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

    public function ajax_start_bidding(Request $request)
    {
        $useller = new Finalbid;
        $useller->offer_id = $request->offer_id;
        $useller->enquiry_id = $request->enquiry_id;
        $useller->seller_id = $request->seller_id;
        $useller->buyer_id = $request->buyer_id;
        $useller->new_currency = $request->new_currency;
        $useller->new_price = $request->new_price;
        $useller->new_perunit = $request->new_perunit;
        $useller->new_quantity = $request->new_quantity;
        $useller->new_unit = $request->new_unit;
        $useller->instruction = $request->instruction;
        $useller->created_by = Auth::user()->id;
        $useller->status = 'Ongoing';
        $useller->bidtype = 'bid';
        $useller->save();
        if($useller->offer_id == '')
        {
            $product_name = DB::table('buyers')->where('id', $request->enquiry_id)->get()->pluck('product_name')->first();
            $notification = 'Bid For :'.$product_name;
        }
        else
        {
            $product_name = DB::table('sellers')->where('id', $request->offer_id)->get()->pluck('product_name')->first();
            $notification = 'Bid For :'.$product_name;
        }
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        return response()->json(['success'=>'Bid Successfully Submitted']);
    }

    public function start_counterbidding(Request $request)
    {
        // print_r($request->all()); exit();
        $useller = new Finalbid;
        $useller->offer_id = $request->offer_id;
        $useller->enquiry_id = $request->enquiry_id;
        $useller->seller_id = $request->seller_id;
        $useller->buyer_id = $request->buyer_id;
        $useller->new_currency = $request->new_currency;
        $useller->new_price = $request->new_price;
        $useller->new_perunit = $request->new_perunit;
        $useller->new_quantity = $request->new_quantity;
        $useller->new_unit = $request->new_unit;
        $useller->instruction = $request->instruction;
        $useller->status = 'Ongoing';
        $useller->bidtype = 'counterbid';
        $useller->save();
        if($useller->offer_id == '')
        {
            $product_name = DB::table('buyers')->where('id', $request->enquiry_id)->get()->pluck('product_name')->first();
            $notification = 'Counterbid For :'.$product_name;
        }
        else
        {
            $product_name = DB::table('sellers')->where('id', $request->offer_id)->get()->pluck('product_name')->first();
            $notification = 'Counterbid For :'.$product_name;
        }
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        return redirect()->back()->with('success','Counterbid Completed Successfully');
    }

    public function ajax_start_counterbidding(Request $request)
    {
        // print_r($request->all()); exit();
        $useller = new Finalbid;
        $useller->offer_id = $request->offer_id;
        $useller->enquiry_id = $request->enquiry_id;
        $useller->seller_id = $request->seller_id;
        $useller->buyer_id = $request->buyer_id;
        $useller->new_currency = $request->new_currency;
        $useller->new_price = $request->new_price;
        $useller->new_perunit = $request->new_perunit;
        $useller->new_quantity = $request->new_quantity;
        $useller->new_unit = $request->new_unit;
        $useller->instruction = $request->instruction;
        $useller->bid_tracker = $request->bid_tracker;
        $useller->bid_tracker = $request->bid_tracker;
        $useller->status = 'Ongoing';
        $useller->bidtype = 'counterbid';
        $useller->save();
        if($useller->offer_id == '')
        {
            $product_name = DB::table('buyers')->where('id', $request->enquiry_id)->get()->pluck('product_name')->first();
            $notification = 'Counterbid For :'.$product_name;
        }
        else
        {
            $product_name = DB::table('sellers')->where('id', $request->offer_id)->get()->pluck('product_name')->first();
            $notification = 'Counterbid For :'.$product_name;
        }
        User::find($useller->seller_id)->notify(new TaskCompleted($notification));
        User::find($useller->buyer_id)->notify(new TaskCompleted($notification));
        return $useller;
    }

    public function counterbid(Request $request)
    {
        $useller = new Counterbid;
        $useller->new_price = $request->new_price;
        $useller->new_quantity = $request->new_quantity;
        $useller->bid_id = $request->bid_id;
        $useller->instruction = $request->instruction;
        $useller->save();
        return redirect()->back()->with('success','Counterbid Successfull');
    }

    public function offerbid(Request $request)
    {
        $buyersforbid = DB::table('finalbids')->where('buyer_id', '!=' , Auth::user()->id)->where('offer_id', $request->id)->orderBy('id', 'DESC')->get();
        $sellers = DB::table('sellers')->where('id', $request->id)->get();
        $sellersid = DB::table('sellers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $acceptedbids = Bidaccept::whereIn('seller_id', $sellersid)->get();
        $bids = DB::table('bids')->where('seller_id', $request->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $users = DB::table('users')->get();
        $profiles = DB::table('profiles')->get();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        return view('pages/offerbid', ['sellers'=>$sellers, 'acceptedbids'=>$acceptedbids,'bids'=>$bids,'counterbids'=>$counterbids,'buyersforbid'=>$buyersforbid,'users'=>$users,'profiles'=>$profiles]);
    }

    public function enquirybid(Request $request)
    {
        $sellersforbid = DB::table('finalbids')->where('seller_id', '!=' , Auth::user()->id)->where('enquiry_id', $request->id)->orderBy('id', 'desc')->get();
        $buyers = DB::table('buyers')->where('id', $request->id)->get();
        $buyersid = DB::table('buyers')->where('id', $request->id)->get()->pluck('id')->toArray();
        $acceptedbids = Bidaccept::whereIn('seller_id', $buyersid)->get();
        $bids = DB::table('bids')->where('seller_id', $request->id)->get();
        $bidss = DB::table('bids')->where('seller_id', $request->id)->get()->pluck('id')->toArray();
        $users = DB::table('users')->get();
        $profiles = DB::table('profiles')->get();
        $counterbids = Counterbid::whereIn('bid_id', $bidss)->get();
        return view('pages/enquirybid', ['buyers'=>$buyers, 'acceptedbids'=>$acceptedbids,'bids'=>$bids,'counterbids'=>$counterbids,'sellersforbid'=>$sellersforbid,'users'=>$users,'profiles'=>$profiles]);
    }

    public function singlebid(Request $request)
    {
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->where('id', $request->offer_id)->get();
        $uniquebuyers = DB::table('finalbids')->where('offer_id', $request->offer_id)->where('buyer_id', $request->buyer_id)->get();
        $enquiry = DB::table('buyers')->where('id', $request->enquiry_id)->get();
        $uniquesellers = DB::table('finalbids')->where('enquiry_id', $request->enquiry_id)->where('seller_id', $request->seller_id)->get();
        return view('pages/bid/singlebid',['uniquebuyers'=>$uniquebuyers, 'uniquesellers'=>$uniquesellers, 'users'=>$users, 'offers'=>$offers, 'enquiry'=>$enquiry]);
    }

    public function singlebidbuyer(Request $request)
    {
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->where('id', $request->offer_id)->get();
        $uniquebuyers = DB::table('finalbids')->where('offer_id', $request->offer_id)->where('buyer_id', $request->buyer_id)->get();
        $enquiry = DB::table('buyers')->where('id', $request->enquiry_id)->get();
        $uniquesellers = DB::table('finalbids')->where('enquiry_id', $request->enquiry_id)->where('seller_id', $request->seller_id)->get();
        return view('pages/bid/singlebid',['uniquebuyers'=>$uniquebuyers, 'uniquesellers'=>$uniquesellers, 'users'=>$users, 'offers'=>$offers, 'enquiry'=>$enquiry]);
    }

    public function ongoingbid()
    {
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('buyer_id', Auth::user()->id)->get();
        $bidonenquiries = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', Auth::user()->id)->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->get();
        $profiles = DB::table('profiles')->get();

// Added by Ajay: Trial count of Buyer & Seller

       $buyerSellerTrialCount = DB::select("SELECT finalbids.seller_id, finalbids.buyer_id, buyers.product_name, count(*) as trial_count FROM finalbids 
            left join buyers
            on buyers.id = finalbids.enquiry_id
            where finalbids.status='completed' group by finalbids.seller_id, finalbids.buyer_id, finalbids.enquiry_id;
            ");

        foreach ($buyerSellerTrialCount as $key => $value) {
            $sellerData = User::find($value->seller_id);
            $sellerUserName = $sellerData->name;
            $buyerData = User::find($value->seller_id);
            $buyerUserName = $buyerData->name;

            $buyerSellerTrialCount[$key]->seller_name = $sellerUserName;
            $buyerSellerTrialCount[$key]->buyer_name = $buyerUserName;
        }

        return view('pages/bid/ongoingbid',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries, "buyerSellerTrialCount" => $buyerSellerTrialCount]);
    }

    public function counterbidbyseller(Request $request ,$offer_id,$seller_user_id,$buyer_user_id)
    {
        // dd("dd");

        $sellers = DB::select("SELECT * FROM vyapaarn_etwork2.sellers where created_by = " . "'" . $seller_user_id . "'" . ";");

        $users = DB::table('users')->get();
        $profiles = DB::table('profiles')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        // dd($myoffers);
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', $request->seller_user_id)->where('buyer_id', Auth::user()->id)->get();
        $bidonenquiries = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', Auth::user()->id)->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('seller_id', $seller_user_id)->where('buyer_id', $buyer_user_id)->get();
        
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->get();

        // dd($sellers);

        return view('pages/bid/counterbidbyseller', ['sellers'=>$sellers, 'users'=>$users, 'bidonmyoffers'=>$bidonmyoffers,'profiles'=>$profiles]);
    }

    public function ajaxcounterbid(Request $request ,$offer_id,$seller_user_id,$buyer_user_id)
    {
        // dd("dd");

        $sellers = DB::select("SELECT * FROM vyapaarn_etwork2.sellers where created_by = " . "'" . $seller_user_id . "'" . ";");

        $users = DB::table('users')->get();
        $profiles = DB::table('profiles')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        // dd($myoffers);
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', $request->seller_user_id)->where('buyer_id', Auth::user()->id)->get();
        $bidonenquiries = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', Auth::user()->id)->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('seller_id', $seller_user_id)->where('buyer_id', $buyer_user_id)->get();
        
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->get();

        // dd($sellers);

        return view('ajaxcounterbid', ['sellers'=>$sellers, 'users'=>$users, 'bidonmyoffers'=>$bidonmyoffers,'profiles'=>$profiles, 'buyer_user_id'=>$request->buyer_user_id]);
    }

    public function ajaxcounterbidbybuyer(Request $request,$seller_id,$buyer_user_id,$seller_user_id)
    {
        // dd($buyer_user_id);

        $buyers = DB::select("SELECT * FROM vyapaarn_etwork2.buyers where created_by = " . "'" . $buyer_user_id . "'" . ";");

        // $buyers = DB::table('buyers')->get();
        $users = DB::table('users')->get();
        $profiles = DB::table('profiles')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('buyer_id', Auth::user()->id)->get();
        $bidonenquiries = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', Auth::user()->id)->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('seller_id', $request->seller_user_id)->get();
       
       
        return view('ajaxcounterbidbybuyer', ['buyers'=>$buyers, 'users'=>$users, 'bidonmyenquiries'=>$bidonmyenquiries,'profiles'=>$profiles, 'seller_user_id'=>$seller_user_id]);
    }

    public function counterbidbybuyer(Request $request,$seller_id,$buyer_user_id,$seller_user_id)
    {
        // dd($buyer_user_id);

        $buyers = DB::select("SELECT * FROM vyapaarn_etwork2.buyers where created_by = " . "'" . $buyer_user_id . "'" . ";");

        // $buyers = DB::table('buyers')->get();
        $users = DB::table('users')->get();
        $profiles = DB::table('profiles')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('buyer_id', Auth::user()->id)->get();
        $bidonenquiries = DB::table('finalbids')->where('created_by', Auth::user()->id)->where('seller_id', Auth::user()->id)->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('seller_id', $request->seller_user_id)->where('buyer_id', $request->buyer_user_id)->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('seller_id', $request->seller_user_id)->get();
       
       
        return view('pages/bid/counterbidbybuyer', ['buyers'=>$buyers, 'users'=>$users, 'bidonmyenquiries'=>$bidonmyenquiries,'profiles'=>$profiles]);
    }

    public function newOngoingBid()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->orderBy('favorite_enquiry', 'desc')->orderBy('id', 'desc')->get()->unique('bid_tracker');
        
         $bidonalldata = DB::table('finalbids')->orderBy('id', 'desc')->take(5)->get();
         //dd($bidonalldata);
        // exit();
         
          //$bidonalldata = DB::table('finalbids')->where('buyer_id', Auth::user()->id || 'offer_id', $myoffers || 'seller_id', Auth::user()->id || 'enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
         // dd($bidonalldata);$bidonenquiries
        //  exit();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $profiles = DB::table('profiles')->get();
        // dd($bidonoffers);

        return view('pages/bid/new_ongoingbid',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }
    
         public function adminOngoingBid()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonenquiries = DB::table('finalbids')->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $profiles = DB::table('profiles')->get();
        // dd($bidonoffers);

        return view('admin/admin_ongoingbid',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }



    public function newAcceptedBid()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->get();
       // $bidoverall = DB::table('finalbids')->where('status', 'Completed')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->get();
        $profiles = DB::table('profiles')->get();
        // dd($bidonoffers);
         //exit();

        return view('pages/bid/new_acceptedbid',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }

    public function newRejectedBid()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Decline')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Decline')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Decline')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Decline')->get();
        $profiles = DB::table('profiles')->get();

        return view('pages/bid/new_rejectedbid',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }

    public function newAcceptedBidApproved()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $profiles = DB::table('profiles')->get();
         //dd($bidonmyoffers);
//exit();
        return view('pages/bid/new_acceptedbid_approved',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }
    
    /*New function created by shreemant*/
      public function adminBidApproved()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $profiles = DB::table('profiles')->get();
       //  dd($bidonenquiries);
        //exit();

        return view('pages/bid/admin_bid_approved',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }
    /*End of the function*/
    
     /*New function created by shreemant*/
      public function orderBookSeller()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $profiles = DB::table('profiles')->get();
       //  dd($bidonenquiries);
        //exit();

        return view('pages/bid/order_book_seller',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }
    /*End of the function*/
    
    
     /*New function created by shreemant*/
      public function orderBookBuyer()
    {   
        $finalbids = DB::table('finalbids')->get();
        $users = DB::table('users')->get();
        $offers = DB::table('sellers')->get();
        $enquiries = DB::table('buyers')->get();
        $myoffers = DB::table('sellers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $myenquiries = DB::table('buyers')->where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
        $bidonoffers = DB::table('finalbids')->where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyoffers = Finalbid::whereIn('offer_id', $myoffers)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $bidonmyenquiries = Finalbid::whereIn('enquiry_id', $myenquiries)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
        $profiles = DB::table('profiles')->get();
       //  dd($bidonenquiries);
        //exit();

        return view('pages/bid/order_book_buyer',['finalbids'=>$finalbids, 'users'=>$users, 'profiles'=>$profiles, 'offers'=>$offers, 'enquiries'=>$enquiries, 'bidonmyoffers'=>$bidonmyoffers, 'bidonmyenquiries'=>$bidonmyenquiries, 'bidonoffers'=>$bidonoffers, 'bidonenquiries'=>$bidonenquiries]);
    }
    /*End of the function*/

    public function newAcceptedBidApprovedDetails(Request $request)
    {   
        $finalbids = DB::table('finalbids')->where('id', $request->id)->get();
        return view('pages/bid/new_acceptedbid_approved_details',['finalbids'=>$finalbids]);
    }

    public function uploadDocumentsSeller(Request $request)
    {   
        $finalbids = DB::table('finalbids')->where('id', $request->id)->get();
        $uploaded_documents = DB::table('uploaddocs')->get();
        return view('pages/bid/upload_documents_seller',['finalbids'=>$finalbids, 'uploaded_documents'=>$uploaded_documents]);
    }

    public function uploadDocumentsBuyer(Request $request)
    {   
        $finalbids = DB::table('finalbids')->where('id', $request->id)->get();
        $uploaded_documents = DB::table('uploaddocs')->get();
        return view('pages/bid/upload_documents_buyer',['finalbids'=>$finalbids, 'uploaded_documents'=>$uploaded_documents]);
    }

    public function uploadDocBuyer(Request $request)
    {   
        $bid_id_exist = Uploaddoc::where('bid_id', $request->bid_id)->get()->first();
        if($bid_id_exist)
        {
            $useller = $bid_id_exist;
        }
        else
        {
            $useller = new Uploaddoc;
        }  
        $useller->bid_id = $request->bid_id;
        $useller->purchase_date = $request->purchase_date;
        $useller->purchase_order_no = $request->purchase_order_no;
        $useller->purchase_order_date = $request->purchase_order_date;
        if($request->hasfile('purchase_order_slip'))
        {
        $image1 = $request->file('purchase_order_slip');
        $name1 = time().'_'.$image1->getClientOriginalName();
        $image1->move(public_path().'/imageupload/purchase_order_slip', $name1);
        }
        $useller->purchase_order_slip = $name1;
        $useller->save();
        return redirect()->back()->with('success','Document Uploaded');
    }

    public function uploadDocSeller(Request $request)
    {   
        $bid_id_exist = Uploaddoc::where('bid_id', $request->bid_id)->get()->first();
        if($bid_id_exist)
        {
            $useller = $bid_id_exist;
        }
        else
        {
            $useller = new Uploaddoc;
        }        
        $useller->bid_id = $request->bid_id;
        $useller->sale_date = $request->sale_date;
        $useller->delivery_date = $request->delivery_date;
        if($request->hasfile('acknowledgement'))
        {
        $image1 = $request->file('acknowledgement');
        $name1 = time().'_'.$image1->getClientOriginalName();
        $image1->move(public_path().'/imageupload/purchase_order_slip', $name1);
        }        
        $useller->quantity = $request->quantity;
        $useller->amount = $request->amount;
        $useller->lr_no = $request->lr_no;
        $useller->acknowledgement = $name1;
        $useller->save();
        return redirect()->back()->with('success','Document Uploaded');
    }
    
    public function onChangedFavoriteEnquiry(Request $request){
        $finalBid = Finalbid::find($request->get('enquiry_id'));
        $finalBid->favorite_enquiry = $request->get('status');
        $finalBid->save();
        $bidonenquiries = DB::table('finalbids')->where('seller_id', Auth::user()->id)->orderBy('favorite_enquiry', 'desc')->orderBy('id', 'desc')->get()->unique('bid_tracker');
        $allEnquiryBids = [];
        foreach($bidonenquiries as $allbids){
            $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();                   
            $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first();
            $otherenquiry_to_date = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('to_date')->first();
            $oestart = \Carbon\Carbon::now();
            $oeend = \Carbon\Carbon::parse($otherenquiry_to_date);
            $oedurationd = $oeend->diffInDays($oestart);
            $oedurationh = $oeend->diffInHours($oestart)-($oedurationd*24);
            $oedurationm = $oeend->diffInMinutes($oestart)-($oeend->diffInHours($oestart)*60);
            $oedurations = $oeend->diffInSeconds($oestart)-($oeend->diffInMinutes($oestart)*60);
            $oesecondleft = $oeend->diffInSeconds($oestart);
            $oeturn = \App\Finalbid::where('seller_id', $allbids->seller_id)->where('enquiry_id', $allbids->enquiry_id)->orderBy('id', 'DESC')->pluck('bidtype')->first();
            $allEnquiryBid['product_name'] = $product_name;
            $allEnquiryBid['seller_name'] = $seller_name;
            $allEnquiryBid['otherenquiry_to_date'] = $otherenquiry_to_date;
            $allEnquiryBid['oestart'] = $oestart;
            $allEnquiryBid['oeend'] = $oeend;
            $allEnquiryBid['oedurationd'] = $oedurationd;
            $allEnquiryBid['oedurationh'] = $oedurationh;
            $allEnquiryBid['oedurationm'] = $oedurationm;
            $allEnquiryBid['oedurations'] = $oedurations;
            $allEnquiryBid['oesecondleft'] = $oesecondleft;
            $allEnquiryBid['oeturn'] = $oeturn;
            $allEnquiryBid['id'] = $allbids->id;
            $allEnquiryBid['created_at'] = $allbids->created_at;
            $allEnquiryBid['status'] = $allbids->status;
            $allEnquiryBid['enquiry_id'] = $allbids->enquiry_id;
            $allEnquiryBid['buyer_id'] = $allbids->buyer_id;
            $allEnquiryBid['seller_id'] = $allbids->seller_id;
            $allEnquiryBid['favorite_enquiry'] = $allbids->favorite_enquiry;
            array_push($allEnquiryBids,$allEnquiryBid);
        }
        return $allEnquiryBids;
    }
}
