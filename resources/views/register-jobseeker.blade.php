@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row  my-5">
        <div class="col-md-8 offset-md-2 col-12">
            @if (session('status'))
            <div class="alert alert-success my-2">
                {{ session('status') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger my-2">
                @foreach ($errors->all() as $error)
                {{ $error }} <br>
                @endforeach
            </div>
            @endif
            <form action="{{url('/jobseeker/register')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Job Seeker Registraion</h4>
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
                        <input type="number" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="dob">Date of birth</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="dob" name="dob"
                            value="{{old('dob')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="profileImage" class="form-label">Profile image</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="profileImage" name="profileImage"
                            id="profileImage" value="{{old('profileImage')}}" required>
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
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="radio" name="gender" id="female" value="female" required> Female
                        <input type="radio" name="gender" id="male" value="male"> Male
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Register">
                        <a href="{{url('/home')}}"><input type="button" class="btn-secondary btn" value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection