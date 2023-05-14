@extends('welcome')
@section('content')
<section class="pb-4">
    {{-- <h3 class="text-center title shadow py-2 mb">Job details</h3> --}}
    <div class="row text-end my-2">
        <a href="{{url('/admin/jobs')}}">job list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="container bg-white">
        @if(isset($job))
            <div class="row p-3 mx-3">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="{{url('images/companies/'.$job->address->company->logo)}}"
                            alt="{{$job->address->company->company_name}} image" class="companyImg"></a>
                </div>
                <div class="col-9">
                    <a href="" class="text-decoration-none text-dark">
                        <h4 class="jobAttribute border-0 fw">{{$job->title}}</h4>
                    </a>
                    <a href="" class="text-decoration-none text-dark">
                        <h5 class="companyLink jobAttribute border-0 fw">{{$job->address->company->company_name}}</h5>
                    </a>
                    <div class="row my-1">
                        <div class="col-lg-3 col-6"><i class="bi bi-clock-fill clock"></i>
                            {{$job->employmentType->name}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-geo-alt-fill location"></i>
                            {{$job->address->city->state->name}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-calendar-check-fill date"></i>
                            {{$job->created_at->toDateString()}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-currency-dollar money"></i>Up to {{$job->max_salary}}
                        </div>
                    </div>
                    <div class="mb-2">Experience level : {{$job->experienceLevel->name}}</div>
                    <div class="mb-2">Job Category : {{$job->jobCategory->name}}</div>
                    <div class="mb-2">Open position : {{$job->open_position}}</div>
                </div>
            </div>
            {{-- <div class="col-md-3 d-none">
                <div class="m-md-2 m-3 p-3 apply">
                    <h5 class="title">APPLY FOR HERE</h5>
                    <hr>
                    <input type="submit" class="border form-control greenBtn btn" value="Apply">
                </div>
            </div> --}}
        <div class="p-3">
            <div>
                <h5 class="jobAttribute p-2 title">Job Description</h5>
                {!!$job->description!!}
            </div>
            <div>
                <h5 class="jobAttribute p-2 title">Job Requirements</h5>
                {!!$job->requirement!!}
            </div>
            <div>
                <h5 class="jobAttribute p-2 title">OpenTo</h5>
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
    </div>
</section>
@endsection