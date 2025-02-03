<?php

namespace App\Http\Controllers\backend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backend\BlogController;

class BlogController extends Controller
{
    public function blog_post(){
        return view('layouts.Backend.CreatePost');
    }
    public function store_post(Request $request){
        // dd($request);
        $request->validate([
            'title'=>'required',
            'details'=>'required'
        ]);

        //insert data
        $blog = new Post();
        $blog->title = $request->title;
        $blog->details = $request->details;
        $blog->added_by = Auth::user()->name;
        $blog->save();
        return back()->with('success','Your blog post submitted successfully');

    }
    public function all_post(){
        $posts = Post::all();
        //dd($posts);
        return view('layouts.Backend.allpost',compact('posts'));
    }
}
