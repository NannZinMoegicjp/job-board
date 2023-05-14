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
    public function index(Request $request){
        if (auth()->guard('jobseeker')->check()) {
            $userId = auth()->guard('jobseeker')->id();
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
   
    public function getProfileData(){
        $jobseeker = JobSeeker::find(auth()->guard('jobseeker')->id());
        return view('JobSeeker.update-profile')->with('jobseeker', $jobseeker)->with('updateId', auth()->guard('jobseeker')->id());
    }
    public function update(Request $request){
        $jobSeeker = JobSeeker::find(auth()->guard('jobseeker')->id());
        $jobSeeker->name = $request->input('name');
        $jobSeeker->phone = $request->input('phone');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');        
        $jobSeeker->address = $request->input('address');
        $jobSeeker->save();
        return redirect('/job-seeker/profile')->with('status', "updated successfully");
    }
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
        $request->session()->put('profileImg',$jobseeker->image);  
        return redirect('/job-seeker/profile')->with('status', "updated profile photo successfully");
    }
    public function viewDetails(){
        $jobseeker = JobSeeker::find(auth()->guard('jobseeker')->id());
        if(auth()->guard('jobseeker')->check())
            return view('JobSeeker.profile')->with('jobseeker', $jobseeker)->with('updateId', auth()->guard('jobseeker')->id());
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
    //show change password form
    public function changePasswordForm(){
        return view('JobSeeker.change-password');
    }
    //job seeker change password
    public function changePassword(Request $request){
        $validator = validator(request()->all(), [
            'password'=>['bail','required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
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
        // Log out the user and redirect to the login page
        // Auth::logout();
        return view('JobSeeker.change-password')->with('status', 'changed password successfully.');
    }
}
