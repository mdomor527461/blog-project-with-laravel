<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
class ManagementController extends Controller
{
    //index
    public function index(){
        $managers = User::where('role','manager')->get();
        return view('dashboard.management.auth.index',compact('managers'));
    }
    //register
    public function store_register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);

        if(!$request->role == ""){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            return back()->with('register_complete' , "Registration Complete");
        }else{
            return back()->withErrors(['role' => "please , select role first"])->withInput();
        }



    }
    //manageer controller
    public function manager_down($id){
        $manager = User::where('id',$id)->first();


        if($manager->role == 'manager'){
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            return back()->with('register_complete' , "Manager Demotion Successfull");

        }
    }
     //manager delete
     public function manager_delete($id){
        $manager = User::where('id',$id)->get()->first();
        User::find($manager->id)->delete();
        return back()->with('register_complete' , "Manager delete Successfull");
    }


    //role
    public function role_index(){
        $users = User::where('role','user')->where('block',false)->get();
        $blocked_users = User::where('role','user')->where('block',true)->get();
        $bloggers = User::where('role','blogger')->get();
        return view('dashboard.management.role.index',[
            'users' => $users,
            'bloggers' =>$bloggers,
            'blocked_users' => $blocked_users,
        ]);
    }


    public function role_assign(Request $request){

        $request->validate([
            'role' => 'required|in:manager,blogger,user',
        ]);

        $user = User::where('id',$request->user_id)->first();

        User::find($user->id)->update([
            'role' => $request->role,
            'updated_at' => now(),
        ]);

        Session::flash('assignrole','Role Assign Successfull');

        return back();

    }


    public function blogger_grade_down($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'blogger'){
            User::find($user->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            Session::flash('assignrole','Blogger Role Down Successfull');

            return back();
        }
    }

    public function user_grade_down($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'block' => true,
                'updated_at' => now(),
            ]);
            Session::flash('assignrole','User blocked Successfull');

            return back();
        }
    }

    //blogger delete
    public function blogger_delete($id){
        $blogger = User::where('id',$id)->get()->first();
        User::find($blogger->id)->delete();
        Session::flash('assignrole','blogger delete Successfull');
        return back();
    }
    //user delete
    public function user_delete($id){
        $user = User::where('id',$id)->get()->first();
        User::find($user->id)->delete();
        Session::flash('assignrole','user delete Successfull');
        return back();
    }
    //unblock user
    public function user_grade_up($id){
        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'block' => false,
                'updated_at' => now(),
            ]);
            Session::flash('assignrole','User unblocked Successfull');

            return back();
        }
    }

}
