<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
class AdminController extends Controller
{
    public function index(){
        $admins = Admin::all();
        return view('admin-manage')->with('admins',$admins);
    }
    public function addGet(){
        return view('add-admin');
    }
    public function add(Request $request){
        $email = $request->input('userEmail');
        if (Admin::where('email', '=', $email)->exists()) {
            return back()->withInput()->with('error','email already existed');
        } 
        $validator = validator(request()->all(), [
            'profileImage' => 'mimes:jpeg,jpg,svg,gif,png|max:2048',
            'name' => 'Regex:/^[\D]+$/i|max:100',
            'phone'=> 'numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->password = '12345678';
        $admin->email = $request->input('userEmail');
        $admin->phone = $request->input('phone');
        if($request->hasFile('profileImage')){
            $profileImg = time() . "." . $request->file('profileImage')->getClientOriginalName();
            $request->profileImage->move(public_path('images/admins'), $profileImg);
            $admin->profile_image = $profileImg;
        } 
        $admin->save();
        return redirect()->route('admin-details',$admin->id);
    }
    public function viewDetails($id){
        $admin = Admin::find($id);
        return view('admin-details')->with('admin', $admin);
    }
    public function delete($id){
        $admin = Admin::find($id);
        if (file_exists(public_path('images/admins/' . $admin->profile_image))) {
            unlink(public_path('images/admins/' . $admin->profile_image));
        }
        $admin->delete();
        return redirect()->route('manage-admin');
    }
}
