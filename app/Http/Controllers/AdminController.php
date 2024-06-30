<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function dashboard(){
        return view('admin.index');
    }
    public function login(Request $request){
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return redirect('admin/dashboard')->with('message','Admin login successfully');
        }else{
            return redirect()->back()->with('message', 'Invaild email or password');
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login')->with('message','Admin logout successfully');
    }
    public function register(){
        return view('admin.register');
    }
    public function registerCreate(Request $request){
       Admin::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'created_at'=> now(),
       ]);
       return redirect('admin/login')->with('message','Admin created successfully, you can login now');
    }
}