@extends('master')
@section('content')
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
        <form action="{{route('register.employer')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h4 class="text-center py-4">Company Registration</h4>
            </div>
            <div class="row my-2">
                <div class="col-md-10 offset-md-1 col-12">
                    <h6>Account information</h6>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="contactPerson">Contact Person</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="text" class="form-control @error('userName') is-invalid @enderror" required
                        name="contactPerson" id="contactPerson" value="{{ old('contactPerson') }}">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="userEmail">Email</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="email" class="form-control @error('userEmail') is-invalid @enderror" required name="userEmail" id="userEmail"
                        value="{{ old('userEmail') }}">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12">
                    <label for="phone">Phone</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" min="0" required placeholder="eg. 09454096528" id="phone"
                        name="phone" value="{{ old('phone') }}">
                </div>
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
            <hr>

            <div class="row mb-2">
                <div class="col-md-10 offset-md-1 col-12  col-form-label">
                    <h6>Company information</h6>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="comName">Company name</label>
                </div>
                <div class="col-md-7 col-12"> <input type="text" class="form-control @error('comName') is-invalid @enderror" required id="comName"
                        name="comName" value="{{old('comName')}}">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="estDate">Established date</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="date" class="form-control @error('estDate') is-invalid @enderror" placeholder="eastablished date" id="estDate" name="estDate"
                        value="{{old('estDate')}}">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="websiteLink">Website link</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="url" class="form-control @error('websiteLink') is-invalid @enderror" name="websiteLink" id="websiteLink"
                        placeholder="https://studyrightnow-mdy.com" value="{{old('websiteLink')}}">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="logofile" class="form-label">Company Logo</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="file" class="form-control @error('logofile') is-invalid @enderror" required placeholder="Logo" name="logofile" id="logofile"
                        value="{{old('logofile')}}" accept=".jpeg,.jpg,.svg,.gif,.png,.tiff,.jfif,.bmp,.webp">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="images" class="form-label">Company Photos</label>
                </div>
                <div class="col-md-7 col-12">
                    <input type="file" class="form-control @error('images') is-invalid @enderror" placeholder="images" name="images[]" id="images" multiple
                        value="{{old('images')}}">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="state">Division/state</label>
                </div>
                <div class="col-md-7 col-12">
                    <select name="state" id="state" class="form-select" required>
                        <option value="">-- Select State --</option>
                        @if(isset($data["states"]))
                        @foreach ($data["states"] as $state)
                        <option value="{{$state['id']}}">{{$state['name']}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="city">Township</label>
                </div>
                <div class="col-md-7 col-12">
                    <select name="city" id="city" class="form-select" required>
                        <option value="">-- Select city --</option>
                    </select>
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
                    <label for="industry">Main Industry</label>
                </div>
                <div class="col-md-7 col-12">
                    <select name="industry[]" id="industry" class="form-select" multiple required>
                        <option value="">-- Select industry --</option>
                        @if(isset($data["industries"]))
                        @foreach ($data["industries"] as $industry)
                        <option value="{{$industry['id']}}">{{$industry['name']}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12  col-form-label">
                    <label for="size">Number of employee</label>
                </div>
                <div class="col-md-7 col-12">
                    <select name="size" id="size" class="form-select" required>
                        <option value="">-- Select no of employee --</option>
                        <option value="1-5">1-5</option>
                        <option value="6-10">6-10</option>
                        <option value="11-20">11-20</option>
                        <option value="21-50">21-50</option>
                        <option value="51-100">51-100</option>
                        <option value="101-200">101-200</option>
                        <option value="201-500">201-500</option>
                        <option value="501-1000">501-1000</option>
                        <option value="1001-5000">1001-5000</option>
                        <option value="5000-10000">5000-10000</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12">
                </div>
                <div class="col-md-7 col-12 d-flex">
                    <input type="hidden" name="register_type" value="employer">
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#state').on('change', function() {
        var stateId = this.value;
        $("#city").html('<option value="">-- Select city --</option>');
        $.ajax({
            url: "/api/fetch-cities/" + stateId,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    $("#city").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            },
        });
    });
});
</script>