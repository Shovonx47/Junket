<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return view('frontend.blogs.blogs', compact('blogs'));
    }
    public function add(){
        return view('group.addBlog');
    }
    public function create(Request $request){
        $blog = new Blog();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('assets/uploads/blogs',$fileName);
            $blog->image = $fileName;
        }
        $blog->heading = $request->heading;
        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;
        $blog->save();
        return redirect()->back();
    }
    public function details($id){
        $blog = Blog::find($id);
        return view('frontend.blogs.details', compact('blog'));
    }
}