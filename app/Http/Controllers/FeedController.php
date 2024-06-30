<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller{

    public function index(){
        $feeds = Feed::all();
        return view('frontend.feeds.feed', compact('feeds'));
    }

    public function add(){
        return view('group.addFeed');
    }
    public function create(Request $request){
        $feed = new Feed();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('assets/uploads/feeds',$fileName);
            $feed->image = $fileName;
        }
        $feed->heading = $request->heading;
        $feed->short_description = $request->short_description;
        $feed->long_description = $request->long_description;
        $feed->save();
        return redirect()->back();
    }
    public function details($id){
        $feed = Feed::find($id);
        return view('frontend.feeds.details', compact('feed'));
    }

}


?>