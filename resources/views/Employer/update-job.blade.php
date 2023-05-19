@extends('Employer.master_employer')
@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/css/multistepFormStyle.css')}}" />
<x-head.tinymce-config />
@endsection
@section('content')
<div class="row text-end my-2">
    <a href="{{url('/employer/jobs')}}">job list<i class="bi bi-arrow-right"></i></a>
</div>
@if (session('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif
@php
$job = $data['job'];
@endphp
<h3 class="text-center" id="update">Update job</h3>
<form id="signUpForm" action="{{url('/employer/job/update/'.$job->id)}}" method="post">
    @csrf
    <!-- start step indicators -->
    <div class="form-header d-flex mb-4">
        <span class="stepIndicator">Job information</span>
        <span class="stepIndicator">Description</span>
        <span class="stepIndicator">Requirements</span>
        <span class="stepIndicator">Benefits</span>
    </div>
    <!-- end step indicators -->

    <!-- step one -->
    <div class="step">
        <p class="text-center mb-4">Job detial information</p>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="title">Title</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="text" class="form-control" required name="title" id="title" value="{{$job->title}}"
                    oninput="this.className = 'form-control'">                
                    <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please fill title</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="minSalary">Min Salary per month</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" required name="minSalary" id="minSalary"
                    value="{{$job->min_salary}}" oninput="this.className = 'form-control'">
                    <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please fill minimum salary</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="maxSalary">Max Salary per month</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" required name="maxSalary" id="maxSalary"
                    value="{{$job->max_salary}}" oninput="this.className = 'form-control'">
                    <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please fill maximum salary</strong></span>
                </span>
                <span class="invalid-feedback d-none" id="salaryError">
                    <span class="text-danger"><strong>Maximum salary should not less than minimum salary</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="openPosition">Open position</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" id="openPosition" name="openPosition"
                    value="{{$job->open_position}}" oninput="this.className = 'form-control'">
                    <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please fill open position</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label>Gender</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <div class="d-flex">
                @if($job->gender == 'both')
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" value="female" id="female" name="female" checked>
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="male" id="male" name="male" checked>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                @elseif($job->gender == 'female')
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" value="female" id="female" name="female" checked>
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="male" id="male" name="male">
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                @else
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" value="female" id="female" name="female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="male" id="male" name="male" checked>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                @endif
                </div>
                <div class="invalid-feedback d-none" id="genderError">
                    <span class="text-danger"><strong>Please check one of female,male </strong></span>
                </div>
            </div>
            
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="jobCategory">Job Category</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="jobCategory" id="jobCategory" class="form-select">
                    @if(isset($data['jobCategories']))
                    @foreach ($data['jobCategories'] as $jobCat)
                    @if($job->job_category_id == $jobCat->id)
                    <option value="{{$jobCat['id']}}" selected>{{$jobCat['name']}}</option>
                    @else
                    <option value="{{$jobCat['id']}}">{{$jobCat['name']}}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
                <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please select category</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="expLevel">Experience level</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="expLevel" id="expLevel" class="form-select">
                    @if(isset($data['expLevels']))
                    @foreach ($data['expLevels'] as $expLev)
                    @if($job->experience_level_id == $expLev->id)
                    <option value="{{$expLev['id']}}" selected>{{$expLev['name']}}</option>
                    @else
                    <option value="{{$expLev['id']}}">{{$expLev['name']}}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
                <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please select experience level</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="empType">Employment type</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="empType" id="empType" class="form-select">
                    @if(isset($data['empTypes']))
                    @foreach ($data['empTypes'] as $empType)
                    @if($job->employment_type_id == $empType->id)
                    <option value="{{$empType['id']}}" selected>{{$empType['name']}}</option>
                    @else
                    <option value="{{$empType['id']}}">{{$empType['name']}}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
                <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please select employment type</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="address">Branch</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="address" id="address" class="form-select">
                    @if(isset($data['addresses']))
                    @foreach ($data['addresses'] as $addr)
                    @if($job->address_id == $addr->id)
                    <option value="{{$addr['id']}}" selected>{{$addr->city->name}}/{{$addr->city->state->name}}</option>
                    @else
                    <option value="{{$addr['id']}}">{{$addr->city->name}}/{{$addr->city->state->name}}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
                <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please select branch</strong></span>
                </span>
            </div>
        </div>
    </div>

    <!-- step two -->
    <div class="step">
        <p class="text-center mb-4">Job descriptions</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance1" name="description" required>{{$job->description}}</textarea>
        </div>
    </div>

    <!-- step three -->
    <div class="step">
        <p class="text-center mb-4">Job requirements</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance2" name="requirement">{{$job->requirement}}</textarea>
        </div>
    </div>

    <!-- step four -->
    <div class="step">
        <p class="text-center mb-4">Job benefits</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance3" name="benefit">{{$job->benefit}}</textarea>
        </div>
    </div>

    <!-- start previous / next buttons -->
    <div class="form-footer d-flex">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
    <!-- end previous / next buttons -->
</form>
@endsection
@section('scripts')
<script src="{{URL::asset('js/multistepForm.js')}}"></script>
@endsection