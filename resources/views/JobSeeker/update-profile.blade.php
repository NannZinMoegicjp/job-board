@extends('JobSeeker.master')
@section('content')
<div class="container-fluid">
    <div class="row my-2">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }} <br>
            @endforeach
        </div>
        @endif
    </div>
    <div class="row my-3">
        <div class="col-md-7 col-12 mb-1">
            <form action="{{url('/job-seeker/update/profile')}}" class="bg-white px-3 pb-2 rounded shadow"
                method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Update Job Seeker</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="name" id="name"
                            value="{{$jobseeker['name']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userEmail">Email</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="email" class="form-control" required name="userEmail" id="userEmail"
                            value="{{$jobseeker['email']}}" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="number" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{$jobseeker['phone']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="dob">Date of birth</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" id="dob"
                            name="dob" value="{{$jobseeker['dob']}}">
                    </div>
                </div>             
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <textarea class="form-control address" placeholder="Enter details address" required id="address"
                            name="address">{{$jobseeker['address']}}</textarea>
                    </div>
                </div>  
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-md-7 col-12">
                        @if($jobseeker['gender'] == 'female')
                        <input type="radio" name="gender" id="female" value="female" checked>Female
                        <input type="radio" name="gender" id="male" value="male">Male
                        @else
                        <input type="radio" name="gender" id="female" value="female">Female
                        <input type="radio" name="gender" id="male" value="male" checked>Male
                        @endif    
                    </div>
                </div>             
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/admin/job-seekers')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5 col-12">
            <div class="row mb-3 d-flex justify-content-center shadow p-2">
                <div class="col-4">
                    <img src="{{URL::asset('images/jobseekers/'.$jobseeker->image)}}" alt="" class="img img-fluid">
                </div>
                <div class="col-8">
                    <form action="{{url('/job-seeker/update/image')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control mb-2" name="newProfileImage"
                            id="newProfileImage" value="{{old('logofile')}}" required>
                        <input type="submit" class="btn btn-outline-primary" value="upload new profile">
                    </form>
                </div>
            </div>         
        </div>     
    </div>
</div>
@endsection