<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
class CatBlogController extends Controller
{
    public function show($slug){
        $category = Category::where('slug',$slug)->first();
         $blogs = Blog::where('category_id',$category->id)->latest()->paginate(1);

         return view('frontend.category.index',compact('category','blogs'));
     }
}
