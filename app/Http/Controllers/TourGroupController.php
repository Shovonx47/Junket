<?php

namespace App\Http\Controllers;

use App\Models\TourGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TourGroupController extends Controller
{
    public function index(){
        return view('group.login');
    }
    public function register(){
        return view('group.register');
    }
    public function registerCreate(Request $request){
        $group = new TourGroup();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('assets/uploads/groups',$fileName);
            $group->image = $fileName;
        }
        $group->group_name = $request->group_name;
        $group->owner_name = $request->owner_name;
        $group->email = $request->email;
        $group->phone = $request->phone;
        $group->password = Hash::make($request->password);
        $group->location = $request->location;
        $group->about_us = $request->about_us;
        $group->save();
        return redirect('group/login')->with('message','Account created successfylly!');
    }
    public function login(Request $request){
        $check = $request->all();
        if(Auth::guard('group')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return redirect('group/dashboard')->with('message','Login successfully');
        }else{
            return redirect()->back()->with('message', 'Invaild email or password');
        }
    }
    public function dashboard(){
        return view('group.index');
    }
    public function logout(){
        Auth::guard('group')->logout();
        return redirect('group/login')->with('message','Logout successfully');
    }
}