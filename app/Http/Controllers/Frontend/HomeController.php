<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status','active')->latest()->get();
        $blogs = Blog::where('status','active')->limit(3)->get();
        return view('frontend.home.index',compact('categories','blogs'));

    }
    public function about(){
        return view('frontend.home.about');
    }
    public function contact(){
        return view('frontend.home.contact');
    }
}
