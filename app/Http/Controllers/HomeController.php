<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Company;
use App\Models\Industry;
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
    $industries =  DB::table('industries')
    ->select('industries.*', 
             DB::raw('(SELECT SUM(jobs_count) AS jobs_count
                       FROM companies
                       LEFT JOIN addresses ON companies.id = addresses.company_id
                       LEFT JOIN (
                           SELECT COUNT(*) AS jobs_count, address_id
                           FROM jobs
                           GROUP BY address_id
                       ) j ON addresses.id = j.address_id
                       INNER JOIN company_industry ON companies.id = company_industry.company_id
                       WHERE company_industry.industry_id = industries.id
                       GROUP BY companies.id) AS companies_count'),
             DB::raw('(SELECT COUNT(*) as total_jobs
                       FROM jobs
                       INNER JOIN addresses ON jobs.address_id = addresses.id
                       INNER JOIN companies ON addresses.company_id = companies.id
                       INNER JOIN company_industry ON companies.id = company_industry.company_id
                       WHERE company_industry.industry_id = industries.id) AS total_jobs'))
    ->orderByDesc('companies_count')
    ->take(4)
    ->get();
    $states =    DB::table('states')
    ->select('states.id','states.name','states.image', DB::raw('COUNT(jobs.id) as job_count'))
    ->leftJoin('cities', 'states.id', '=', 'cities.state_id')
    ->leftJoin('addresses', 'cities.id', '=', 'addresses.city_id')
    ->leftJoin('jobs', 'addresses.id', '=', 'jobs.address_id')
    ->groupBy('states.id','states.name','states.image')
    ->orderByDesc('job_count')
    ->take(4)
    ->get();
    $categories = Categories::orderBy('name')->get();
    $categories = ::orderBy('name')->get();
        $data = ["jobs"=>$jobs,"popCategories"=>$popularCategories,"companies"=>$companies,"industries"=>$industries,"states"=>$states];
        return view('index')->with("data",$data);
    }
}