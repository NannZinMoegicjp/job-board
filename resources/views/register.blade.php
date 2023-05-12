@extends('master')
@section('content')
<div class="container forms pageContent">
    <div class="row  my-5">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="d-flex justify-content-center align-items-center">
                <div class="btn-group m-3" role="group">
                    <a href="{{ route('register.jobseekerform') }}"><button class="registerBtns notSelected"
                            type="button">Job
                            seeker</button></a>
                    <a href="{{ route('register.employerform') }}"><button class="registerBtns notSelected"
                            type="button">Employer</button></a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection