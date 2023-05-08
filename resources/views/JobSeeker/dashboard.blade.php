@extends('JobSeeker.master')
@section('content')
<div class="container my-2">
<h3>Job seeker Dashboard</h3>
<div class="row g-2">
    <div class="col-md-3 col-12">
        <div class="item orangeBorder d-flex justify-content-center align-items-center shadow-sm">
            <div class="p-2">
                <img src="{{URL::asset('images/dashboard/message.png')}}" alt="job">
            </div>
            <div>
                <h5>{{count($data["applications"])}}</h5>
                <h6 class="text-secondary">Total Applications</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
            <div class="p-2">
                <img src="{{URL::asset('images/dashboard/miscellaneous.png')}}" alt="job">
            </div>
            <div>
                <h4>{{count($data["shortlistedApps"])}}</h4>
                <h6 class="text-secondary">Shortlisted applications</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
            <div class="p-2">
                <img src="{{URL::asset('images/dashboard/cancel.png')}}" alt="job">
            </div>
            <div>
                <h4>{{count($data["rejectedApps"])}}</h4>
                <h6 class="text-secondary">Rejected applications</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
            <div class="p-2">

            </div>
            <div>
                <h4>{{count($data["pendingApps"])}}</h4>
                <h6 class="text-secondary">Pending applications</h6>
            </div>
        </div>
    </div>
</div>
</div>
@endsection