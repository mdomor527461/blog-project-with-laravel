<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(2);
        return view('frontend.blogs.index',compact('blogs'));
    }
    public function single_blog($id){
        $blog = Blog::where('id',$id)->first();
        $comments = BlogComment::with('replies')->where('blog_id',$id)->whereNull('parent_id')->get();
        return view('frontend.blogs.single',compact('blog','comments'));
    }
    public function comment(Request $request,$id){
        BlogComment::create([
            "user_id" => Auth::user()->id,
            "blog_id" => $id,
            "parent_id" => $request->parent_id,
            "name" => $request->name,
            "email" => $request->email,
            "comment" => $request->comment,
            "created_at" => now()
        ]);
        return back();
    }
}
