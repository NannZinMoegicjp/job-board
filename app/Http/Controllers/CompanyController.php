<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Image;
use App\Models\Industry;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        if (Company::where('email', $request->input('userEmail'))->count() > 0) {
            return back()->withErrors(['emailError' => 'email already existed. choose another email'])->withInput();
        }
        $company = new Company();
        $validator = validator(request()->all(), [
            'userEmail' => 'required|',
            'logofile' => 'required|mimes:jpeg,jpg,svg,gif,png|max:2048',

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
        $company->city_id = $request->input('city');
        $company->address = $request->input('address');
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
        return redirect('/admin/companies')->with('status', "registered successfully");
    }
    public function updateSetData($id)
    {
        $company = Company::find($id);
        $industries = Industry::all();
        $states = State::all();
        $cities = City::all();
        return view('add-update-company')->with('company', $company)->with('industries', $industries)->with('states', $states)->with('cities', $cities)->with('updateId', $id);
    }
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $validator = validator(request()->all(), [
            'logofile' => 'mimes:jpeg,jpg,svg,gif,png|max:20',
            'images.*' => 'mimes:jpeg,jpg,svg,gif,png|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $company->contact_person = $request->input('contactPerson');
        $company->phone = $request->input('phone');
        $company->company_name = $request->input('comName');
        if ($request->hasFile('logofile')) {
            if (file_exists(public_path('images/companies/' . $company->logo))) {
                unlink(public_path('images/companies/' . $company->logo));
            }
            $logoImg = time() . "." . $request->file('logofile')->getClientOriginalName();
            $request->logofile->move(public_path('images/companies'), $logoImg);
            $company->logo = $logoImg;
        }
        $company->websitelink = $request->input('websiteLink');
        $company->city_id = $request->input('city');
        $company->address = $request->input('address');
        $company->no_of_employee = $request->input('size');
        $company->established_date = $request->input('estDate');
        $company->save();
        $company->industries()->detach();
        $company->industries()->attach($request->input('industry'));
        return redirect('/admin/companies')->with('status', "updated successfully");
    }
    public function delete($id)
    {
        $company = Company::find($id);
        $company->delete();
        $companies = Company::all();        
        return redirect('/admin/companies')->with('status', "deleted successfully");
    }
    public function viewDetails($id)
    {
        $company = Company::find($id);
        return view('admin-company-detail')->with('company', $company);
    }
}
