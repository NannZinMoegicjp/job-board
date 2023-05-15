<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Application;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobSeeker;
use App\Models\Order;
use App\Models\OrderConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashBoardController extends Controller
{
    //to get data for admin dashboard
    public function index(Request $request)
    {
        $userId = 0;
        if (auth()->guard('admin')->check()) {
            $userId = auth()->guard('admin')->id();
            $admin = Admin::find($userId);
        }
        $jobSeekerCount = JobSeeker::count();
        $applicationCount = Application::count();
        $companyCount = Company::count();
        $jobCount = Job::where('status', 'active')->count();
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrderCount = Order::whereNotIn('id', $confirmedOrderedIds)->count();
        $count = ["activeJobs" => $jobCount, "companies" => $companyCount, "awaitOrders" => $awaitingOrderCount, "jobSeekers" => $jobSeekerCount, "applications" => $applicationCount];
        $months = collect([
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ]);
        //top 10 hiring companies
        $topHiringCompanies = Company::select('company_name', 'companies.id', DB::raw('COUNT(*) as job_count'))
            ->join('addresses', 'companies.id', '=', 'addresses.company_id')
            ->join('jobs', 'addresses.id', '=', 'jobs.address_id')
            ->groupBy('companies.id', 'company_name')
            ->orderByDesc('job_count', 'company_name')
            ->limit(10)
            ->get();
        // get credit sold by start date and end date
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $end_datetime = date('Y-m-d H:i:s', strtotime($endDate.' 23:59:59'));
        $type = $request->type;
        if ($startDate && $endDate) {
            if($type == 1){
                $creditSold = OrderConfirmation::selectRaw('Date(order_confirmations.created_at) as daily, SUM(orders.no_of_credit) as total_credit_point_sold')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereBetween('order_confirmations.created_at', [$startDate, $end_datetime])
                ->where('is_confirmed',1)
                ->groupBy('daily')
                ->orderByDesc('daily')
                ->get();
                
            }elseif($type == 3){
                $creditSold = OrderConfirmation::selectRaw('Year(order_confirmations.created_at) as year, SUM(orders.no_of_credit) as total_credit_point_sold')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereBetween('order_confirmations.created_at', [$startDate, $end_datetime])
                ->where('is_confirmed',1)
                ->groupBy('year')
                ->orderByDesc('year')
                ->get();      
            }else{
                $creditSold = OrderConfirmation::selectRaw('MONTHNAME(order_confirmations.created_at) as month, SUM(orders.no_of_credit) as total_credit_point_sold')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereBetween('order_confirmations.created_at', [$startDate, $end_datetime])
                ->where('is_confirmed',1)
                ->groupBy('month')
                ->orderByDesc('month')
                ->get();                
            }           
        } else {
            $creditSold = OrderConfirmation::selectRaw(' MONTHNAME(order_confirmations.created_at) as month, SUM(orders.no_of_credit) as total_credit_point_sold')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereYear('order_confirmations.created_at', '=', date('Y'))
                ->groupBy('month')
                ->get();
        }
        // get sales amount by start date and end date
        $startDateSale = $request->start_dateSale;
        $endDateSale = $request->end_dateSale;
        $end_datetimeSale = date('Y-m-d H:i:s', strtotime($endDateSale.' 23:59:59'));
        $typeSale = $request->typeSale;
        if ($startDateSale && $endDateSale){
            if($typeSale == 1){
                $sales = OrderConfirmation::selectRaw(' Date(order_confirmations.created_at) as daily, SUM(credit_prices.price * orders.no_of_credit) as total_sale')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereBetween('order_confirmations.created_at', [$startDateSale,$end_datetimeSale])
                ->where('is_confirmed', 1)
                ->groupBy('daily')
                ->orderByDesc('daily')
                ->get();
            }elseif($typeSale == 3){
                $sales = OrderConfirmation::selectRaw(' Year(order_confirmations.created_at) as year, SUM(credit_prices.price * orders.no_of_credit) as total_sale')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereBetween('order_confirmations.created_at', [$startDateSale,$end_datetimeSale])
                ->where('is_confirmed', 1)
                ->groupBy('year')
                ->orderByDesc('year')
                ->get();
            }else{
                $sales = OrderConfirmation::selectRaw(' MONTHNAME(order_confirmations.created_at) as month, SUM(credit_prices.price * orders.no_of_credit) as total_sale')
                ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
                ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
                ->whereBetween('order_confirmations.created_at', [$startDateSale,$end_datetimeSale])
                ->where('is_confirmed', 1)
                ->groupBy('month')
                ->orderByDesc('month')
                ->get();
                // $sales = $months->map(function ($month) use ($sales) {
                // $result = $sales->firstWhere('month', $month);
                // return $result ?? (object) ['month' => $month, 'total_sale' => 0];});
            }
        }else{
            $sales = OrderConfirmation::selectRaw(' MONTHNAME(order_confirmations.created_at) as month, SUM(credit_prices.price * orders.no_of_credit) as total_sale')
            ->join('orders', 'order_confirmations.order_id', '=', 'orders.id')
            ->join('credit_prices', 'orders.credit_price_id', '=', 'credit_prices.id')
            ->whereYear('order_confirmations.created_at', '=', date('Y'))
            ->where('is_confirmed', 1)
            ->groupBy('month')
            ->orderByDesc('month')
            ->get();
        }   
        //top 10 job categories     
        $categories = JobCategory::join('jobs', 'job_categories.id', '=', 'jobs.job_category_id')
            ->select('job_categories.name', DB::raw('COUNT(*) as job_count'))
            ->groupBy('job_categories.id', 'job_categories.name')
            ->orderByDesc('job_count')
            ->limit(10)
            ->get();        
        $creditData = ["startDate" => $startDate, "endDate" => $endDate,"type"=>$type , "creditSold" => $creditSold];
        $salesData = ["startDate" => $startDateSale, "endDate" => $endDateSale,"type"=>$typeSale , "sales" => $sales];
        
        $data = ["creditData"=>$creditData, "salesData" => $salesData, "topHiringCompanies" => $topHiringCompanies];
        return view('dashboard')->with('count', $count)->with('data', $data);
    }
}
