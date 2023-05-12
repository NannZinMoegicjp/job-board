<?php

namespace App\Http\Controllers;
use App\Models\JobSeeker;
use App\Models\JobSeekerUser;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    public function index(Request $request){
        if (auth()->check()) {
            $userId = auth()->id();
            $jobSeeker = JobSeeker::find($userId);
            $request->session()->put('jobseekerId',$jobSeeker->id);     
            $request->session()->put('jobseekerEmail',$jobSeeker->email);     
            $request->session()->put('jobseekerName',$jobSeeker->name);
            $request->session()->put('jobseekerPhone',$jobSeeker->name);    
            $request->session()->put('profileImg',$jobSeeker->image);  
            $request->session()->put('role','jobseeker');
        }    
        $applications = Application::where('job_seeker_id',session('jobseekerId'))->orderBy('created_at','desc')->count();
        $shortListedApps = Application::where('job_seeker_id',session('jobseekerId'))->where('status','shortlisted')->count();
        $pendingApps = Application::where('job_seeker_id',session('jobseekerId'))->where('status','pending')->count();
        $rejectedApps = Application::where('job_seeker_id',session('jobseekerId'))->where('status','rejected')->count();
        $count = ["applications"=>$applications,"shortlistedApps"=>$shortListedApps,"rejectedApps"=>$rejectedApps,"pendingApps"=>$pendingApps];
        return view('JobSeeker.dashboard')->with('count',$count);   
    }
    public function allJobSeekers(){
        $jobSeekers = JobSeeker::all();
        return view('job_seekers_manage')->with('jobSeekers', $jobSeekers);
    }
    public function insertGet(){
        return view('add-update-jobseeker');
    }
   
    public function getProfileData($id){
        $jobseeker = JobSeeker::find($id);
        return view('JobSeeker.update-profile')->with('jobseeker', $jobseeker)->with('updateId', $id);
    }
    public function update(Request $request,$id){
        $jobSeeker = JobSeeker::find($id);
        $jobSeeker->name = $request->input('name');
        $jobSeeker->email = $request->input('userEmail');
        $jobSeeker->phone = $request->input('phone');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');        
        $jobSeeker->address = $request->input('address');
        $jobSeeker->save();
        return redirect('/job-seeker/profile/'.$id)->with('status', "updated successfully");
    }
    public function updateImage(Request $request,$id){
        $jobseeker = JobSeeker::find($id);       
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
        $request->session()->put('profileImg',$jobseeker->image);  
        return redirect('/job-seeker/profile/'.$id)->with('status', "updated profile photo successfully");
    }
    public function viewDetails($id){
        $jobseeker = JobSeeker::find($id);
        if(session('role') == 'jobseeker')
            return view('JobSeeker.profile')->with('jobseeker', $jobseeker)->with('updateId', $id);
        else
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
        return redirect('/admin/job-seekers')->with('status', "deleted successfully");
    }
    public function pendingApplication(){
        $applications = Application::where('job_seeker_id',session('jobseekerId'))->orderBy('created_at','desc')->where('status','pending')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.pending-applications')->with('data',$data);
    }
    public function shortlistedApplication(){
        $applications = Application::where('job_seeker_id',session('jobseekerId'))->orderBy('created_at','desc')->where('status','shortlisted')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.shortlisted-applications')->with('data',$data);
    }
    public function rejectedApplication(){
        $applications = Application::where('job_seeker_id',session('jobseekerId'))->orderBy('created_at','desc')->where('status','rejected')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.rejected-applications')->with('data',$data);
    }
}
