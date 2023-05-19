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
<h3 class="text-center" id="post">Post job</h3>
<form id="signUpForm" action="{{ route('job.insert') }}" method="post">
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
                <label for="title" class="col-form-label">Title</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="text" class="form-control" required name="title" id="title" value="{{ old('title') }}"
                    >
                <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please fill title</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="minSalary" class="col-form-label">Min Salary per month</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='0' step="10000" class="form-control" required name="minSalary" id="minSalary"
                    value="{{ old('minSalary') }}" >
                <span class="invalid-feedback d-none">
                    <span class="text-danger"><strong>Please fill minimum salary</strong></span>
                </span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="maxSalary" class="col-form-label">Max Salary per month</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='0' step="10000" class="form-control" required name="maxSalary" id="maxSalary"
                    value="{{ old('maxSalary') }}" >
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
                <label for="openPosition" class="col-form-label">Open position</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" id="openPosition" name="openPosition"
                    value="{{old('openPosition')}}" >
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
                    <div class="form-check me-2 col-form-label">
                        <input class="form-check-input" type="checkbox" value="female" id="female" name="female"
                            @if(old('female')=='female' ) checked @endif>
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" value="male" id="male" name="male"
                            @if(old('male')=='male' ) checked @endif>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                </div>
                <div class="invalid-feedback d-none" id="genderError">
                    <span class="text-danger"><strong>Please check one of female,male </strong></span>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="jobCategory" class="col-form-label">Job Category</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="jobCategory" id="jobCategory" class="form-select" required >
                    <option value="">-- Select job category --</option>
                    @if(isset($data['jobCategories']))
                    @foreach ($data['jobCategories'] as $jobCat)
                    <option value="{{$jobCat['id']}}" @if(old('jobCategory')==$jobCat['id']) selected @endif>
                        {{$jobCat['name']}}</option>
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
                <label for="expLevel" class="col-form-label">Experience level</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="expLevel" id="expLevel" class="form-select" required >
                    <option value="">-- Select experience level --</option>
                    @if(isset($data['expLevels']))
                    @foreach ($data['expLevels'] as $expLev)
                    <option value="{{$expLev['id']}}" @if(old('expLevel')==$expLev['id']) selected @endif>
                        {{$expLev['name']}}</option>
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
                <label for="empType" class="col-form-label">Employment type</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="empType" id="empType" class="form-select" required >
                    <option value="">-- Select employment type --</option>
                    @if(isset($data['empTypes']))
                    @foreach ($data['empTypes'] as $empType)
                    <option value="{{$empType['id']}}" @if(old('empType')==$empType['id']) selected @endif>
                        {{$empType['name']}}</option>
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
                <label for="address" class="col-form-label">Branch</label>
                <span class="text-danger"> *</span>
            </div>
            <div class="col-md-7 col-12">
                <select name="address" id="address" class="form-select" required >
                    <option value="">-- Select branch --</option>
                    @if(isset($data['addresses']))
                    @foreach ($data['addresses'] as $addr)
                    <option value="{{$addr['id']}}" @if(old('address')==$addr['id']) selected @endif>
                        {{$addr->city->name}}/{{$addr->city->state->name}}</option>
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
            <textarea id="myeditorinstance1" name="description" required>{{old('description')}}</textarea>
            <span class="invalid-feedback d-none" id="descriptionError">
                <span class="text-danger"><strong>Please fill job description</strong></span>
            </span>
        </div>
    </div>

    <!-- step three -->
    <div class="step">
        <p class="text-center mb-4">Job requirements</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance2" name="requirement" required>{{old('requirement')}}</textarea>
            <span class="invalid-feedback d-none" id="requirementError">
                <span class="text-danger"><strong>Please fill job requirements</strong></span>
            </span>
        </div>
    </div>
    <div class="step">
        <p class="text-center mb-4">Job benefits</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance3" name="benefit" required>{{old('benefit')}}</textarea>
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
<script>
    let removeWarning=(selectbox)=>{
        selectbox.classList.remove("is-invalid");
        selectbox.nextElementSibling.classList.remove("d-inline-block");
        selectbox.nextElementSibling.classList.add("d-none");
    }
    let removeCheckBoxWarning=()=>{
        var genderError = document.getElementById("genderError");
        genderError.classList.remove("d-inline-block");
        genderError.classList.add("d-none");
    }   
    let removeTextareaWarning=()=>{
        var descriptionError = document.getElementById("descriptionError");
        descriptionError.classList.remove("d-inline-block");
        descriptionError.classList.add("d-none");
    }   
</script>
@endsection