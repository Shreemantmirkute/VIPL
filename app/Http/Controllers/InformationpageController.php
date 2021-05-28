<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Informationpage;
use DB;

class InformationpageController extends Controller
{
  public function create_informationpage (Request $request)
    {
    	$this->validate($request, [
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);
        
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name=time().'_'.$image->getClientOriginalName();
                $image->move(public_path().'/imageupload/blog', $name);  // your folder path
                $data[] = $name;  
            }
        } 
        else{
            $data[] = 'unnamed.jpg';
        }
               
        $Upload_model = new Informationpage;
        $Upload_model->image = json_encode($data);
        $Upload_model->title = $request->input('title');
        $Upload_model->description = $request->input('description');
        $Upload_model->link = $request->input('link');
        $Upload_model->save();

    	return redirect()->back()->with('success','Page created successfully');
    }
    public function view_informationpage (Request $request)
    {
    	$informationpages = DB::table('informationpages')->get();
    	return view('/admin/informationpage',['informationpages'=>$informationpages]);
    }
    public function delete_informationpage (Request $request)
    {
        /*$catname = DB::table('categories')->where('id', $request->id)->pluck('name')->first();
        $count = DB::table('products')->where('category', $catname)->count();
        if($count == 0){*/
        DB::table('informationpages')->where('id', $request->id)->delete();
        return redirect()->back()->with('successdeleted','Page deleted successfully');
       /* }
        else{
            return redirect('/admin/category')->with('faildeleted','Category has associated products');
        }*/
    }
    public function allinformationpage()
    {
        $mydata = DB::table('informationpages')->where('title', '!=', 'MtalandgfghjMinerals')->get();
        //$cities = Subproduct::where('product', $name)->get()->pluck('subproduct_code');
        return Response::json($mydata);
    }  
    public function view_about (Request $request)
    {
    	// $name = $_GET['title'];
    	$informationpages = DB::table('informationpages')->where('title','About Us')->get();
    	return view('about',['informationpages'=>$informationpages]);
    } 
     public function view_info (Request $request)
    {
    	// $name = $_GET['title'];
    	$informationpages = DB::table('informationpages')->where('link',$request->slug)->get();
    	return view('information',['informationpages'=>$informationpages]);
    } 
}
