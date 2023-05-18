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
        $validator = validator(request()->all(), [
            'name'=>['required','string','regex:/^[a-zA-Z]+( [a-zA-Z]+)*$/'],
            'phone' => ['required','regex:/^(\+?959|09)[0-9]{9}$/'],
        ],[
            'name'=>'name must contain alphabets only',
            'phone'=>'Phone number should start with 09/+959 and have a length of 11 characters.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
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
            'newProfileImage' => 'required|mimes:jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp|max:2048',
        ],[
            'newProfileImage' => 'Image file type should be one of jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
        $userId = auth()->guard('admin')->id();
        $admin = Admin::find($userId);                       
        if(Hash::check($request->input('currentPass'),$admin->password)){
            $validator = validator(request()->all(), [
                'password'=>['bail','required', 'string', 'min:8',  'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
                'password_confirmation'=>['required','same:password']
            ],[
                'password'=>'password must have 8 characters including one lowercase letter, one uppercase letter, one digit, and one
                special character',
                'password_confirmation'=>'password confirmation does not match'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } 
            if(Hash::check($request->input('password'),$admin->password)){
                return back()->with('newPassError','Current password and New password is same.Please use new one.')->withInput();
            }else{
                $admin->password = Hash::make($request->input('password'));
            }            
        }else{
            return back()->with('currentPassError','current password incorrect')->withInput();
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
