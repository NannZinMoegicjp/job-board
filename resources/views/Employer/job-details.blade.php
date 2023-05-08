@extends('Employer.master_employer')
@section('content')
<section class="pb-4">    
    <div class="row text-end my-2">
        <a href="{{url('/employer/jobs')}}">job list<i class="bi bi-arrow-right"></i></a>
    </div>    
    <div class="container px-lg-5">
        <div class="my-2">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
        </div>
        @if(isset($job))
        <div class="bg-white">
            <div class="row p-3 mx-3">
                <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">                        
                    <img src="{{url('images/companies/'.$job->address->company->logo)}}"
                            alt="{{$job->address->company->company_name}} image">
                </div>
                <div class="col-md-9 col-12">
                    <h4 class="jobAttribute border-0 fw">{{$job->title}}</h4>
                    <h5 class="jobAttribute border-0 fw">{{$job->address->company->company_name}}</h5>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-6"><i class="bi bi-clock-fill clock"></i>
                            {{$job->employmentType->name}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-geo-alt-fill location"></i>
                            {{$job->address->city->state->name}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-calendar-check-fill date"></i>
                            {{$job->created_at->todatestring()}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-currency-dollar money"></i>Up to
                            {{$job->max_salary}}
                        </div>
                    </div>
                    <div class="mb-2">Experience level : {{$job->experienceLevel->name}}</div>
                    <div class="mb-2">Functional Area : {{$job->jobCategory->name}}</div>
                    <div class="mb-2">Open position : {{$job->open_position}}</div>
                </div>
            </div>
            <div class="p-3">
                <div>
                    <h5 class="p-2 jobAttribute">Job Description</h5>
                    {!!$job->description!!}
                </div>
                <div>
                    <h5 class="p-2 jobAttribute">Job Requirements</h5>
                    {!!$job->requirement!!}
                </div>
                <div>
                    <h5 class="p-2 jobAttribute">OpenTo</h5>
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
                <div class="my-2">
                    <h5 class="p-2 jobAttribute">Benefits</h5>
                    {!!$job->benefit!!}
                </div>            
            </div>
        </div>
        @endif
    </div>
</section>
@endsection