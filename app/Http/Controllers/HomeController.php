<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Company;
use DB;
class HomeController extends Controller
{
    public function index(){
        $jobs = Job::orderBy('created_at','desc')->limit(8)->get();
        $popularCategories = JobCategory::join('jobs', 'job_categories.id', '=', 'jobs.job_category_id')
        ->groupBy('job_categories.id', 'job_categories.name','job_categories.image')
        ->orderByRaw('COUNT(jobs.id) DESC')
        ->take(6)
        ->select('job_categories.id', 'job_categories.name', 'job_categories.image',DB::raw('COUNT(jobs.id) as job_count'))
        ->get();
        $companies = DB::select('
        SELECT companies.id, companies.company_name, companies.logo,COUNT(jobs.id) AS job_count
        FROM companies
        JOIN addresses ON addresses.company_id = companies.id
        JOIN jobs ON jobs.address_id = addresses.id
        GROUP BY companies.id, companies.company_name, companies.logo
        ORDER BY job_count DESC
        LIMIT 10
    ');
        // return $companies;
        $data = ["jobs"=>$jobs,"popCategories"=>$popularCategories,"companies"=>$companies];
        return view('index')->with("data",$data);
    }
}