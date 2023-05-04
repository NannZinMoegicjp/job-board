<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{
    public function index()
    {
        $addrIDs = Address::select('id')->where('company_id', 8)->get();
        $jobs = Job::whereIn('address_id',$addrIDs)->where('status','active')->get();
        return view('Employer.job-manage')->with("jobs",$jobs);
    }
    public function insertGet()
    {
        //need to get from logged in id
        $addrs = Address::where('company_id', 8)->get();
        $jobCategories = JobCategory::all();
        $empTypes = EmploymentType::all();
        $expLevels = ExperienceLevel::all();
        $data = ['addresses' => $addrs, 'jobCategories' => $jobCategories, 'empTypes' => $empTypes, 'expLevels' => $expLevels];
        return view('Employer.multistepForm')->with('data', $data);
    }
    public function insert(Request $request)
    {
        $job = new Job();
        $job->title = $request->title;
        $job->min_salary = $request->minSalary;
        $job->max_salary = $request->maxSalary;
        $job->open_position = $request->openPosition;
        if ($request->female) {
            $job->gender = 'female';
        } else if ($request->male) {
            $job->gender = 'male';
        }else if($request->female && $request->male){
            $job->gender = 'both';
        }
        $job->job_category_id = $request->jobCategory;
        $job->experience_level_id = $request->expLevel;
        $job->employment_type_id = $request->empType;
        $job->address_id = $request->address;
        $job->description = $request->description;
        $job->requirement = $request->requirement;
        $job->benefit = $request->benefit;
        $job->status = 'active';
        $job->save();
        $company = Company::find(8);
        $company->no_of_credit -= 1;
        return $job;
    }
    public function checkCredit(){
        $company = Company::find(8);
        // dd($company->no_of_credit);
        if($company->no_of_credit > 0){
            return redirect()->route('insert.job');            
        }else{
            return redirect('Employer.multistepForm')->with('noCredit', 'please buy credit to post jobs!');
        }        
    }
}
