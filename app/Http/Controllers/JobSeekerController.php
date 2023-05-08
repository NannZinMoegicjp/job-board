<?php

namespace App\Http\Controllers;
use App\Models\JobSeeker;
use App\Models\Application;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    public function index(Request $request){
        $jobSeeker = JobSeeker::find(4);
        $request->session()->put('jobseekerId',$jobSeeker->id);     
        $request->session()->put('profileImg',$jobSeeker->image);  
        $request->session()->put('name',$jobSeeker->name);
        $request->session()->put('role','jobseeker');
        $applications = Application::where('job_seeker_id',session('id'))->orderBy('created_at','desc')->get();
        $shortListedApps = Application::where('job_seeker_id',session('id'))->where('status','shortlisted')->get();
        $pendingApps = Application::where('job_seeker_id',session('id'))->where('status','pending')->get();
        $rejectedApps = Application::where('job_seeker_id',session('id'))->where('status','rejected')->get();
        $data = ["applications"=>$applications,"shortlistedApps"=>$shortListedApps,"rejectedApps"=>$rejectedApps,"pendingApps"=>$pendingApps];
        return view('JobSeeker.dashboard')->with('data',$data);   
    }
    public function allJobSeekers(){
        $jobSeekers = JobSeeker::all();
        return view('job_seekers_manage')->with('jobSeekers', $jobSeekers);
    }
    public function insertGet(){
        return view('add-update-jobseeker');
    }
    public function register(Request $request){
        $validator = validator(request()->all(), [
            'name'=>'required',
            'phone' => 'required|digits:11',
            'profileImage' => 'nullable|mimes:jpeg,jpg,svg,gif,png|max:2048',
            'dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            ],
            'userEmail'=>'required|email|unique:job_seekers,email|unique:companies,email|unique:admins,email'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }        
        $jobSeeker = new JobSeeker();
        if($request->hasFile('prifileImage')){
            $profileImg = time() . "." . $request->file('profileImage')->getClientOriginalName();
            $request->profileImage->move(public_path('images/jobseekers'), $profileImg);
            $jobSeeker->image = $profileImg;
        }                
        $jobSeeker->name = $request->input('name');
        $jobSeeker->email = $request->input('userEmail');
        $jobSeeker->phone = $request->input('phone');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');        
        $jobSeeker->address = $request->input('address');
        $jobSeeker->password = '12345678';
        $jobSeeker->save();
        return "successfully registered";
        return redirect('/admin/job-seekers/details/'.$jobSeeker->id);
        // return redirect('/admin/job-seekers')->with('status', "added successfully");
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
            'newProfileImage' => 'required|mimes:jpeg,jpg,svg,gif,png|max:20',
        ]);
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
    public function delete($id)
    {
        $jobseeker = JobSeeker::find($id);
        if (file_exists(public_path('images/jobseekers/' . $jobseeker->image))) {
            unlink(public_path('images/jobseekers/' . $jobseeker->image));
        }
        $jobseeker->delete();
        return redirect('/admin/job-seekers')->with('status', "deleted successfully");
    }
    public function pendingApplication(){
        $jobSeeker = JobSeeker::find(session('jobseekerId'));
        $applications = Application::where('job_seeker_id',session('id'))->orderBy('created_at','desc')->where('status','pending')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.pending-applications')->with('data',$data);
    }
    public function shortlistedApplication(){
        $jobSeeker = JobSeeker::find(session('jobseekerId'));
        $applications = Application::where('job_seeker_id',session('id'))->orderBy('created_at','desc')->where('status','shortlisted')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.shortlisted-applications')->with('data',$data);
    }
    public function rejectedApplication(){
        $jobSeeker = JobSeeker::find(session('jobseekerId'));
        $applications = Application::where('job_seeker_id',session('id'))->orderBy('created_at','desc')->where('status','rejected')->get();
        $data = ['applications'=>$applications];
        return view('JobSeeker.rejected-applications')->with('data',$data);
    }
}
