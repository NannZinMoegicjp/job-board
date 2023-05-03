@extends('Employer.master_employer')
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
        <a href="{{url('/employer/jobs')}}">job list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-3">
        @if(isset($updateId) && isset($jobseeker))
        <div class="col-md-7 col-12 mb-1">
            <form action="{{url('/employer/jobs/update/'.$updateId)}}" class="bg-white px-3 pb-2 rounded shadow"
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
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/employer/jobs')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5 col-12">
                     
        </div>        
        @else
        <div class="col-md-8 offset-md-2 col-12">
            <form action="{{url('/employer/jobs/add')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Post job</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="title">Title</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="title" id="title"
                            value="{{ old('title') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="salary">Salary</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="salary" id="salary"
                            value="{{ old('salary') }}">
                    </div>
                </div>                  
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="openPosition">Open position</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="number" class="form-control" id="openPosition"
                            name="openPosition" value="{{old('openPosition')}}">
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
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="jobCategory">Job Category</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="jobCategory" id="jobCategory" class="form-select">
                            @if(isset($jobCategories))
                            @foreach ($jobCategories as $jobCat)
                            <option value="{{$jobCat['id']}}">{{$jobCat['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>   
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="expLevel">Experience level</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="expLevel" id="expLevel" class="form-select">
                            @if(isset($expLevels))
                            @foreach ($expLevels as $expLev)
                            <option value="{{$expLev['id']}}">{{$expLev['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>  
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="empType">Employment type</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="empType" id="empType" class="form-select">
                            @if(isset($empTypes))
                            @foreach ($empTypes as $empType)
                            <option value="{{$empType['id']}}">{{$empType['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div> 
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="address">City</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="address" id="address" class="form-select">
                            @if(isset($addresses))
                            @foreach ($addresses as $addr)
                            <option value="{{$addr['id']}}">{{$addr->city->state->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>            
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="address">City</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="address" id="address" class="form-select">
                            @if(isset($addresses))
                            @foreach ($addresses as $addr)
                            <option value="{{$addr['id']}}">{{$addr->city->state->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>                              
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                    <input type="submit" class="btn-primary btn me-2" value="Continue to add job description">
                        <a href="{{url('/employer/jobs')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
