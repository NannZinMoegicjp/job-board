<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Industry;
use App\Models\Company;
use App\Models\Image;
use App\Models\Address;
use App\Models\JobSeeker;
class RegisterController extends Controller
{
    //show employer regristration form
    public function showEmployerRegisterForm(){
        $states = State::orderBy('name')->get();
        $industries = Industry::orderBy('name')->get();
        $data = ["states"=>$states,"industries"=>$industries];
        return view('company-register')->with("data",$data);
    }
    //insert employer data
    public function registerEmployer(Request $request){        
        $validator = validator(request()->all(), [
            'contactPerson'=>['bail','required','string','regex:/^[a-zA-Z]+( [a-zA-Z]+)*$/'],
            'userEmail'=> ['bail','required','string','email','unique:job_seekers,email','unique:companies,email','unique:admins,email'],
            'phone' => ['bail','required','regex:/^(\+?959|09)[0-9]{9}$/'],
            'password'=>['bail','required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'password_confirmation'=>['bail','required','same:password'],
            'comName'=>['bail','required','string'],
            'websiteLink'=>['bail','nullable','url','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
            'logofile' => ['bail','required','mimes:jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp','max:2048'],
            'images'=>['bail','nullable'],
            'images.*'=>['bail','mimes:jpeg,jpg,svg,gif,png','max:2048'],
            'address'=>['bail','required','string']
        ], [
            'contactPerson'=>'Name must contain alphabets only, no digits, no special characters',
            'userEmail'=>'User with this email already existed',
            'phone'=>'Phone number should start with 09/+959 and have a maximum length of 11 characters.',
            'password' => 'The password should contain at least 8 characters',
            'password_confirmation' => 'The password confirmation does not match.',
            'logofile'=>'File type for profile image should be one of jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp',
            'images'=>'Images file type should be one of jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $company = new Company();
            $company->contact_person = $request->input('contactPerson');
            $company->email = $request->input('userEmail');
            $company->phone = $request->input('phone');
            $company->password = Hash::make($request->input('password'));
            $company->company_name = $request->input('comName');
            if($request->has('estDate')){
                $company->established_date = $request->input('estDate');      
                }
            if($request->has('websiteLink')){
                    $company->websitelink = $request->input('websiteLink');
                }   
            $logoImg = time() . "." . $request->file('logofile')->getClientOriginalName();
            $request->logofile->move(public_path('images/companies'), $logoImg);
            $company->logo = $logoImg;                                  
            $company->no_of_employee = $request->input('size');
            $company->no_of_credit = 5;           
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
            return view('register-success');
    }
    //show job seeker regristration form
    public function showJobseekerRegisterForm(){
        return view('job-seeker-register');
    }
    //insert job seeker data
    public function registerJobseeker(Request $request){
        $validator = validator(request()->all(), [
            'userName'=>['bail','required','string','regex:/^[a-zA-Z]+( [a-zA-Z]+)*$/'],
            'userEmail'=> ['bail','required','string','email','unique:job_seekers,email','unique:companies,email','unique:admins,email'],
            'userPhoneNumber' => ['bail','required','regex:/^(\+?959|09)[0-9]{9}$/'],
            'dob' => ['bail','required','date','before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'password'=>['bail','required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'password_confirmation'=>['bail','required','same:password'],
            'profileImage' => ['bail','required','mimes:jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp','max:2048'],
        ],[
            'userName'=>'Name must contain alphabets only,  no digits, no special characters',
            'userEmail'=>'User with this email already existed',
            'userPhoneNumber'=>'Phone number should start with 09/+959 and have a length of 11 characters.',
            'dob'=>'you must be at least 18 years old',
            'password' => 'The password should contain at least 8 characters',
            'password_confirmation' => 'The password confirmation does not match.',
            'profileImage'=>'File type for profile image should be one of jpeg,jpg,svg,gif,png,tiff,jfif,bmp,webp'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }              
        $jobSeeker = new JobSeeker();
        $profileImg = time() . "." . $request->file('profileImage')->getClientOriginalName();
        $request->profileImage->move(public_path('images/jobseekers'), $profileImg);
        $jobSeeker->image = $profileImg;                
        $jobSeeker->name = $request->input('userName');
        $jobSeeker->email = $request->input('userEmail');
        $jobSeeker->phone = $request->input('userPhoneNumber');
        $jobSeeker->dob = $request->input('dob');
        $jobSeeker->gender = $request->input('gender');        
        $jobSeeker->address = $request->input('address');
        $jobSeeker->password = Hash::make($request->input('password'));
        $jobSeeker->save();
        return view('register-success');
    }
}