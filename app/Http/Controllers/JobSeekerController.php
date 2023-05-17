<?php

namespace App\Http\Controllers;
use App\Models\JobSeeker;
use App\Models\JobSeekerUser;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class JobSeekerController extends Controller
{
    //when job seeker log in, call this method
    //get number of applictions(shortlised,rejected,pending)
    public function index(Request $request){
        if (auth()->guard('jobseeker')->check()) {
            $userId = auth()->guard('jobseeker')->id();
            $jobSeeker = JobSeeker::find($userId);   
        }    
        $applications = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->orderBy('created_at','desc')->count();
        $shortListedApps = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->where('status','shortlisted')->count();
        $pendingApps = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->where('status','pending')->count();
        $rejectedApps = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->where('status','rejected')->count();
        $count = ["applications"=>$applications,"shortlistedApps"=>$shortListedApps,"rejectedApps"=>$rejectedApps,"pendingApps"=>$pendingApps];
        return view('JobSeeker.dashboard')->with('count',$count);   
    }
    //get all job seekers(by admin)
    public function allJobSeekers(){
        $jobSeekers = JobSeeker::all();
        return view('job_seekers_manage')->with('jobSeekers', $jobSeekers);
    }
    //add, delete job seeker by admin
    public function insertGet(){
        return view('add-update-jobseeker');
    }
   //get job seeker profile data to update(by jobseeker)
    public function getProfileData(){
        $jobseeker = JobSeeker::find(auth()->guard('jobseeker')->id());
        return view('JobSeeker.update-profile')->with('jobseeker', $jobseeker)->with('updateId', auth()->guard('jobseeker')->id());
    }
    //update profile data
    public function update(Request $request){
        $jobSeeker = JobSeeker::find(auth()->guard('jobseeker')->id());
        $jobSeeker->name = $request->input('name');
        $jobSeeker->phone = $request->input('phone');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');        
        $jobSeeker->address = $request->input('address');
        $jobSeeker->save();
        return redirect('/job-seeker/profile/'.auth()->guard('jobseeker')->id())->with('status', "updated successfully");
    }
    //update profile image
    public function updateImage(Request $request){
        $jobseeker = JobSeeker::find(auth()->guard('jobseeker')->id());       
        $validator = validator(request()->all(), [
            'newProfileImage' => 'required|mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if ($jobseeker->image) {
            if (file_exists(public_path('images/jobseekers/' . $jobseeker->image))) {
                unlink(public_path('images/jobseekers/' . $jobseeker->image));
            }
        }
        $profileImage = time() . "." . $request->file('newProfileImage')->getClientOriginalName();
        $request->newProfileImage->move(public_path('images/jobseekers'), $profileImage);
        $jobseeker->image = $profileImage;
        $jobseeker->save();
        return redirect('/job-seeker/profile/'.auth()->guard('jobseeker')->id())->with('status', "updated profile photo successfully");
    }
    public function viewDetails($id){
        $jobseeker = JobSeeker::find($id);
        if(auth()->guard('jobseeker')->check())
            return view('JobSeeker.profile')->with('jobseeker', $jobseeker)->with('updateId', $id);
        else if(auth()->guard('admin')->check())
            return view('admin-jobseeker-details')->with('jobseeker', $jobseeker);
    }
    public function delete($id){
        $jobseeker = JobSeeker::find($id);
        if($jobseeker->image){
            if (file_exists(public_path('images/jobseekers/' . $jobseeker->image))) {
                unlink(public_path('images/jobseekers/' . $jobseeker->image));
            }
        }        
        $jobseeker->delete();
        return redirect('/admin/job-seekers')->with('status', "deleted jobseeker successfully");
    }
    public function pendingApplication(){
        $applications = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->orderBy('created_at','desc')->where('status','pending')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.pending-applications')->with('data',$data);
    }
    public function shortlistedApplication(){
        $applications = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->orderBy('created_at','desc')->where('status','shortlisted')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.shortlisted-applications')->with('data',$data);
    }
    public function rejectedApplication(){
        $applications = Application::where('job_seeker_id',auth()->guard('jobseeker')->id())->orderBy('created_at','desc')->where('status','rejected')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.rejected-applications')->with('data',$data);
    }
    //show change password form
    public function changePasswordForm(){
        return view('JobSeeker.change-password');
    }
    //job seeker change password
    public function changePassword(Request $request){
        $validator = validator(request()->all(), [
            'password'=>['bail','required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'password_confirmation'=>['bail','required','same:password'],
        ],[
            'password' => 'The password should contain at least 8 characters',
            'password_confirmation' => 'The password confirmation does not match.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }  
        $userId = auth()->guard('jobseeker')->id();
        $jobseeker = JobSeeker::find($userId);        
        if(Hash::check($request->input('currentPass'),$jobseeker->password)){
            if(Hash::check($request->input('password'),$jobseeker->password)){
                return back()->with('error','Current password and New password is same.Please use new one.')->withInput();
            }else{
                $jobseeker->password = Hash::make($request->input('password'));
            }            
        }else{
            return back()->with('error','current password incorrect')->withInput();
        }        
        $jobseeker->save();
        return view('JobSeeker.change-password')->with('status', 'changed password successfully.');
    }
}
