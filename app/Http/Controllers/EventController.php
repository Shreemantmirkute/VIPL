<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use DB;

class EventController extends Controller
{
    public function index()
    {
        $events = DB::table('events')->get();
        return view('event', ['events'=>$events]);
    }

    public function complete_event(Request $request)
    {
        $events = DB::table('events')->where('id', $request->id)->get();
        return view('complete_event', ['events'=>$events]);
    }

    public function add_event_view (Request $request)
    {
        $events = DB::table('events')->get();
        return view('admin/add-event', ['events'=>$events]);
    }

    public function add_event_view_filter (Request $request)
    {
        $events = DB::table('events')->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        return view('admin/add-event', ['events'=>$events]);
    }

    public function add_event_view_search (Request $request)
    {
        $query = $request->get('search');
        $events = DB::table('events')->where('title', 'LIKE', "%{$query}%")->get();
        return view('admin/add-event', ['events'=>$events]);
    }

    public function add_event(Request $request)
    {
        $this->validate($request, [
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);
        
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $name=time().'_'.$image->getClientOriginalName();
                $image->move(public_path().'/imageupload/event', $name);  // your folder path
                $data[] = $name;  
            }
        }
        else{
            $data[] = 'unnamed.jpg';
        }       
        $Upload_model = new Event;
        $Upload_model->image = json_encode($data);
        $Upload_model->title = $request->input('title');
        $Upload_model->description = $request->input('description');
        $Upload_model->link = $request->input('link');
        $Upload_model->save();

        return redirect('admin/add-event');
    }
}
