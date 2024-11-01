<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(2);
        return view('dashboard.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());

        $request->validate([
            'category_id' => 'required',
            'thumbnail' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $newname = Auth::user()->id .'-'.Str::random(4).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/'.$newname));

            if($request->slug){
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Created Complete.');
            }else{
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Created Complete.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {    $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $manager = new ImageManager(new Driver());

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $newname = Auth::user()->id .'-'.Str::random(4).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/'.$newname));

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Complete.');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Complete.');
            }
        }else{

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Complete.');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Complete.');
            }

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::where('id',$id)->first();
        if($blog->thumbnail){
            $oldpath = base_path('public/uploads/blog/'.$blog->thumbnail);
            if(file_exists($oldpath)){
                unlink($oldpath);
            }
        }

        Blog::find($blog->id)->delete();
        return redirect()->route('blog.index')->with('success','Blog Delete Successfull');
    }
    public function status($slug){
        $blog = Blog::where('slug',$slug)->first();

        if($blog->status == 'active'){
            Blog::find($blog->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return redirect()->route('blog.index')->with('success','blog status updated successfully');
        }
        else{
            Blog::find($blog->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return redirect()->route('blog.index')->with('success','blog status updates successfully');
        }

    }
}
