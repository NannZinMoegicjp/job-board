@extends('master')
@section('content')
<div class="container forms pageContent">
    <div class="row  my-5">      
        <div class="col-md-8 offset-md-2 col-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <div class="d-flex justify-content-center align-items-center">
                <div class="btn-group m-3" role="group">
                    <button class="registerBtns notSelected" id="jobseekerBtn" onclick="showJobSeeker();">Job
                        seeker</button>
                    <button class="registerBtns notSelected" id="employerBtn"
                        onclick="showEmployer();">Employer</button>
                </div>
            </div>
            <div id="employer" class="d-none py-2">
                @include('company-register')
            </div>
            <div id="jobseeker" class="d-none py-2">
                @include('job-seeker-register')
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    window.onload = function() {
       @php
       if(old('register_type') == 'job_seeker'){
       @endphp
       showJobSeeker();
            @php
       }
        @endphp
    }
let showJobSeeker = () => {
    jobseeker.classList.remove("d-none");
    jobseeker.classList.add("d-block");
    if (employer.classList.contains("d-block")) {
        employer.classList.remove("d-block");
        employer.classList.add("d-none");
    }
    if (employerBtn.classList.contains("selected")) {
        employerBtn.classList.remove("selected")
    }
    employerBtn.classList.add("notSelected");
    if (jobseekerBtn.classList.contains("notSelected")) {
        jobseekerBtn.classList.remove("notSelected")
    }
    jobseekerBtn.classList.add("selected");
}
let showEmployer = () => {
    employer.classList.remove("d-none");
    employer.classList.add("d-block");
    if (jobseeker.classList.contains("d-block")) {
        jobseeker.classList.remove("d-block");
        jobseeker.classList.add("d-none");
    }
    if (jobseekerBtn.classList.contains("selected")) {
        jobseekerBtn.classList.remove("selected")
    }
    jobseekerBtn.classList.add("notSelected");
    if (employerBtn.classList.contains("notSelected")) {
        employerBtn.classList.remove("notSelected")
    }
    employerBtn.classList.add("selected");
}
</script>