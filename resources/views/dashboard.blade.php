@extends('welcome')
@section('content')
<div class="container my-2">
    <h3 class="py-3">Admin Dashboard</h3>
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
                    <img src="{{URL::asset('images/dashboard/order.png')}}" alt="job">
                </div>
                <div>
                <h4>{{$count["conOrders"]}}</h4>  
                    <h6 class="text-secondary">Confirmed Orders</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/checklist.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["awaitOrders"]}}</h4>
                    <h6 class="text-secondary">Awaiting Orders</h6>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/office-building.png')}}" alt="job">
                </div>
                <div>                    
                    <h4>{{$count["companies"]}}</h4>  
                    <h6 class="text-secondary">Companies</h6>                                      
                </div>
            </div>              
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/employee.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["jobSeekers"]}}</h4>
                    <h6 class="text-secondary">Job Seekers</h6>
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
                    <h6 class="text-secondary">Applications</h6>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection