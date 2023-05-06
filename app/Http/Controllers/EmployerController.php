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
class EmployerController extends Controller
{
    public function index(Request $request){
        $company = Company::find(2);
        $request->session()->put('id',$company->id);     
        $request->session()->put('logo',$company->logo);  
        $request->session()->put('name',$company->company_name);
        $applications = DB::table('applications')
            ->join('jobs', 'jobs.id', '=', 'applications.job_id')
            ->join('addresses', 'addresses.id', '=', 'jobs.address_id')
            ->where('addresses.company_id',$request->session()->get('id'))   
            ->select('applications.id')            
            ->count();
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->whereNull('deleted_at')->get();
        $activeJob = Job::whereIn('address_id',$addrIDs)->where('status','active')->where('created_at','>',Carbon::today()->subMonths(6))->count();
        $inactiveJobs = Job::whereIn('address_id',$addrIDs)->WhereDate('created_at','<',Carbon::today()->subMonths(6))->orWhere('status','inactive')->count();        
        $count = ["activeJobs"=>$activeJob,"inactiveJob"=>$inactiveJobs,"credits"=>$company->no_of_credit,"applications"=>$applications];
        return view('Employer.index')->with('count',$count);
    }
    public function buyCreditGet(Request $request){
        $company = Company::find($request->session()->get('id'));
        $creditPrice = CreditPrice::whereNull('deleted_at')->first();
        $paymentMethods = PaymentMethod::whereNull('deleted_at')->get();
        $paymentAccounts = PaymentAccount::whereNull('deleted_at')->get();
        $data = ['company'=>$company,'creditPrice'=>$creditPrice,'paymentMethods'=>$paymentMethods,'paymentAccounts'=>$paymentAccounts];
        return view('Employer.buy-credit')->with('data',$data);
    }
    public function buyCredit(Request $request){
        $company = Company::find($request->session()->get('id'));
        $order = new Order();
        $order->payment_account_id = $request->input('paymentAccount');
        $order->company_id = $request->session()->get('id');
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
        return redirect('/employer/buy/credit')->with('status','your order has been sent');
    }
    public function getApplications(Request $request){
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->whereNull('deleted_at')->get();
        $jobIDs = Job::select('id')->whereIn('address_id', $addrIDs)->whereNull('deleted_at')->where('status','active')->get();
        $applications = Application::whereIn('job_id', $jobIDs)->whereNull('status')->whereNull('deleted_at')->get();
        // return $applications;
        // $applications = DB::table('applications')
        //     ->select('applications.*')
        //     ->join('jobs', 'jobs.id', '=', 'applications.id')
        //     ->join('addresses', 'addresses.id', '=', 'jobs.address_id')
        //     ->join('companies', 'companies.id', '=', 'addresses.company_id')
        //     ->where('companies.id',$request->session()->get('id'))            
        //     ->get();
        return view('Employer.applications-manage')->with('applications',$applications);
    }
    public function reject($id){
        $application = Application::find($id);
        $application->status = 'reject';
        $application->save();
        return redirect()->route('applications')->with('status','rejected application');
    }
    public function shortlist($id){
        $application = Application::find($id);
        $application->status = 'shortlist';
        $application->save();
        return redirect()->route('applications')->with('status','shortlisted application');
    }
    public function shortlistedApplications(Request $request){
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->whereNull('deleted_at')->get();
        $jobIDs = Job::select('id')->whereIn('address_id', $addrIDs)->whereNull('deleted_at')->where('status','active')->get();
        $applications = Application::whereIn('job_id', $jobIDs)->where('status','shortlist')->whereNull('deleted_at')->get();
        return view('Employer.shortlisted-applications')->with('applications',$applications);
    }
    public function rejectedApplications(Request $request){
        $addrIDs = Address::select('id')->where('company_id', $request->session()->get('id'))->whereNull('deleted_at')->get();
        $jobIDs = Job::select('id')->whereIn('address_id', $addrIDs)->whereNull('deleted_at')->where('status','active')->get();
        $applications = Application::whereIn('job_id', $jobIDs)->where('status','reject')->whereNull('deleted_at')->get();
        return view('Employer.rejected-applications')->with('applications',$applications);
    }
}
