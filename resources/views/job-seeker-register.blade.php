@extends('master')
@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('register.jobseeker') }}" method="post" class="bg-white px-3 pb-2 rounded shadow-lg"
                enctype="multipart/form-data">
                @csrf
                <div id="error"></div>
                <div>
                    <h4 class="text-center py-4">Job seeker registration</h4>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userName" class="col-form-label">Name</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control @error('userName') is-invalid @enderror" name="userName"
                            id="userName" value="{{ old('userName') }}" />
                        @error('userName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userEmail" class="col-form-label">Email</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="email" class="form-control @error('userEmail') is-invalid @enderror"
                            name="userEmail" id="userEmail" value="{{ old('userEmail') }}" />
                        @error('userEmail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userPhoneNumber" class="col-form-label">Phone</label><span class="text-danger">
                            *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="number" class="form-control @error('userPhoneNumber') is-invalid @enderror" min="0"
                            placeholder="eg. 09454096728" name="userPhoneNumber" id="userPhoneNumber"
                            value="{{ old('userPhoneNumber') }}" />
                        @error('userPhoneNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12"><label for="dob" class="col-form-label">Date of
                            birth</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="dob"
                            name="dob" id="dob" value="{{ old('dob') }}" />
                        @error('dob')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password" class="col-form-label">Password</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" value="{{ old('password') }}" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="text-secondary">***one lowercase letter, one uppercase letter, one digit, and one
                            special
                            character</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password_confirmation" class="col-form-label">Confirm
                            password</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" id="password_confirmation"
                            value="{{ old('password_confirmation') }}" />
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="profileImage" class="col-form-label">Profile Image</label><span class="text-danger">
                            *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control mb-1 @error('profileImage') is-invalid @enderror"
                            name="profileImage" accept=".jpeg,.jpg,.svg,.gif,.png,.tiff,.jfif,.bmp,.webp"
                            id="profileImage" value="{{old('profileImage')}}" onchange="displayImage(event)" />
                        @error('profileImage')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <img id="previewImage" src="#" alt="Preview" style="display: none;" class="image-preview">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="gender">Gender</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="radio" name="gender" id="female" value="female" require class="@error('gender') is-invalid @enderror"/>Female
                        <input type="radio" name="gender" id="male" value="male" />Male
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 offset-md-1 col-12"><label for="address"
                            class="col-form-label">Address</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <textarea class="form-control address @error('address') is-invalid @enderror" id="address" name="address"
                            rows="4">{{ old('address') }}</textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-3 offset-md-1 col-12"></div>
                    <div class="col-md-7 col-12">
                        <input type="hidden" name="register_type" value="job_seeker">
                        <input type="submit" name="btnRegister" id="btnRegister" class="registerBtn btn me-2"
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
<script>
function displayImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const image = document.getElementById('previewImage');
            image.src = e.target.result;
            image.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection