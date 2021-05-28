<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = DB::table('blogs')->get();
        return view('blog', ['blogs'=>$blogs]);
    }

    public function complete_blog(Request $request)
    {
        $blogs = DB::table('blogs')->where('id', $request->id)->get();
        return view('complete_blog', ['blogs'=>$blogs]);
    }

    public function add_blog_view (Request $request)
    {
        $blogs = DB::table('blogs')->get();
        return view('admin/add-blog', ['blogs'=>$blogs]);
    }

    public function add_blog_view_filter (Request $request)
    {
        $blogs = DB::table('blogs')->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        return view('admin/add-blog', ['blogs'=>$blogs]);
    }

    public function add_blog_view_search (Request $request)
    {
        $query = $request->get('search');
        $blogs = DB::table('blogs')->where('title', 'LIKE', "%{$query}%")->get();
        return view('admin/add-blog', ['blogs'=>$blogs]);
    }

    public function add_blog(Request $request)
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
               
        $Upload_model = new Blog;
        $Upload_model->image = json_encode($data);
        $Upload_model->title = $request->input('title');
        $Upload_model->description = $request->input('description');
        $Upload_model->link = $request->input('link');
        $Upload_model->save();

        return redirect('admin/add-blog');
    }
}
