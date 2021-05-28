<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table('news')->get();
        return view('news', ['news'=>$news]);
    }

    public function complete_news(Request $request)
    {
        $news = DB::table('news')->where('id', $request->id)->get();
        return view('complete_news', ['news'=>$news]);
    }

    public function add_news_view (Request $request)
    {
        $news = DB::table('news')->get();
        return view('admin/add-news', ['news'=>$news]);
    }

    public function add_news_view_filter (Request $request)
    {
        $news = DB::table('news')->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        return view('admin/add-news', ['news'=>$news]);
    }

    public function add_news_view_search (Request $request)
    {
        $query = $request->get('search');
        $news = DB::table('news')->where('title', 'LIKE', "%{$query}%")->get();
        return view('admin/add-news', ['news'=>$news]);
    }

    public function add_news(Request $request)
    {
        $this->validate($request, [
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'file.*' => 'pdf|mimes:pdf|max:1024'
        ]);
        
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name=time().'_'.$image->getClientOriginalName();
                $image->move(public_path().'/imageupload/news', $name);  // your folder path
                $data[] = $name;  
            }
        }
        else{
            $data[] = 'unnamed.jpg';
        }

        if($request->hasfile('pdf'))
        {
            foreach($request->file('pdf') as $pdf)
            {
                $name=time().'_'.$pdf->getClientOriginalName();
                $pdf->move(public_path().'/pdfupload/news', $name);  // your folder path
                $data1[] = $name;  
            }
        }

        $Upload_model = new News;
        $Upload_model->image = json_encode($data);
        $Upload_model->pdf = json_encode($data1);
        $Upload_model->title = $request->input('title');
        $Upload_model->description = $request->input('description');
        $Upload_model->link = $request->input('link');
        $Upload_model->save();

        return redirect('admin/add-news');
    }

}
