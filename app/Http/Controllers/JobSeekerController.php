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
        $jobSeeker = new JobSeeker();
        $jobSeeker->name = $request->input('name');
        $jobSeeker->email = $request->input('userEmail');
        $jobSeeker->phone = $request->input('phone');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');
        $jobSeeker->image = $request->input('profileImage');
        $jobSeeker->address = $request->input('address');
        return redirect('/admin/job-seekers')->with('status', "added successfully");
    }
}
