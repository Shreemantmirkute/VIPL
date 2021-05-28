<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DB;
use App\Product;
use Auth;

use Illuminate\Notifications\Notification;
use App\User;
use App\Notifications\TaskCompleted;

class ItemController extends Controller
{
    public function add_item (Request $request)
    {
        Item::where('product', $request->product)->first();
        
        $query = "select * from items where product = "."'".$request->product."'"." AND register_as = "."'".$request->register_as."'"." AND subcategory = "."'".$request->subcategory."'"." AND currency = "."'".$request->currency."'"." AND  category = "."'".$request->category."'"." AND  comission = "."'".$request->comission."'"." AND perunit = "."'".$request->perunit."';";

        $flag = DB::select($query);
        if (count($flag) > 0) {
            
        return redirect()->back()->with('warning','Product already exists!');
        }


    	$validateData = $request->validate([
    	]);
        
    	Item::create($request->all());
    	$items = DB::table('items');
    	$categories = DB::table('categories');
    	$products = DB::table('products');

        $productname = DB::table('items')->get()->pluck('product')->toArray();
        $availableproducts = Product::wherenotIn('name', $productname)->get();

        $items = $items->get();
        $products = $products->get();
        $categories = $categories->get();
        //return redirect()->back()->with('success','Product added successfully.');
        $notification = 'New Product Added:'.$request->input('product');
        
        User::find(Auth::user()->id)->notify(new TaskCompleted($notification));
        
        $this->SendNotificationPush($notification);
        
        return redirect('/add_product')->with('success','Product added successfully.');
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
        //dd($data);
        
        $dataString = json_encode($data);
    //dd($dataString);
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
    public function add_item_view (Request $request)
    {
    	$items = DB::table('items');
    	$categories = DB::table('categories');
    	$products = DB::table('products');

        $productname = DB::table('items')->get()->pluck('product')->toArray();
        $availableproducts = Product::wherenotIn('name', $productname)->get();

        $items = $items->get();
        $products = $products->get();
        $categories = $categories->get();

        return view('pages/add_product',['products'=>$products , 'categories'=>$categories, 'items'=>$items, 'availableproducts'=>$availableproducts ]);
    }
    public function delete_item (Request $request)
    {
        DB::table('items')->where('id', $request->id)->delete();
        return redirect('/add_product')->with('success1','Product deleted successfully');
    }
    public function admin_delete_item (Request $request)
    {
        DB::table('items')->where('id', $request->id)->delete();
        return redirect('/admin/admin-product')->with('fail','Product deleted successfully');
    }
    public function update_item (Request $request)
    {
        $uitem = Item::where('id', $request->input('id'))->first();
        $uitem->price = $request->input('price');
        $uitem->quantity = $request->input('quantity');
        $uitem->origin = $request->input('origin');
        $uitem->chemicalspecification = $request->input('chemicalspecification');
        $uitem->physicalspecification = $request->input('physicalspecification');
        $uitem->save();
        return redirect('/add_product')->with('success','Product updated successfully');
    }
    public function admin_update_item (Request $request)
    { 
        $uitem = Item::where('id', $request->input('id'))->first();
        $uitem->comission = $request->input('comission');
        $uitem->perunit = $request->input('perunit');
        $uitem->save();
        return redirect('/admin/admin-product')->with('success','Product updated successfully');
    }
    public function admin_reject_item (Request $request)
    { 
        $uitem = Item::where('id', $request->input('id'))->first();
        $uitem->rejectionreason = $request->input('rejectionreason');
        $uitem->status = 'Rejected';
        $uitem->save();
        return redirect('/admin/admin-product')->with('success','Product rejected successfully');
    }
}
