@extends('JobSeeker.master')
@section('content')
<section>
    <div class="container">
        @if(isset($jobseeker))
        <div class="row my-4">
            <div class="col-md-8 offset-md-2">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-8 offset-md-2  shadow-sm border">
                <div class="row">
                    <div class="col-md-3 offset-md-1 p-2 d-flex flex-column justify-content-center align-items-center">
                        <img src="{{URL::asset('images/jobseekers/'.$jobseeker->image)}}" alt="" class="profileImg">
                        <h5>{{$jobseeker->name}}</h5>
                        <a href="{{url('/job-seeker/update/profile')}}"><button type="button"
                                class="btn btn-primary"><i class="bi bi-pencil-fill update"></i>Edit</button></a>
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