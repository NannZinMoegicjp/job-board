<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Order;
use App\Models\JobSeeker;
use App\Models\Job;
use App\Models\Application;
use App\Models\OrderConfirmation;
class AdminDashBoardController extends Controller
{
    public function index(){
        $companyCount = Company::where('deleted_at', NULL)->count();
        $jobSeekerCount = JobSeeker::where('deleted_at', NULL)->count();
        $applicationCount = Application::where('deleted_at', NULL)->count();
        $companyCount = Company::where('deleted_at', NULL)->count();
        $jobCount = Job::where('deleted_at', NULL)->count();
        $confirmedOrderCount = OrderConfirmation::where('deleted_at', NULL)->count();
        $confirmedOrderedIds = OrderConfirmation::select('order_id')->get();
        $awaitingOrderCount = Order::whereNotIn('id', $confirmedOrderedIds)->where('deleted_at', NULL)->count();
        $count = ["activeJobs"=>$jobCount,"companies"=>$companyCount,"conOrders"=>$confirmedOrderCount,"awaitOrders"=>$awaitingOrderCount,"jobSeekers"=>$jobSeekerCount,"applications"=>$applicationCount];
        return view('dashboard')->with('count',$count);
    }
}
