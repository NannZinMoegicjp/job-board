@extends('Employer.master_employer')
@section('content')
<div class="container my-2">
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <h3 class="py-3">Employer Dashboard</h3>
    <div class="row g-2">
        <div class="col-md-3">
            <div class="item orangeBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/suitcase.png')}}" alt="job">
                </div>
                <div>
                    <h5>{{$count["activeJobs"]}}</h5>
                    <h6 class="text-secondary">Active jobs</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/miscellaneous.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["inactiveJob"]}}</h4>
                    <h6 class="text-secondary">Inactive jobs</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/debit-card.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["credits"]}}</h4>
                    <h6 class="text-secondary">Credits</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/message.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["applications"]}}</h4>
                    <h6 class="text-secondary">Total Applications</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection