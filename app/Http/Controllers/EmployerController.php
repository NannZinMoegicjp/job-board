<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CreditPrice;
use App\Models\PaymentMethod;
use App\Models\PaymentAccount;
use App\Models\Order;
use App\Models\OrderConfirmation;
use App\Models\Address;
use App\Models\Job;
use App\Models\Application;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
class EmployerController extends Controller
{
    //when employer log in, call this method and show employer dashboard
    public function index(Request $request){
        $userId=0;
        if (auth()->guard('employer')->check()) {
            $userId = auth()->guard('employer')->id();
        }
        $company = Company::find($userId);
        $request->session()->put('logo',$company->logo);  
        $applications = DB::table('applications')
            ->join('jobs', 'jobs.id', '=', 'applications.job_id')
            ->join('addresses', 'addresses.id', '=', 'jobs.address_id')
            ->where('addresses.company_id', auth()->guard('employer')->id())   
            ->select('applications.id')            
            ->count();
        $addrIDs = Address::select('id')->where('company_id',  auth()->guard('employer')->id())->get();
        $activeJob = Job::where('status','active')->where('created_at','>',Carbon::today()->subMonths(6))->whereIn('address_id',$addrIDs)->count();
        $inactiveJobs = Job::WhereDate('created_at','<',Carbon::today()->subMonths(6))->orWhere('status','inactive')->whereIn('address_id',$addrIDs)->count();        
        $count = ["activeJobs"=>$activeJob,"inactiveJob"=>$inactiveJobs,"credits"=>$company->no_of_credit,"applications"=>$applications];
        return view('Employer.index')->with('count',$count);
    }   
    //get latest price and show form to buy credit
    public function buyCreditGet(Request $request){
        $company = Company::find( auth()->guard('employer')->id());
        $creditPrice = CreditPrice::whereNull('updated_at')->first();
        if($creditPrice == null){
            return redirect('/employer')->with('status','credit not available yet');
        }
        $paymentMethods = PaymentMethod::get();
        $paymentAccounts = PaymentAccount::get();
        $data = ['company'=>$company,'creditPrice'=>$creditPrice,'paymentMethods'=>$paymentMethods,'paymentAccounts'=>$paymentAccounts];
        return view('Employer.buy-credit')->with('data',$data);
    }
    //buy credit
    public function buyCredit(Request $request){
        $company = Company::find(auth()->guard('employer')->id());
        $order = new Order();
        $order->payment_account_id = $request->input('paymentAccount');
        $order->company_id =  auth()->guard('employer')->id();
        $order->credit_price_id = $request->input('priceId');
        $order->no_of_credit = $request->input('noOfCredit');
        $validator = validator(request()->all(), [
            'screenshot' => 'mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $screenshot = time() . "." . $request->file('screenshot')->getClientOriginalName();
        $request->screenshot->move(public_path('images/payment_screenshots'), $screenshot);
        $order->screenshot = $screenshot;
        $order->save();
        return redirect('/employer/buy/credit')->with('status','your purchase has been made. please wait for confirmation.');
    }
    //get all applications to jobs of company
    public function getApplications(Request $request){
        $addrIDs = Address::select('id')->where('company_id',  auth()->guard('employer')->id())->get();
        $jobIDs = Job::select('id')->whereIn('address_id', $addrIDs)->where('status','active')->get();
        $applications = Application::whereIn('job_id', $jobIDs)->where('status','pending')->get();
        return view('Employer.applications-manage')->with('applications',$applications);
    }
    //reject application
    public function reject($id){
        $application = Application::find($id);
        $application->status = 'rejected';
        $application->save();
        return redirect()->route('applications')->with('status','rejected application');
    }
    //shortlist application
    public function shortlist($id){
        $application = Application::find($id);
        $application->status = 'shortlisted';
        $application->save();
        return redirect()->route('applications')->with('status','shortlisted application');
    }
    //get shortlisted applications
    public function shortlistedApplications(Request $request){
        $addrIDs = Address::select('id')->where('company_id',  auth()->guard('employer')->id())->get();
        $jobIDs = Job::select('id')->whereIn('address_id', $addrIDs)->where('status','active')->get();
        $applications = Application::whereIn('job_id', $jobIDs)->where('status','shortlisted')->get();
        return view('Employer.shortlisted-applications')->with('applications',$applications);
    }
    //get rejected applications
    public function rejectedApplications(Request $request){
        $addrIDs = Address::select('id')->where('company_id',  auth()->guard('employer')->id())->get();
        $jobIDs = Job::select('id')->whereIn('address_id', $addrIDs)->where('status','active')->get();
        $applications = Application::whereIn('job_id', $jobIDs)->where('status','rejected')->get();
        return view('Employer.rejected-applications')->with('applications',$applications);
    }
}
