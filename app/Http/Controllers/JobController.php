<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        $jobs = Job::where('status','active')->whereNull('deleted_at')->orderBy('created_at')->get();
        return view('jobs-manage')->with('jobs', $jobs);
    }
    public function viewDetails($id){    
        $job = Job::find($id);
        return view('job-details')->with('job', $job);
    } 
    public function delete($id){    
        $job = Job::find($id);
        $job->delete();
        return redirect()->route('jobs-manage')->with('status','deleted job successfully!');
    } 
}
