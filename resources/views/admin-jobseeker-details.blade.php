@extends('welcome')
@section('content')
<section>
    <div class="row text-end my-2">
        <a href="{{url('/admin/job-seekers')}}">job seeker list<i class="bi bi-arrow-right"></i></a>
    </div>
    @if(isset($jobseeker))
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8 offset-md-2  shadow-sm border">
                <div class="row">
                    <div class="col-md-3 offset-md-1 p-2 d-flex flex-column justify-content-center align-items-center">
                        <img src="{{URL::asset('images/jobseekers/'.$jobseeker->image)}}" alt="" class="profileImg">
                        <h5>{{$jobseeker->name}}</h5>                        
                    </div>
                    <div class="col-md-7">
                        <div class="row border-bottom p-2">
                            <div class="col-md-4">Name</div>
                            <div class="col-md-8">{{$jobseeker->name}}</div>
                        </div>
                        <div class="row border-bottom p-2">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8">{{$jobseeker->email}}</div>
                        </div>
                        <div class="row border-bottom p-2">
                            <div class="col-md-4">Phone</div>
                            <div class="col-md-8">{{$jobseeker->phone}}</div>
                        </div>
                        <div class="row border-bottom p-2">
                            <div class="col-md-4">Address</div>
                            <div class="col-md-8">{{$jobseeker->address}}</div>
                        </div>
                        <div class="row border-bottom p-2">
                            <div class="col-md-4">Age</div>
                            <div class="col-md-8">{{$jobseeker->age()}}</div>
                        </div>
                        <div class="row border-bottom p-2">
                            <div class="col-md-4">Gender</div>
                            <div class="col-md-8">{{$jobseeker->gender}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection