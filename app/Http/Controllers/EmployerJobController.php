<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployerJobController extends Controller
{
    public function index(Request $request)
    {
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->whereNull('deleted_at')->get();
        $jobs = Job::whereIn('address_id',$addrIDs)->where('status','active')->where('created_at','>',Carbon::today()->subMonths(6))->get();
        return view('Employer.job-manage')->with("jobs",$jobs);
    }
    public function insertGet(Request $request)
    {
        //need to get from logged in id
        $addrs = Address::where('company_id',  $request->session()->get('id'))->where('deleted_at',null)->get();
        $jobCategories = JobCategory::orderBy('name')->get();
        $empTypes = EmploymentType::orderBy('name')->get();
        $expLevels = ExperienceLevel::orderBy('name')->get();
        $data = ['addresses' => $addrs, 'jobCategories' => $jobCategories, 'empTypes' => $empTypes, 'expLevels' => $expLevels];
        return view('Employer.multistepForm')->with('data', $data);
    }
    public function insert(Request $request)
    {
        $job = new Job();
        $job->title = $request->title;
        $job->min_salary = $request->minSalary;
        $job->max_salary = $request->maxSalary;
        if($request->minSalary>$request->maxSalary){
            return back()->with('error','min salary should be less than max salary')->withInput();
        }
        $job->open_position = $request->openPosition;
        if ($request->male && $request->female) {
            $job->gender = 'both';
        }else if ($request->female) {
            $job->gender = 'female';
        } else if( $request->male){
            $job->gender = 'male';
        }
        $job->job_category_id = $request->jobCategory;
        $job->experience_level_id = $request->expLevel;
        $job->employment_type_id = $request->empType;
        $job->address_id = $request->address;
        if($request->has('description')){
            $job->description = $request->description;
        }else{
            return back()->with('error','please enter description')->withInput();
        }
        if($request->has('requirement')){
            $job->requirement = $request->requirement;
        }else{
            return back()->with('error','please enter requirement')->withInput();
        }
        if($request->has('benefit')){
            $job->benefit = $request->benefit;
        }  else{
            return back()->with('error','please enter benefit')->withInput();
        }
        $job->status = 'active';
        $job->save();
        $company = Company::find($request->session()->get('id'));
        $company->no_of_credit -= 1;
        $company->save();
        return redirect()->route('employer.jobs')->with('status','posted job successfully!');
    }
    public function updateGet(Request $request,$id)
    {
        $job = Job::find($id);
        $addrs = Address::where('company_id',$job->address->company_id)->get();
        $jobCategories = JobCategory::all();
        $empTypes = EmploymentType::all();
        $expLevels = ExperienceLevel::all();
        $data = ['job'=>$job, 'addresses' => $addrs, 'jobCategories' => $jobCategories, 'empTypes' => $empTypes, 'expLevels' => $expLevels];
        return view('Employer.update-job')->with('data', $data);
    }
    public function update(Request $request,$id)
    {
        $job = Job::find($id);
        $job->title = $request->title;
        $job->min_salary = $request->minSalary;
        $job->max_salary = $request->maxSalary;
        if($request->minSalary>$request->maxSalary){
            return back()->with('error','min salary should be less than max salary')->withInput();
        }
        $job->open_position = $request->openPosition;
        if ($request->male && $request->female) {
            $job->gender = 'both';
        }else if ($request->female) {
            $job->gender = 'female';
        } else if( $request->male){
            $job->gender = 'male';
        }
        $job->job_category_id = $request->jobCategory;
        $job->experience_level_id = $request->expLevel;
        $job->employment_type_id = $request->empType;
        $job->address_id = $request->address;
        if($request->has('description')){
            $job->description = $request->description;
        }else{
            return back()->with('error','please enter description')->withInput();
        }
        if($request->has('requirement')){
            $job->requirement = $request->requirement;
        }else{
            return back()->with('error','please enter requirement')->withInput();
        }
        if($request->has('benefit')){
            $job->benefit = $request->benefit;
        }  else{
            return back()->with('error','please enter benefit')->withInput();
        }
        $job->save();
        return redirect('/employer/job/details/'.$job->id)->with('status','updated job successfully!');
    }
    public function checkCredit(Request $request){
        $company = Company::find($request->session()->get('id'));
        if($company->no_of_credit > 0){
            return redirect()->route('insert.job');            
        }else{
            return redirect()->route('employer.jobs')->with('noCredit', 'please buy credit to post jobs!');
        }        
    }
    public function viewDetails($id){    
        $job = Job::find($id);
        return view('Employer.job-details')->with('job', $job);
    }
    public function deactivate($id){    
        $job = Job::find($id);
        $job->status='inactive';
        $job->save();
        return redirect()->route('employer.jobs')->with('status','closed job successfully!');
    }
    public function activate(Request $request,$id){    
        $job = Job::find($id);
        $current = Carbon::now();
        $posted_date = new Carbon($job->created_at);       
        if($current>$posted_date->addMonthWithoutOverflow(6)){
            $company = Company::find($request->session()->get('id'));
            $company->no_of_credit -= 1;
            $company->save();
        }
        $job->status='active';
        $job->save();
        return redirect()->route('employer.deactivted-jobs')->with('status','opened job successfully!');
    }
    public function delete($id){    
        $job = Job::find($id);
        $job->delete();
        return back()->with('status','deleted jobs successfully!');
    }
    public function deactivatedJobs(Request $request){
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->where('deleted_at',null)->get();
        $jobs = Job::whereIn('address_id',$addrIDs)->where('status','inactive')->get();
        return view('Employer.deactivated-jobs-manage')->with("jobs",$jobs);
    }
    public function expiredJobs(Request $request){
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->where('deleted_at',null)->get();
        $jobs = Job::whereIn('address_id',$addrIDs)->whereDate('created_at','<',Carbon::today()->subMonths(6))->get();
        return view('Employer.expired-jobs-manage')->with("jobs",$jobs);
    }
    public function inactiveJobs(Request $request){
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->where('deleted_at',null)->get();
        // dd(Carbon::today()->subMonths(6));
        $jobs = Job::whereIn('address_id',$addrIDs)->WhereDate('created_at','<',Carbon::today()->subMonths(6))->orWhere('status','inactive')->get();
        return view('Employer.inactive-jobs-manage')->with("jobs",$jobs);
    }    
}
