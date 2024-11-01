<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());

        $request->validate([
            'title' => 'required',
            'image' => "required|image",
        ]);

        if($request->hasFile('image')){
            $newname = auth()->user()->id .'-'. $request->title .'-'. rand(1111,9999) .'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'.$newname));


            if($request->slug){

                Category::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $newname,
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category Insert Successfull');
            }else{
                Category::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $newname,
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category Insert Successfull');
            }


        }

    }
    //edit
    public function edit($slug){
        $category = Category::where('slug',$slug)->first();
        return view('dashboard.category.edit',compact('category'));
    }
    //update
    public function update(Request $request ,$slug){
        $manager = new ImageManager(new Driver());
        $category = Category::where('slug',$slug)->first();


        if($request->hasFile('image')){

            if($category->image){
                $oldpath = base_path('public/uploads/category/'.$category->image);
                if(file_exists($oldpath)){
                    unlink($oldpath);
                }
            }

            $newname = auth()->user()->id .'-'. $request->title .'-'. rand(1111,9999) .'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'.$newname));

            if($request->slug){
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $newname,
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit Successfull');
            }else{
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $newname,
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit Successfull');
            }
        }else{

            if($request->slug){
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit Successfull');
            }else{
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit Successfull');
            }

        }


    }
    //delete
    public function delete($id){
        $category = Category::where('slug',$id)->first();
        if($category->image){
            $oldpath = base_path('public/uploads/category/'.$category->image);
            if(file_exists($oldpath)){
                unlink($oldpath);
            }
        }

        Category::find($category->id)->delete();
        return redirect()->route('category.index')->with('category_success','Category Delete Successfull');
    }
    //status update

    public function status($slug){
        $category = Category::where('slug',$slug)->first();


        if($category->status == 'active'){
            Category::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
        return redirect()->route('category.index')->with('category_success','Category Status Change Successfull');

        }else{
            Category::find($category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
        return redirect()->route('category.index')->with('category_success','Category Status Change Successfull');

        }

    }

}
