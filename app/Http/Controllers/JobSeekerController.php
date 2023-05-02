<?php

namespace App\Http\Controllers;
use App\Models\JobSeeker;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    public function index(){
        $jobSeekers = JobSeeker::all();
        return view('job_seekers_manage')->with('jobSeekers', $jobSeekers);
    }
    public function insertGet(){
        return view('add-update-jobseeker');
    }
    public function insert(Request $request){
        $validator = validator(request()->all(), [
            'profileImage' => 'mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $jobSeeker = new JobSeeker();
        $profileImg = time() . "." . $request->file('profileImage')->getClientOriginalName();
        $request->profileImage->move(public_path('images/jobseekers'), $profileImg);
        $jobSeeker->image = $profileImg;
        $jobSeeker->name = $request->input('name');
        $jobSeeker->email = $request->input('userEmail');
        $jobSeeker->phone = $request->input('phone');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');        
        $jobSeeker->address = $request->input('address');
        $jobSeeker->password = '12345678';
        $jobSeeker->save();
        return redirect('/admin/job-seekers/details/'.$jobSeeker->id);
        // return redirect('/admin/job-seekers')->with('status', "added successfully");
    }
    public function updateSetData($id){
        $jobseeker = JobSeeker::find($id);
        return view('add-update-jobseeker')->with('jobseeker', $jobseeker)->with('updateId', $id);
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
        return redirect('/admin/job-seekers')->with('status', "updated successfully");
    }
    public function updateImage(Request $request,$id){
        $jobseeker = JobSeeker::find($id);
        $validator = validator(request()->all(), [
            'newProfileImage' => 'mimes:jpeg,jpg,svg,gif,png|max:20',
        ]);
        if ($request->hasFile('newProfileImage')) {
            if (file_exists(public_path('images/jobseekers/' . $jobseeker->image))) {
                unlink(public_path('images/jobseekers/' . $jobseeker->image));
            }
            $profileImage = time() . "." . $request->file('newProfileImage')->getClientOriginalName();
            $request->newProfileImage->move(public_path('images/jobseekers'), $profileImage);
            $jobseeker->image = $profileImage;
        }
        $jobseeker->save();
        return view('add-update-jobseeker')->with('jobseeker', $jobseeker)->with('updateId', $id);
    }
    public function viewDetails($id){
        $jobseeker = JobSeeker::find($id);
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
}
