@extends('master')
@section('content')
<section>
    <div class="container rounded-1 py-2">
        <form action="{{url('/jobs/filter')}}" method="get" class="my-2 p-2">
            @csrf
            <div class="row g-lg-1 g-2">
                <div class="col-lg col-md-6">
                    <input class="form-control" name="position" type="text" placeholder="Positions"
                        aria-label="positions">
                </div>
                <div class="col-lg col-md-6">
                    <select class="form-select" aria-label="job categories" name="category">
                        <option value="0">All job categories</option>
                        @foreach($data['categories'] as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg col-md-6">
                    <select class="form-select" aria-label="job locations" name="state" id="state">
                        <option value="0">All locations</option>
                        @foreach($data['states'] as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg col-md-6">
                    <input type="submit" class="border form-control greenBtn btn" value="Find jobs">
                </div>
            </div>
        </form>
    </div>
    <div class="container pageContent">
        @forelse($data['jobs'] as $job)
        <a href="{{route('job-details',[$job->id])}}" class="text-decoration-none text-dark">
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <img src="{{URL::asset('images/companies/'.$job->address->company->logo)}}"
                        alt="{{$job->address->company->company_name}} image">
                </div>
                <div class="col-9">
                    <h4 class="title">{{$job->title}}</h4>
                    <h6 class="title">{{$job->address->company->company_name}}</h6>
                    <div class="row my-1">
                        <div class="col-lg-3 col-6"><i class="bi bi-clock-fill clock"></i>
                            {{$job->employmentType->name}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-geo-alt-fill location"></i>
                            {{$job->address->city->state->name}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-calendar-check-fill date"></i>
                            {{$job->created_at}}</div>
                        <div class="col-lg-3 col-6"><i class="bi bi-currency-dollar money"></i>
                            {{$job->max_salary}}</div>
                    </div>
                    <span>Career level :</span> <span class="text-secondary">{{$job->experienceLevel->name}}</span><br>
                    <span>Functional Area : </span> <span class="text-secondary">{{$job->jobCategory->name}}</span><br>
                </div>
            </div>
        </a>
        @empty
        <p>No jobs found.</p>
        @endforelse
    </div>
</section>
@endsection