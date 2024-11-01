<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }
    //name update
    public function name_update(Request $request){
        $oldname = Auth::user()->name;
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
        ]);
        User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);
        return back()->with('name_update',"name updated to $oldname to $request->name");
    }
    // email update

    public function email_update(Request $request){
        $oldemail = Auth::user()->email;
        $request->validate([
            'email' => 'required',
        ]);
        User::find(auth()->user()->id)->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return back()->with('email_update',"name updated to $oldemail to $request->email");
    }
    //password update
    public function password_update(Request $request){
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);
        if(Hash::check($request->current_password, Auth::user()->password)){
            User::find(auth()->user()->id)->update(
                [
                    'password' => $request->password,
                    'updated_at' => now(),
                ]
            );
            return back()->with("password_update","password update successfull");
        }
        else{
            return back()->withErrors(
                ['current_password' => "Current password didn't match"]
            );
        }
    }

    public function image_update(Request $request){
        $manager = new ImageManager(new Driver());

        if($request->hasFile('image')){

            if(Auth::user()->image){
                $oldpath = base_path('public/uploads/profile/'.Auth::user()->image);
                if(file_exists($oldpath)){
                    unlink($oldpath);
                }
            }
        }
        $newname = Auth::user()->id .'-'. now()->format('M d ,Y') .'-'. rand(0,9999) .'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/uploads/profile/'.$newname));
        User::find(auth()->user()->id)->update([
            'image' => $newname,
            'updated_at' => now(),
        ]);
        return back()->with('image_update',"image update successful");
    }
}
