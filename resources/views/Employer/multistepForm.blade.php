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
                <label for="title">Title</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="text" class="form-control" required name="title" id="title" value="{{ old('title') }}"
                    oninput="this.className = 'form-control'">
            </div>
        </div>
        
         <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="minSalary">Min Salary</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" required name="minSalary" id="minSalary"
                    value="{{ old('minSalary') }}" oninput="this.className = 'form-control'">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="maxSalary">Max Salary</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" required name="maxSalary" id="maxSalary"
                    value="{{ old('maxSalary') }}" oninput="this.className = 'form-control'">
            </div>
        </div> 
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="openPosition">Open position</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" min='1' class="form-control" id="openPosition" name="openPosition"
                    value="{{old('openPosition')}}" oninput="this.className = 'form-control'">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label>Gender</label>
            </div>
            <div class="col-md-7 col-12 d-flex">
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" value="female" id="female" name="female">
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
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="jobCategory">Job Category</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="jobCategory" id="jobCategory" class="form-select">
                    <option value="">-- Select job category --</option>
                    @if(isset($data['jobCategories']))
                    @foreach ($data['jobCategories'] as $jobCat)
                    <option value="{{$jobCat['id']}}">{{$jobCat['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="expLevel">Experience level</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="expLevel" id="expLevel" class="form-select">
                    <option value="">-- Select experience level --</option>
                    @if(isset($data['expLevels']))
                    @foreach ($data['expLevels'] as $expLev)
                    <option value="{{$expLev['id']}}">{{$expLev['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="empType">Employment type</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="empType" id="empType" class="form-select">
                    <option value="">-- Select employment type --</option>
                    @if(isset($data['empTypes']))
                    @foreach ($data['empTypes'] as $empType)
                    <option value="{{$empType['id']}}">{{$empType['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="address">Branch</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="address" id="address" class="form-select">
                    <option value="">-- Select branch --</option>
                    @if(isset($data['addresses']))
                    @foreach ($data['addresses'] as $addr)
                    <option value="{{$addr['id']}}">{{$addr->city->name}}/{{$addr->city->state->name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <!-- step two -->
    <div class="step">
        <p class="text-center mb-4">Job descriptions</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance1" name="description" required>{{old('description')}}</textarea>
        </div>
    </div>

    <!-- step three -->
    <div class="step">
        <p class="text-center mb-4">Job requirements</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance2" name="requirement"></textarea>
        </div>
    </div>

    <div class="step">
        <p class="text-center mb-4">Job benefits</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance3" name="benefit"></textarea>
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