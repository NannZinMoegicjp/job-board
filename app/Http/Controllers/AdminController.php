<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $admins = Admin::all();
        return view('admin-manage')->with('admins',$admins);
    }
    public function profile(){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        return view('admin-profile')->with('admin',$admin);
    }
    public function updateProfileForm(){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        return view('update-profile')->with('admin',$admin);
    }
    public function updateProfile(Request $request){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        $admin->name = $request->input('name');
        $admin->phone = $request->input('phone');
        return view('admin-profile')->with('admin',$admin);
    }
    public function updateImage(Request $request){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);     
        $validator = validator(request()->all(), [
            'newProfileImage' => 'required|mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if ($admin->profile_image) {
            if (file_exists(public_path('images/admins/' . $admin->profile_image))) {
                unlink(public_path('images/admins/' . $admin->profile_image));
            }
        }
        $profileImage = time() . "." . $request->file('newProfileImage')->getClientOriginalName();
        $request->newProfileImage->move(public_path('images/admins'), $profileImage);
        $admin->profile_image = $profileImage;
        $admin->save();
        return redirect()->route('admin.profile')->with('status', "updated profile photo successfully");
    }
    public function changePasswordForm(){
        return view('change-password');
    }
    public function changePassword(Request $request){
        $validator = validator(request()->all(), [
            'password'=>['bail','required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
        ],[
            'password.confirmed' => 'The password field confirmation does not match.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }  
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        if($admin->password == $request->input('currentPass')){
            $admin->password = Hash::make($request->input('password'));
        }else{
            return back()->with('error','current password incorrect')->withInput();
        }        
        $admin->save();
        // Log out the user and redirect to the login page
        Auth::logout();
        return redirect('/login')->with('status', 'changed password successfully. please log in again.');
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
