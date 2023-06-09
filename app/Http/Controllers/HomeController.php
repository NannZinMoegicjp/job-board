<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\City;
use App\Models\Company;
use App\Models\Industry;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\State;
use App\Models\ExperienceLevel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    //user home page
    public function index()
    {  
        //get 8 latest jobs
        $jobs = Job::WhereDate('created_at', '>', Carbon::today()->subMonths(6))->orderBy('created_at', 'desc')->where('status', 'active')->limit(8)->get();
        //get 6 popular categories and job count
        $popularCategories = JobCategory::join('jobs', 'job_categories.id', '=', 'jobs.job_category_id')
            ->groupBy('job_categories.id', 'job_categories.name', 'job_categories.image')
            ->whereDate('jobs.created_at', '>', Carbon::today()->subMonths(6))
            ->where('jobs.status', 'active')
            ->orderByRaw('COUNT(jobs.id) DESC')
            ->take(6)
            ->select('job_categories.id', 'job_categories.name', 'job_categories.image', DB::raw('COUNT(jobs.id) as job_count'))
            ->get();
        //top 6 hiring companies
        $companies = DB::select('
                    SELECT companies.id, companies.company_name, companies.logo,COUNT(jobs.id) AS job_count
                    FROM companies
                    LEFT JOIN addresses ON addresses.company_id = companies.id
                    LEFT JOIN jobs ON jobs.address_id = addresses.id
                    GROUP BY companies.id, companies.company_name, companies.logo
                    ORDER BY job_count DESC
                    LIMIT 6
                ');
        //get 4 popular locations
        $popularStates = DB::table('states')
            ->select('states.id', 'states.name', 'states.image', DB::raw('COUNT(jobs.id) as job_count'))
            ->leftJoin('cities', 'states.id', '=', 'cities.state_id')
            ->leftJoin('addresses', 'cities.id', '=', 'addresses.city_id')
            ->leftJoin('jobs', 'addresses.id', '=', 'jobs.address_id')
            ->groupBy('states.id', 'states.name', 'states.image')
            ->orderByDesc('job_count')
            ->take(4)
            ->get();
        $categories = JobCategory::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $data = ["categories"=>$categories,"states"=>$states,"jobs" => $jobs, "popCategories" => $popularCategories, "companies" => $companies, "popularStates" => $popularStates];
        return view('index')->with("data", $data);
    }
    //get all jobs
    public function allJobs()
    {
        $jobs = Job::WhereDate('created_at', '>', Carbon::today()->subMonths(6))->orderBy('created_at', 'desc')->where('status', 'active')->paginate(5);
        return $this->showJobs($jobs);
    }
    //show jobs
    public function showJobs($jobs){        
        $categories = JobCategory::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $data = ["categories" => $categories, "states" => $states];
        return view('jobs')->with('data', $data)->with('jobs',$jobs);
    }
    //filter jobs by position,category,state
    public function filterJobs(Request $request)
    {
        $categoryId = $request->input('category');
        $stateId = $request->input('state');
        $jobs = [];
        if ($request->has('position')) {
            $position = $request->input("position");
            if ($categoryId == 0 && $stateId == 0) {
                $jobs = Job::where('title', 'like', "%{$position}%")->paginate(5);
            } else if ($categoryId == 0 && $stateId != 0) {
                $jobs = Job::whereHas('address.city.state', function ($query) use ($stateId) {
                    $query->where('id', '=', $stateId);
                })->where('title', 'like', "%{$position}%")->paginate(5);
            } else if ($categoryId != 0 && $stateId == 0) {
                $jobs = Job::where('job_category_id', $categoryId)->where('title', 'like', "%{$position}%")->paginate(5);
            } else {
                $jobs = Job::whereHas('address.city.state', function ($query) use ($stateId) {
                    $query->where('id', '=', $stateId);
                })->where('job_category_id', $categoryId)->where('title', 'like', "%{$position}%")->paginate(5);
            }
        } else {
            if ($categoryId == 0 && $stateId == 0) {
                $jobs = Job::paginate(5);
            } else if ($categoryId == 0 && $stateId != 0) {
                $jobs = Job::whereHas('address.city.state', function ($query) use ($stateId) {
                    $query->where('id', '=', $stateId);
                })->paginate(5);
            } else if ($categoryId != 0 && $stateId == 0) {
                $jobs = Job::where('job_category_id', $categoryId)->paginate(5);
            } else {
                $jobs = Job::whereHas('address.city.state', function ($query) use ($stateId) {
                    $query->where('id', '=', $stateId);
                })->where('job_category_id', $categoryId)->paginate(5);
            }
        }
        $categories = JobCategory::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $data = ["categories" => $categories, "states" => $states, "categoryId"=>$categoryId,"stateId"=>$stateId];
        if($request->has('position')){
           $data["position"] = $request->input('position');
        }     
        return view('jobs')->with('data', $data)->with('jobs',$jobs);
    }
    
    //get job information by id
    public function jobDetails($id)
    {
        $job = Job::find($id);
        return view('user-job-details')->with("job", $job);
    }
    //get company information by id
    public function companyDetails($id)
    {
        $company = Company::find($id);
        $jobs = Job::join('addresses', 'jobs.address_id', '=', 'addresses.id')
            ->where('addresses.company_id', '=', $id)
            ->where('jobs.created_at','>',Carbon::today()->subMonths(6))
            ->where('jobs.status', '=', 'active')
            ->select('jobs.*')
            ->get();
        
        $data = ["company" => $company, "jobs" => $jobs];
        return view('company-details')->with("data", $data);
    }
    //apply job function
    public function applyJobs(Request $request, $id)
    {
        $validator = validator(request()->all(), [
            'cvform' => 'required|mimes:doc,docx,pdf|max:5120',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $application = new Application();
        $count = Application::where('job_id', $id)->where('status', 'pending')->where('job_seeker_id', auth()->guard('jobseeker')->id())->count();
        if ($count > 0) {
            return redirect()->back()->with('error', 'you have already applied this job');
        }
        $application->job_id = $id;
        $application->job_seeker_id = auth()->guard('jobseeker')->id();
        $cvfile = time() . "." . $request->file('cvform')->getClientOriginalName();
        $request->cvform->move(public_path('applications'), $cvfile);
        $application->cvfile = $cvfile;
        $application->status = 'pending';
        $application->save();
        return view('jobs-applied-success');
    }
    //get jobs by state/location
    public function getJobsByState($stateId)
    {
        $jobs = Job::join('addresses', 'jobs.address_id', '=', 'addresses.id')
            ->join('cities', 'cities.id', '=', 'addresses.city_id')
            ->where('cities.state_id', '=', $stateId)
            ->where('jobs.status', '=', 'active')
            ->WhereDate('jobs.created_at', '>', Carbon::today()->subMonths(6))
            ->select('jobs.*')
            ->paginate(5);
        return $this->showJobs($jobs);
    }
    //get jobs by job category
    public function getJobsByCategory($categoryId)
    {
        $jobs = Job::where('job_category_id', $categoryId)->WhereDate('created_at', '>', Carbon::today()->subMonths(6))->where('status', 'active')->paginate(5);
        return $this->showJobs($jobs);
    }
    //get jobs of company
    public function getJobsByCompany($companyId)
    {
        $jobs = Job::join('addresses', 'jobs.address_id', '=', 'addresses.id')
            ->where('addresses.company_id', '=', $companyId)
            ->where('jobs.status', '=', 'active')
            ->WhereDate('jobs.created_at', '>', Carbon::today()->subMonths(6))
            ->select('jobs.*')
            ->paginate(5);
        return $this->showJobs($jobs);
    }
    //get jobs by industry
    public function getJobsByIndustry($industryId)
    {
        $jobs = Job::join('addresses', 'jobs.address_id', '=', 'addresses.id')
            ->join('companies', 'companies.id', '=', 'addresses.company_id')
            ->join('company_industry', 'company_industry.company_id', '=', 'companies.id')
            ->where('company_industry.industry_id', $industryId)
            ->where('jobs.status', '=', 'active')
            ->WhereDate('jobs.created_at', '>', Carbon::today()->subMonths(6))
            ->select('jobs.*')
            ->paginate(5);
        return $this->showJobs($jobs);
    }
    //get categories
    public function categories()
    {
        $categories = JobCategory::orderBy('name')->get();
        return view('categories')->with('categories', $categories);
    }
    //get locations
    public function locations()
    {
        $states = State::orderBy('name')->get();
        return view('locations')->with('locations', $states);
    }
    //get industries
    public function industries()
    {
        $industries = Industry::orderBy('name')->get();
        return view('industries')->with('industries', $industries);
    }
    //get companies
    public function companies()
    {
        $companies = Company::orderBy('company_name')->get();
        return view('companies')->with('companies', $companies);
    }
}