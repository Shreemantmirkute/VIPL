<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Subproduct;
use App\Seller;
use App\Buyer;
use App\User;
use DB;
use App\Item;
use Auth;
use Illuminate\Support\Facades\Response;

use Notification;
use App\Notifications\TaskCompleted;

class ProductController extends Controller
{
    public function add_product()
    {
        $categories = DB::table('categories');
        $products = DB::table('products');
        $subproducts = DB::table('subproducts');
        $items = DB::table('items');
        $productname = DB::table('items')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();
        $availableproducts = Product::wherenotIn('name', $productname)->get();
        $items = $items->get();
        $products = $products->get();
        $subproducts = $subproducts->get();
        $categories = $categories->get();
        $businesstypes = DB::table('businesstypes')->get();
        $units = DB::table('units')->get();
        $currencies = DB::table('currencies')->get();
        $profiles = DB::table('profiles')->where('user_id', Auth::user()->id)->get();
        return view('pages/add_product',['products'=>$products ,'businesstypes'=>$businesstypes,'units'=>$units ,'profiles'=>$profiles, 'categories'=>$categories, 'subproducts'=>$subproducts, 'items'=>$items, 'availableproducts'=>$availableproducts, 'currencies'=>$currencies ]);
    }

    public function bproduct_details()
    {
        
        $items = DB::table('items');
        $productname = DB::table('items')->where('created_by', Auth::user()->id)->where('register_as', 'Seller')->get()->pluck('product')->toArray();
        $availableproducts = Buyer::whereIn('product_name', $productname)->get();
        $alusers = DB::table('users')->get();
        $alprofiles = DB::table('profiles')->get();
        return view('pages/bproduct_details',['availableproducts'=>$availableproducts, 'alusers'=>$alusers, 'alprofiles'=>$alprofiles ]);
    }

    public function sproduct_details()
    {
        $items = DB::table('items');
        $productname = DB::table('items')->where('created_by', Auth::user()->id)->where('register_as', 'Buyer')->get()->pluck('product')->toArray();
        $availableproducts = Seller::whereIn('product_name', $productname)->get();
        $alusers = DB::table('users')->get();
        $alprofiles = DB::table('profiles')->get();

        return view('pages/sproduct_details',['availableproducts'=>$availableproducts, 'alusers'=>$alusers, 'alprofiles'=>$alprofiles ]);
    }

    public function add_category()
    {
        return view('pages/add_category');
    }

    public function create_product (Request $request)
    {
        $validateData = $request->validate([
            'product_desc'     => 'required|max:150',
        ]);
        Product::create($request->all());
        $notification = 'New Product Added:'.$request->input('name');
        $users = User::where('id','>',1)->get();
        Notification::send($users, new TaskCompleted($notification));
        return redirect('/admin/product')->with('success','Product created successfully');
    }

    public function create_subproduct (Request $request)
    {
        Subproduct::create($request->all());
        $notification = 'New Subproduct Added:'.$request->input('subproduct_code');
        $users = User::where('id','>',1)->get();
        Notification::send($users, new TaskCompleted($notification));
        return redirect('/admin/subproduct')->with('success','Subproduct created successfully');
    }

    public function delete_product (Request $request)
    {
        $prodname = DB::table('products')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('subproducts')->where('product', $prodname)->count();
        if($count == 0){
        DB::table('products')->where('id', $request->id)->delete();
        return redirect('/admin/product')->with('successdeleted','Product deleted successfully');
        }
        else{
            return redirect('/admin/product')->with('faildeleted','Product has associated sub product');
        }
    }

    public function delete_subproduct (Request $request)
    {
        $prodname = DB::table('subproducts')->where('id', $request->id)->pluck('subproduct_code')->first();
        $count = DB::table('items')->where('product', $prodname)->count();
        if($count == 0){
        DB::table('subproducts')->where('id', $request->id)->delete();
        return redirect('/admin/subproduct')->with('success1','Subproduct deleted successfully');
        }
        else{
            return redirect('/admin/subproduct')->with('fail1','Subproduct is active in multiple bids');
        }
    }

    public function update_product (Request $request)
    {
        $uproduct = Product::where('id', $request->input('id'))->first();
        $uproduct->category = $request->input('category');
        $uproduct->product_status = $request->input('product_status');
        $uproduct->product_code = $request->input('product_code');
        $uproduct->name = $request->input('name');
        $uproduct->product_desc = $request->input('product_desc');
        $uproduct->save();
        return redirect('admin/product')->with('success','Product updated successfully');
    }

    public function update_subproduct (Request $request)
    {
        $uproduct = Product::where('id', $request->input('id'))->first();
        $uproduct->category = $request->input('category');
        $uproduct->product_status = $request->input('product_status');
        $uproduct->product_code = $request->input('product_code');
        $uproduct->name = $request->input('name');
        $uproduct->product_desc = $request->input('product_desc');
        $uproduct->save();
        return redirect('admin/product')->with('success','Product updated successfully');
    }

    public function activate_product(Request $request)
    {
        DB::table('products')->where('id', $request->id)->update(['product_status' => 'Active']);
        return redirect('/admin/product')->with('success1','Product activated successfully');
    }

    public function deactivate_product(Request $request)
    {
        $prodname = DB::table('products')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('subproducts')->where('product', $prodname)->count();
        if($count == 0){
        DB::table('products')->where('id', $request->id)->update(['product_status' => 'Deactive']);
        return redirect('/admin/product')->with('fail1','Product deactivated successfully');
        }
        else{
            return redirect('/admin/product')->with('faildeleted','Product has associated sub product');
        }
    }

    public function activate_subproduct(Request $request)
    {
        DB::table('subproducts')->where('id', $request->id)->update(['status' => 'Active']);
        return redirect('/admin/subproduct')->with('success1','Subproduct activated successfully');
    }

    public function deactivate_subproduct(Request $request)
    {
        $prodname = DB::table('subproducts')->where('id', $request->id)->pluck('subproduct_code')->first();
        $count = DB::table('items')->where('product', $prodname)->count();
        if($count == 0){
        DB::table('subproducts')->where('id', $request->id)->update(['status' => 'Deactive']);
        return redirect('/admin/subproduct')->with('fail1','Subproduct deactivated successfully');
        }
        else
        {
           return redirect('/admin/subproduct')->with('fail1','Subproduct is active in multiple bids'); 
        }
    }

    public function activate_category(Request $request)
    {
        DB::table('categories')->where('id', $request->id)->update(['status' => 'Active']);
        return redirect('/admin/category')->with('success1','Category activated successfully');
    }

    public function deactivate_category(Request $request)
    {
        $catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){
        DB::table('categories')->where('id', $request->id)->update(['status' => 'Deactive']);
        return redirect('/admin/category')->with('fail1','Category deactivated successfully');
        }
        else
        {
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }
    }

    public function ajax(Request $request)
    {
        $productname = DB::table('items')->where('created_by', Auth::user()->id)->pluck('product');
        $name = $_GET['cid'];
        $cities = Product::wherenotIn('name', $productname)->where('category', $name)->get()->pluck('name');
        return Response::json($cities);
    }

    public function allajax(Request $request)
    {
        $name = $_GET['cid'];
        $cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($cities);
    }

    public function allmyajax(Request $request)
    {
        $name = $_GET['cid'];
        $myproduct = Item::where('created_by', Auth::user()->id)->pluck('product')->toArray();
        $cities = Subproduct::where('product', $name)->wherenotIn('subproduct_code', $myproduct)->get()->pluck('subproduct_code');
        return Response::json($cities);
    }

    public function allemail(Request $request)
    {
        $name = $_GET['cid'];
        $mydata = User::where('email', $name)->get()->count();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }

    public function allphone(Request $request)
    {
        $name = $_GET['cid'];
        $mydata = User::where('phone', $name)->get()->count();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }

    public function allsubcatajax(Request $request)
    {
        $name = $_GET['cid'];
        $cities = Product::where('category', $name)->get()->pluck('name');
        return Response::json($cities);
    }

    public function allcatajax()
    {
        $cities = Category::where('name', '!=', 'MtalandgfghjMinerals')->get()->pluck('name');
        return Response::json($cities);
    }
}
