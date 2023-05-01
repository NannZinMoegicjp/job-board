<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        $jobs = Job::all();
        return view('jobs-manage')->with('jobs', $jobs);
    }
    public function viewDetails($id){    
        $job = Job::find($id);
        return view('job-details')->with('job', $job);
    } 
}