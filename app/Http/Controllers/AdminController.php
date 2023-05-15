<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Company;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //get admin data and show profile
    public function profile(){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        return view('admin-profile')->with('admin',$admin);
    }
    //update admin profile form
    public function updateProfileForm(){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        return view('update-profile')->with('admin',$admin);
    }
    //update admin profile
    public function updateProfile(Request $request){
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);
        $admin->name = $request->input('name');
        $admin->phone = $request->input('phone');
        $admin->save();
        return redirect('/admin/profile')->with('status', "updated profile successfully");
    }
    //update admin profile image
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
        return redirect('/admin/profile')->with('status', "updated profile photo successfully");
    }
    //show change password form
    public function changePasswordForm(){
        return view('change-password');
    }
    //change password
    public function changePassword(Request $request){
        $validator = validator(request()->all(), [
            'password'=>['bail','required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }  
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);        
        if(Hash::check($request->input('currentPass'),$admin->password)){
            if(Hash::check($request->input('password'),$admin->password)){
                return back()->with('error','Current password and New password is same.Please use new one.')->withInput();
            }else{
                $admin->password = Hash::make($request->input('password'));
            }            
        }else{
            return back()->with('error','current password incorrect')->withInput();
        }        
        $admin->save();
        return view('change-password')->with('status', 'changed password successfully');
    }
    //reset password for company
    public function resetCompanyPassword($id){
        $company = Company::find($id);
        $company->password = Hash::make('12345678');
        $company->save();
        $status = "reseted password for ".$company->company_name." successfully.";
        return redirect('/admin/companies')->with('status',$status);
    }
    //reset password for jobseeker
    public function resetJobSeekerPassword($id){
        $jobseeker = JobSeeker::find($id);
        $jobseeker->password = Hash::make('12345678');
        $jobseeker->save();
        $status = "reseted password for ".$jobseeker->name." successfully.";
        return redirect('/admin/job-seekers')->with('status',$status);
    }
}
