@extends('master_admin')
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
    <div class="row text-end my-2">
        <a href="{{url('/admin/job-seekers')}}">job seeker list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-3">
        @if(isset($updateId) && isset($jobseeker))
        <div class="col-md-7 col-12 mb-1">
            <form action="{{url('/admin/job-seekers/update/'.$updateId)}}" class="bg-white px-3 pb-2 rounded shadow"
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
                            value="{{$jobseeker['email']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{$jobseeker['phone']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="dob">Date of birth</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="dob"
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
                    <div class="col-md-7 col-12">
                        <input type="submit" class="form-control btn-primary btn" value="Update">
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
                    <form action="{{url('/admin/job-seekers/update/image/'.$updateId)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control mb-2" placeholder="Logo" name="newProfileImage"
                            id="newProfileImage" value="{{old('logofile')}}" required>
                        <input type="submit" class="btn btn-outline-primary" value="upload new profile">
                    </form>
                </div>
            </div>         
        </div>        
        @else
        <div class="col-md-8 offset-md-2 col-12">
            <form action="{{url('/admin/job-seekers/add')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Add Job Seeker</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="name" id="name"
                            value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userEmail">Email</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="email" class="form-control" required name="userEmail" id="userEmail"
                            value="{{ old('userEmail') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="dob">Date of birth</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="dob"
                            name="dob" value="{{old('dob')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="profileImage" class="form-label">Profile image</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="profileImage" name="profileImage" id="profileImage"
                            value="{{old('profileImage')}}">
                    </div>
                </div>                
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <textarea class="form-control address" placeholder="Enter details address" required id="address"
                            name="address">{{old('address')}}</textarea>
                    </div>
                </div>  
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="radio" name="gender" id="female" value="female">Female
                        <input type="radio" name="gender" id="male" value="male">Male
                    </div>
                </div>               
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="submit" class="form-control btn-primary btn" required value="Add">
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection