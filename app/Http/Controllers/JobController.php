<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;
use Carbon\Carbon;
class JobController extends Controller
{
    //get all jobs by admin
    public function index(){
        $jobs = Job::WhereDate('created_at','>',Carbon::today()->subMonths(6))->Where('status','active')->orderBy('created_at','desc')->get();      
        return view('jobs-manage')->with('jobs', $jobs);
    }
    //view job detail by admin
    public function viewDetails($id){    
        $job = Job::find($id);
        return view('job-details')->with('job', $job);
    } 
    //delete jobs
    public function delete($id){    
        $job = Job::find($id);
        $job->delete();
        return redirect()->route('jobs-manage')->with('status','deleted job successfully!');
    } 
}
