@extends('master')
@section('content')
<section class="pb-4">
    <div class="container bg-white my-2">
        @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger my-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(isset($job))
        <div class="row p-3 mx-3">
            <div class="col-3 d-flex justify-content-center align-items-center">
                <a href="{{url('/company/details/'.$job->address->company->id)}}"><img
                        src="{{url('images/companies/'.$job->address->company->logo)}}"
                        alt="{{$job->address->company->company_name}} image"></a>
            </div>
            <div class="col-6">
                <h4 class="jobAttribute border-0 fw">{{$job->title}}</h4>
                <a href="{{url('/company/details/'.$job->address->company->id)}}"
                    class="text-decoration-none text-dark">
                    <h5 class="companyLink jobAttribute border-0 fw">{{$job->address->company->company_name}}</h5>
                </a>
                <div class="row my-2">
                    <div class="col"><i class="bi bi-clock-fill clock"></i>
                        {{$job->employmentType->name}}</div>
                    <div class="col"><i class="bi bi-geo-alt-fill location"></i>
                        {{$job->address->city->state->name}}</div>
                </div>
                <div class="row my-2">
                    <div class="col"><i class="bi bi-calendar-check-fill date"></i>
                        {{$job->created_at}}</div>
                    <div class="col"><i class="bi bi-currency-dollar money"></i>Up to {{$job->max_salary}}
                    </div>
                </div>
                <div class="mb-2">Experience level : {{$job->experienceLevel->name}}</div>
                <div class="mb-2">Job Category : {{$job->jobCategory->name}}</div>
                <div class="mb-2">Open position : {{$job->open_position}}</div>
            </div>
            <div class="col-md-3">
                <div class="m-md-2 m-3 p-3 apply">
                    <h5 class="title">APPLY FOR HERE</h5>
                    <hr>
                    @if(auth()->guard('jobseeker')->check())  
                    <button type="button" class="border form-control greenBtn btn" data-bs-toggle="modal"
                        data-bs-target="#applyJob"> Apply
                    </button>
                    @else
                    <a href="{{ route('login') }}"><button type="button" class="border form-control greenBtn btn">Login to Apply</button></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-3">
            <div>
                <h5 class="jobAttribute border-bottom p-2 title">Job Description</h5>
                {!!$job->description!!}
            </div>
            <div>
                <h5 class="jobAttribute border-bottom p-2 title">Job Requirements</h5>
                {!!$job->requirement!!}
            </div>
            <div>
                <h5 class="jobAttribute border-bottom p-2 title">OpenTo</h5>
                <i class="bi bi-check-circle-fill ps-2 gender"></i> <span class="text-secondary">
                    @if($job->gender == 'both')
                    Male/ Female
                    @elseif($job->gender == 'female')
                    Female
                    @elseif($job->gender == 'male')
                    Male
                    @endif
                </span>
            </div>
            <div>
                <h5 class="jobAttribute p-2 title">Benefits</h5>
                {!!$job->benefit!!}
            </div>
        </div>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    @if(auth()->guard('jobseeker')->check())  
    <div class="modal fade" id="applyJob" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>Apply job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>                
                <div class="modal-body">
                    <form action="{{route('apply.job',[$job->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @php
                        $user = auth()->guard('jobseeker')->user();
                        @endphp
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-9">
                                {{$user->name}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-md-9">
                            {{$user->email}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="col-md-9">
                            {{$user->phone}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="cvform">Cv form</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" required name="cvform" id="cvform" class="form-control"
                                    accept=".pdf,.doc,.docx">
                                <span>Please upload .pdf,.doc,.docx file</span>
                            </div>
                        </div>
                        <input type="submit" value="apply" class="border form-control greenBtn btn">
                    </form>
                </div>                
            </div>
        </div>
    </div>
    @endif
</section>
@endsection