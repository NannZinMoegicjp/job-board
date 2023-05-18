<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Image;
use App\Models\Industry;
use App\Models\State;
use App\Models\Address;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CompanyController extends Controller
{
    //get all companies
    public function index()
    {
        $companies = Company::orderByDesc('created_at')->get();;
        return view('companies-manage')->with('companies', $companies);
    }
    //show change password form
    public function changePasswordForm(){
        return view('Employer.change-password');
    }
    //change password
    public function changePassword(Request $request){
        $userId = auth()->guard('employer')->id();
        $employer = Company::find($userId);                       
        if(Hash::check($request->input('currentPass'),$employer->password)){
            $validator = validator(request()->all(), [
                'password'=>['bail','required', 'string', 'min:8',  'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
                'password_confirmation'=>['required','same:password']
            ],[
                'password'=>'password must have 8 characters including one lowercase letter, one uppercase letter, one digit, and one
                special character',
                'password_confirmation'=>'password confirmation does not match'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } 
            if(Hash::check($request->input('password'),$employer->password)){
                return back()->with('newPassError','Current password and New password is same.Please use new one.')->withInput();
            }else{
                $employer->password = Hash::make($request->input('password'));
            }            
        }else{
            return back()->with('currentPassError','current password incorrect')->withInput();
        }        
        $employer->save();
        return view('Employer.change-password')->with('status', 'changed password successfully.');
    }
    //get company data to update
    public function updateSetData($id)
    {
        $company = Company::find($id);
        $industries = Industry::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $addresses = Address::where('company_id',$id)->get();
        return view('Employer.update-profile')->with('company', $company)->with('industries', $industries)->with('states', $states)->with('cities', $cities)->with('updateId', $id)->with('addresses', $addresses);
    }
    //update company data
    public function update(Request $request, $id)
    {
        $validator = validator(request()->all(), [
            'contactPerson'=>['required','string','regex:/^[a-zA-Z]+( [a-zA-Z]+)*$/'],
            'phone' => ['required','regex:/^(\+?959|09)[0-9]{9}$/'],
            'comName'=>['required','string'],
            'websiteLink'=>['nullable','url','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
            'address'=>['required','string']
        ], [
            'contactPerson.required'=>'Please fill contact person',
            'contactPerson.regex'=>'Contact person name must contain alphabets only', 
            'phone.required'=>'Please fill phone number',
            'phone.regex'=>'Phone number should start with 09/+959 and have a length of 11 characters',  
            'comName'=>'Please fill company name',
            'websiteLink'=>'Invalid website link,start with http:// or https://',
            'address'=>'Please fill address'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
       
        $company = Company::find($id);        
        $company->contact_person = $request->input('contactPerson');
        $company->phone = $request->input('phone');
        $company->company_name = $request->input('comName');        
        $company->websitelink = $request->input('websiteLink');        
        $city_id=$request->input('bCity');
        $add = Address::where('company_id',$id)->whereNotNull('detail_address')->first();
        if($add != null){
            $add->city_id = $request->input('city');
            $add->detail_address=$request->input('address');
            $add->save();
        }
        $company->no_of_employee = $request->input('size');
        $company->established_date = $request->input('estDate');
        $company->save();
        $request->session()->put('name',$company->company_name); 
        return redirect('/employer/profile')->with('status', "updated profile successfully");
    }
    //update company logo
    public function updateLogo(Request $request, $id){
        $company = Company::find($id);
        $validator = validator(request()->all(), [
            'newlogofile' => 'required|mimes:jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp|max:2048',
        ],[
            'newlogofile.required'=>'Please select new logo image',
            'newlogofile.mimes'=>'accept only jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp image',
            'newlogofile.max'=>'photo size should not greater than 2MB'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('newlogofile')) {
            if (file_exists(public_path('images/companies/' . $company->logo))) {
                unlink(public_path('images/companies/' . $company->logo));
            }
            $logoImg = time() . "." . $request->file('newlogofile')->getClientOriginalName();
            $request->newlogofile->move(public_path('images/companies'), $logoImg);
            $company->logo = $logoImg;
        }
        $company->save();
        $request->session()->put('logo',$company->logo);  
        return redirect('/employer/profile')->with('status', "updated logo successfully");
    }
    //add industry type to company
    public function addIndustry(Request $request,$cid){        
        $iids = DB::table('company_industry')->where('company_id', $cid)->pluck('industry_id')->toArray();
        $company = Company::find($cid);
        if(in_array($request->industry,$iids)){
            return redirect('/employer/profile/update/'.$cid)->with('error', "industry already existed"); 
        }
        $company->industries()->attach($request->industry);
        return redirect('/employer/profile')->with('status', "added industry successfully");
    }
    //delete industry of company
    public function deleteIndustry($cid,$iid){
        $company = Company::find($cid);       
        $company->industries()->detach($iid);
        return redirect('/employer/profile')->with('status', "removed industry successfully");
    }
    //delete branch city
    public function deleteBranchCity($cid,$addId){
        $add = Address::find($addId);
        $add->delete();
        return redirect('/employer/profile')->with('status', "removed branch city successfully");
    }
    //add branch city
    public function addBranchCity(Request $request,$cid){
        $city_id=$request->input('bcity');
        $rowCount = Address::where('city_id',$city_id)->where('company_id',$cid)->count();
        if($rowCount>0){
            return redirect('/employer/profile/update/'.$cid)->with('status', "branch city already existed"); 
        }
        $add = new Address();
        $add->city_id=$city_id;
        $add->detail_address='';
        $add->company_id=$cid;
        $add->save();
        return redirect('/employer/profile')->with('status', "added branch city successfully");
    }
    //delete image from company images
    public function removeImage($cid,$imageId){
        $image=Image::find($imageId);
        $image->delete();
        return redirect('/employer/profile')->with('status', "deleted image successfully");
    }
    //add company image
    public function addImages(Request $request,$cid){
        $validator = validator(request()->all(), [
            'newPhotos'=>'required',
            'newPhotos.*' => 'required|mimes:jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp|max:2048',
        ],[
            'newPhotos.required'=>'Please select new photos',
            'newPhotos.max'=>'photo size should not greater than 2MB'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        foreach ($request->file('newPhotos') as $key => $image) {
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images/companies'), $imageName);
            $img = new Image();
            $img->name = $imageName;
            $img->company_id = $cid;
            $img->save();
        }
        return redirect('/employer/profile')->with('status', "added images successfully");
    }
    //delete company by admin
    public function delete($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect('/admin/companies')->with('status', "deleted company successfully");
    }
    //view company details(by admin)
    public function viewDetails($id)
    {
        $company = Company::find($id);
        $addrIDs = DB::table('addresses')->where('company_id', $id)->pluck('id')->toArray();
        $jobCount = Job::whereIn('address_id', $addrIDs)->count();
        return view('admin-company-detail')->with(['company'=> $company,'jobCount'=>$jobCount]);
    }
    //view profile by company
    public function viewProfile()
    {
        $id = auth()->guard('employer')->id();
        $company = Company::find($id);
        $addresses = Address::where('company_id',$id)->get();
        $addrIDs = DB::table('addresses')->where('company_id', $id)->pluck('id')->toArray();
        $jobCount = Job::whereIn('address_id', $addrIDs)->count();
        return view('Employer.profile')->with(['company'=> $company,'addresses'=> $addresses,'jobCount'=>$jobCount]);
    }
    //show add credit form (by admin)
    public function getCreditData($id){
        $company = Company::find($id);
        return view('add-credit')->with('company',$company);
    }
    //add credit to company credit(by admin)
    public function addCredit(Request $request,$id){
        $company = Company::find($id);
        $company->no_of_credit += $request->input('noOfCredit');
        $company->save();
        return redirect('/admin/company/details/'.$id)->with('company',$company)->with('status',$request->input('noOfCredit')." credits added");
    }
    
}
