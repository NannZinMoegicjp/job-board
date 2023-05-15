@extends('master')
@section('content')
<div class="container">
<div class="row my-3">
    <div class="col-md-8 offset-md-2">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('register.jobseeker') }}" method="post" class="bg-white px-3 pb-2 rounded shadow-lg"
            onsubmit="return check();" enctype="multipart/form-data">
            @csrf
            <div id="error"></div>
            <div>
                <h4 class="text-center py-4">Job seeker registration</h4>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="userName" class="col-form-label">Name</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="text" class="form-control @error('userName') is-invalid @enderror" required
                        name="userName" id="userName" value="{{ old('userName') }}">
                </div>
                <div id="nameError" class="text-danger"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="userEmail" class="col-form-label">Email</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="email" class="form-control @error('userEmail') is-invalid @enderror" required
                        name="userEmail" id="userEmail" value="{{ old('userEmail') }}">
                    <div id="emailError" class="text-danger"></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="userPhoneNumber" class="col-form-label">Phone</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="number" class="form-control @error('userPhoneNumber') is-invalid @enderror" min="0"
                        required placeholder="eg. 09454096728" name="userPhoneNumber" id="userPhoneNumber"
                        value="{{ old('userPhoneNumber') }}">
                    <div id="phoneNoError" class="text-danger"></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12"><label for="dob" class="col-form-label">Date of birth</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" required
                        placeholder="dob" name="dob" id="dob" value="{{ old('dob') }}">
                </div>
                @error('dob')
                <span class="invalid-feedback" role="alert">
                    <span class="alert alert-danger">{{ $message }}</span>
                </span>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" required
                        placeholder="Password" name="password" id="password" value="{{ old('password') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="password_confirmation" class="col-form-label">Confirm
                        password</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="password" class="form-control @error('password.confirmed') is-invalid @enderror"
                        required placeholder="Confirm password" name="password_confirmation" id="password_confirmation"
                        value="{{ old('password_confirmation') }}">
                    <span class="text-secondary">***one lowercase letter, one uppercase letter, one digit, and one
                        special
                        character</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="profileImage" class="col-form-label">Profile Image</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="file" class="form-control @error('profileImage') is-invalid @enderror"
                        name="profileImage" accept=".jpeg,.jpg,.svg,.gif,.png,.tiff,.jfif,.bmp,.webp" id="profileImage"
                        value="{{old('profileImage')}}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="gender">Gender</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="radio" name="gender" id="female" value="female" required>Female
                    <input type="radio" name="gender" id="male" value="male">Male
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12"><label for="address" class="col-form-label">Address</label>
                </div>
                <div class="col-md-7 col-12">
                    <textarea class="form-control address" placeholder="Enter details address" required id="address"
                        name="address">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-3 offset-md-1 col-12"></div>
                <div class="col-md-7 col-12">
                    <input type="hidden" name="register_type" value="job_seeker">
                    <input type="submit" name="btnRegister" id="btnRegister" class="registerBtn btn me-2" required
                        value="register">
                    <a href="{{route('home')}}"><input type="button" class="btn-secondary btn" value="Cancel"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 offset-md-2 col-12 text-black text-center">
                    <span>Already have account? <a href="{{ route('login') }}" class="">Login here</a></span>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection