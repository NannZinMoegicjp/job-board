<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Company;
use App\Models\Industry;
use App\Models\Application;
use App\Models\State;
use App\Models\City;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    //user home page
    public function index(){
        $jobs = Job::WhereDate('created_at','>',Carbon::today()->subMonths(6))->orderBy('created_at','desc')->where('status','active') ->whereNull('deleted_at')->limit(8)->get();
        $data = ["jobs"=>$jobs];       
        // $data = ["jobs"=>$jobs,"popCategories"=>$popularCategories,"companies"=>$companies,"industries"=>$industries,"states"=>$states];
        return view('index')->with("data",$data);
    }
    //get job information by id
    public function jobDetails($id){
        $job = Job::find($id);
        return view('user-job-details')->with("job",$job);
    }
    //get company information by id
    public function companyDetails($id){
        $company = Company::find($id);
        $jobs = Job::join('addresses','jobs.address_id','=','addresses.id')
        ->where('addresses.company_id','=',$id)
        ->whereNull('jobs.deleted_at')
        ->where('jobs.status','=','active')
        ->select('jobs.*')
        ->get();
        $data = ["company"=>$company,"jobs"=>$jobs];  
        return view('company-details')->with("data",$data);
    }
    //apply job function
    public function applyJobs(Request $request,$id){
        $validator = validator(request()->all(), [
            'cvform' => 'required|max:5120',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $application = new Application();
        $count = Application::where('job_id',$id)->where('job_seeker_id',$request->session()->get('jobseekerId'))->count();
        if($count > 0 ){
            return redirect()->back()->with('error','you have already applied this job');
        }
        $application->job_id = $id;
        $application->job_seeker_id = $request->session()->get('jobseekerId');
        $cvfile = time() . "." . $request->file('cvform')->getClientOriginalName();
        $request->cvform->move(public_path('applications'), $cvfile);
        $application->cvfile = $cvfile; 
        $application->status = 'pending';
        $application->save();
        return view('jobs-applied-success');
    }
    //get jobs by state/location
    public function getJobsByState($stateId){
        $jobs = Job::join('addresses','jobs.address_id','=','addresses.id')
        ->join('cities','cities.id','=','addresses.city_id')
        ->where('cities.state_id','=',$stateId)
        ->whereNull('jobs.deleted_at')
        ->where('jobs.status','=','active')
        ->WhereDate('jobs.created_at','>',Carbon::today()->subMonths(6))
        ->select('jobs.*')
        ->get();
        $categories = JobCategory::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $data = ["jobs"=>$jobs];  
        return $jobs;
        // return view('jobs')->with('data',$data);
    }
    //get jobs by job category
    public function getJobsByCategory($categoryId){
        $jobs = Job::where('job_category_id',$categoryId)->WhereDate('created_at','>',Carbon::today()->subMonths(6))->where('status','active') ->whereNull('deleted_at')->get();
        $categories = JobCategory::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $data = ["jobs"=>$jobs];  
        return $jobs;        
    }
    //get jobs of company
    public function getJobsByCompany($companyId){
        $jobs = Job::join('addresses','jobs.address_id','=','addresses.id')
        ->where('addresses.company_id','=',$companyId)
        ->whereNull('jobs.deleted_at')
        ->where('jobs.status','=','active')
        ->WhereDate('jobs.created_at','>',Carbon::today()->subMonths(6))
        ->select('jobs.*')
        ->get(); 
        return $jobs;
    }
    //get jobs by industry
    public function getJobsByIndustry($industryId){
        $jobs = Job::join('addresses','jobs.address_id','=','addresses.id')
        ->join('companies','companies.id','=','addresses.company_id')
        ->join('company_industry','company_industry.company_id','=','companies.id')
        ->where('company_industry.industry_id',$industryId)
        ->whereNull('jobs.deleted_at')
        ->where('jobs.status','=','active')
        ->WhereDate('jobs.created_at','>',Carbon::today()->subMonths(6))
        ->select('jobs.*')
        ->get(); 
        return $jobs;
    }
    //get categories
    public function categories(){
        $categories = JobCategory::orderBy('name')->get();
        return view('categories')->with('categories',$categories);
    }
    //get locations
    public function locations(){
        $states = State::orderBy('name')->get();
        return view('locations')->with('locations',$states);
    }
    //get industries
    public function industries(){
        $industries = Industry::orderBy('name')->get();
        return view('industries')->with('industries',$industries);
    }
    //get companies
    public function companies(){
        $companies = Company::orderBy('company_name')->get();
        return view('companies')->with('companies',$companies);
    }
}