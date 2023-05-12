<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Order;
use App\Models\JobSeeker;
use App\Models\Job;
use App\Models\Admin;
use App\Models\JobCategory;
use App\Models\Application;
use App\Models\OrderConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class AdminDashBoardController extends Controller
{
    public function index(Request $request){
        $userId=0;
        if (auth()->check()) {
            $userId = auth()->id();
            $admin = Admin::find($userId);
            $request->session()->put('role','admin');
            $request->session()->put('adminId',$admin->id);
            $request->session()->put('email',$admin->email);
            $request->session()->put('name',$admin->name);
        }       
        $companyCount = Company::whereDate('created_at', Carbon::today())->count();
        $jobSeekerCount = JobSeeker::count();
        $applicationCount = Application::count();
        $companyCount = Company::count();
        $jobCount = Job::where('status','active')->count();
        $confirmedOrderCount = OrderConfirmation::count();
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrderCount = Order::whereNotIn('id', $confirmedOrderedIds)->count();
        $count = ["activeJobs"=>$jobCount,"companies"=>$companyCount,"conOrders"=>$confirmedOrderCount,"awaitOrders"=>$awaitingOrderCount,"jobSeekers"=>$jobSeekerCount,"applications"=>$applicationCount];
        return view('dashboard')->with('count',$count);
    }
    public function reports(Request $request){

             $companies = Company::select('company_name', 'companies.id', DB::raw('COUNT(*) as job_count'))
            
             ->join('addresses', 'companies.id', '=', 'addresses.company_id')
            
             ->join('jobs', 'addresses.id', '=', 'jobs.address_id')
            
             ->groupBy('companies.id', 'company_name')
            
             ->orderByDesc('job_count','company_name')
            
             ->limit(10)
            
             ->get();
            
             // return $companies;
            
            
            
            
             $categories = JobCategory::join('jobs', 'job_categories.id', '=', 'jobs.job_category_id')
            
               ->select('job_categories.name', DB::raw('COUNT(*) as job_count'))
            
               ->groupBy('job_categories.id', 'job_categories.name')
            
               ->orderByDesc('job_count')
            
               ->limit(10)
            
               ->get();
                 
            // return $categories;
          
            // total sales monthly(for current year)
            $monthlySales = OrderConfirmation::selectRaw('YEAR(order_confirmations.created_at) as year, MONTH(order_confirmations.created_at) as month, SUM(credit_prices.price * orders.no_of_credit) as total_sale')
                            ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                            ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                            ->whereYear('order_confirmations.created_at', '=', date('Y'))
                            ->groupBy('year','month')
                            ->orderByDesc('month')
                            ->get();
            
            // return $monthlySales;
            // number of credit sold monthly(for current year)
            $monthlySales = OrderConfirmation::selectRaw(' MONTH(order_confirmations.created_at) as month, SUM(orders.no_of_credit) as total_credit_point_sold')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereYear('order_confirmations.created_at', '=', date('Y'))
                ->groupBy( 'month')
                ->orderByDesc('month')
                ->get();
            return $monthlySales;
             
    }
}