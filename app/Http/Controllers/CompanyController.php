<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Image;
use App\Models\Industry;
use App\Models\State;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies-manage')->with('companies', $companies);
    }
    public function insertGet()
    {
        $industries = Industry::all();
        $states = State::all();
        $cities = City::all();
        return view('add-update-company')->with('industries', $industries)->with('states', $states)->with('cities', $cities);
    }
    public function insert(Request $request)
    {
        // if (Company::where('email', $request->input('userEmail'))->count() > 0) {
        //     return back()->withErrors(['emailError' => 'email already existed. choose another email'])->withInput();
        // }
        $company = new Company();
        $validator = validator(request()->all(), [
            'logofile' => 'mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $company->contact_person = $request->input('contactPerson');
        $company->email = $request->input('userEmail');
        $company->phone = $request->input('phone');
        $company->password = "12345678";
        $company->company_name = $request->input('comName');
        $logoImg = time() . "." . $request->file('logofile')->getClientOriginalName();
        $request->logofile->move(public_path('images/companies'), $logoImg);
        $company->logo = $logoImg;
        $company->websitelink = $request->input('websiteLink');      
        $company->no_of_employee = $request->input('size');
        $company->established_date = $request->input('estDate');
        $company->save();
        $company->industries()->attach($request->input('industry'));
        if ($request->file('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('images/companies'), $imageName);
                $img = new Image();
                $img->name = $imageName;
                $img->company_id = $company->id;
                $img->save();
            }
        }
        $add = new Address();
        $add->city_id=$request->input('city');
        $add->detail_address=$request->input('address');
        $add->company_id=$company->id;
        $add->save();
        foreach($request->input('cities') as $city){
            $add = new Address();
            $add->city_id=$city;
            $add->detail_address='';
            $add->company_id=$company->id;
            $add->save();
        }
        return redirect('/admin/companies')->with('status', "added successfully");
    }
    public function updateSetData($id)
    {
        $company = Company::find($id);
        $industries = Industry::all();
        $states = State::all();
        $cities = City::all();
        $addresses = Address::where('company_id',$id)->get();
        return view('add-update-company')->with('company', $company)->with('industries', $industries)->with('states', $states)->with('cities', $cities)->with('updateId', $id)->with('addresses', $addresses);
    }
    public function update(Request $request, $id)
    {
        $company = Company::find($id);        
        $company->contact_person = $request->input('contactPerson');
        $company->phone = $request->input('phone');
        $company->company_name = $request->input('comName');
        $company->websitelink = $request->input('websiteLink');        
        $city_id=$request->input('bCity');
        $add = Address::where('city_id',$city_id)->where('company_id',$id)->first();
        if($add != null){
            $add->detail_address=$request->input('address');
        }else{
            $add = new Address();
            $add->city_id=$request->input('city');
            $add->detail_address=$request->input('address');
            $add->company_id=$company->id;
        }        
        $add->save();
        $company->no_of_employee = $request->input('size');
        $company->established_date = $request->input('estDate');
        $company->save();
        return redirect('/admin/companies')->with('status', "updated company successfully");
    }
    public function updateLogo(Request $request, $id){
        $company = Company::find($id);
        $validator = validator(request()->all(), [
            'newlogofile' => 'mimes:jpeg,jpg,svg,gif,png|max:20',
        ]);
        if ($request->hasFile('newlogofile')) {
            if (file_exists(public_path('images/companies/' . $company->logo))) {
                unlink(public_path('images/companies/' . $company->logo));
            }
            $logoImg = time() . "." . $request->file('newlogofile')->getClientOriginalName();
            $request->newlogofile->move(public_path('images/companies'), $logoImg);
            $company->logo = $logoImg;
        }
        $company->save();
        return redirect('/admin/company/update/'.$id)->with('status', "updated logo successfully");
    }
    public function addIndustry(Request $request,$cid){        
        $iids = DB::table('company_industry')->where('company_id', $cid)->pluck('industry_id')->toArray();
        $company = Company::find($cid);
        if(in_array($request->industry,$iids)){
            return redirect('/admin/company/update/'.$cid)->with('status', "industry already existed"); 
        }
        $company->industries()->attach($request->industry);
        return redirect('/admin/company/update/'.$cid)->with('status', "added industry successfully");
    }
    public function deleteIndustry($cid,$iid){
        $company = Company::find($cid);
        $company->industries()->detach($iid);
        return redirect('/admin/company/update/'.$cid)->with('status', "removed industry successfully");
    }
    public function deleteBranchCity($cid,$addId){
        $add = Address::find($addId);
        $add->delete();
        return redirect('/admin/company/update/'.$cid)->with('status', "removed branch city successfully");
    }
    public function addBranchCity(Request $request,$cid){
        $city_id=$request->input('bCity');
        $rowCount = Address::where('city_id',$city_id)->where('company_id',$cid)->count();
        if($rowCount>0){
            return redirect('/admin/company/update/'.$cid)->with('status', "branch city already existed"); 
        }
        $add = new Address();
        $add->city_id=$city_id;
        $add->detail_address='';
        $add->company_id=$cid;
        $add->save();
        return redirect('/admin/company/update/'.$cid)->with('status', "added branch city successfully");
    }
    public function removeImage($cid,$imageId){
        $image=Image::find($imageId);
        $image->delete();
        return redirect('/admin/company/update/'.$cid)->with('status', "delete image successfully");
    }
    public function addImages(Request $request,$cid){
        $validator = validator(request()->all(), [
            'newPhotos'=>'required',
            'newPhotos.*' => 'required|mimes:jpeg,jpg,svg,gif,png|max:2048',
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
        return redirect('/admin/company/update/'.$cid)->with('status', "added images successfully");
    }
    public function delete($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect('/admin/companies')->with('status', "deleted successfully");
    }
    public function viewDetails($id)
    {
        $company = Company::find($id);
        $addresses = Address::where('company_id',$id)->get();
        return view('admin-company-detail')->with('company', $company)->with('addresses', $addresses);
    }
}
