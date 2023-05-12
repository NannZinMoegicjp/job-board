<!-- <form action="" class="bg-white px-3 pb-2 rounded shadow-lg">
    <div>
        <h4 class="text-center py-4">Sign up for employer</h4>
    </div>
    <div class="row my-2">
        <div class="col-md-8 offset-md-2 col-12">
            <h6>Account information</h6>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="text" class="form-control" required placeholder="Contact Person">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="email" class="form-control" required placeholder="Email">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="number" class="form-control" min="0" required placeholder="Phone, eg. 09454096528">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="password" class="form-control" required placeholder="Password">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="password" class="form-control" required placeholder="Confirm password">
        </div>
    </div>
    <div class="row  mb-2 mt-4">
        <div class="col-md-8 offset-md-2 col-12">
            <h6>Company information</h6>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="text" class="form-control" required placeholder="Company Name">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2  col-12">
            <select name="division" id="division" class="form-select" placeholder="Your division/state">
                <option value="0">Division/state</option>
                <option value="yangon">Yangon</option>
                <option value="mandalay">Mandalay</option>
                <option value="shan state">Shan State</option>
            </select>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2  col-12">
            <select name="city" id="city" class="form-select">
                <option value="0">City</option>
                <option value="yangon">Tamwe</option>
                <option value="mandalay">Tarkayta</option>
                <option value="shan state">Mayangone</option>
            </select>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2  col-12">
            <div class="form-floating">
                <textarea class="form-control address" placeholder="Enter details address" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Address</label>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2  col-12">
            <select name="industry" id="industry" class="form-select">
                <option value="0">Main industry</option>
                <option value="it">IT/computer</option>
                <option value="education">Education</option>
                <option value="health">Health</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2  col-12">
            <select name="size" id="size" class="form-select">
                <option value="0">Number of employee</option>
                <option value="yangon">10-50</option>
                <option value="mandalay">50-100</option>
                <option value="shan state">100-200</option>
            </select>
        </div>
    </div>    
    <div class="row mb-2">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="submit" class="form-control registerBtn btn" required value="Register">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-8 offset-md-2 col-12 text-black text-center">
            <span>Already have account? <a href="Login.php" class="">Login here</a></span>
        </div>
    </div>
</form> -->
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
            <input type="text" class="form-control" required name="contactPerson" id="contactPerson"
                value="{{ old('contactPerson') }}">
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
            <input type="text" class="form-control" min="0" required placeholder="eg. 09454096528" id="phone"
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
            <input type="password" class="form-control @error('password.confirmed') is-invalid @enderror" required
                placeholder="Confirm password" name="password_confirmation" id="password_confirmation"
                value="{{ old('password_confirmation') }}">
            <span class="text-secondary">***one lowercase letter, one uppercase letter, one digit, and one special
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
        <div class="col-md-7 col-12"> <input type="text" class="form-control" required id="comName" name="comName"
                value="{{old('comName')}}">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 offset-md-1 col-12  col-form-label">
            <label for="estDate">Established date</label>
        </div>
        <div class="col-md-7 col-12">
            <input type="date" class="form-control" placeholder="eastablished date" id="estDate" name="estDate"
                value="{{old('estDate')}}">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 offset-md-1 col-12  col-form-label">
            <label for="websiteLink">Website link</label>
        </div>
        <div class="col-md-7 col-12">
            <input type="text" class="form-control" name="websiteLink" id="websiteLink"
                placeholder="https://studyrightnow-mdy.com" value="{{old('websiteLink')}}">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 offset-md-1 col-12  col-form-label">
            <label for="logofile" class="form-label">Company Logo</label>
        </div>
        <div class="col-md-7 col-12">
            <input type="file" class="form-control" required placeholder="Logo" name="logofile" id="logofile"
                value="{{old('logofile')}}">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 offset-md-1 col-12  col-form-label">
            <label for="images" class="form-label">Company Photos</label>
        </div>
        <div class="col-md-7 col-12">
            <input type="file" class="form-control" placeholder="images" name="images[]" id="images" multiple
                value="{{old('images')}}">
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 offset-md-1 col-12  col-form-label">
            <label for="state">Division/state</label>
        </div>
        <div class="col-md-7 col-12">
            <select name="state" id="state" class="form-select" placeholder="Your division/state">
                <option value="">-- Select State --</option>
                @if(isset($states))
                @foreach ($states as $state)
                <option value="{{$state['id']}}">{{$state['name']}}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 offset-md-1 col-12  col-form-label">
            <label for="city">City</label>
        </div>
        <div class="col-md-7 col-12">
            <select name="city" id="city" class="form-select">
                <option value="">-- Select city --</option>
                {{-- @if(isset($cities))
                            @foreach ($cities as $city)
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                @endforeach
                @endif --}}
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
                @if(isset($industries))
                @foreach ($industries as $industry)
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
            <select name="size" id="size" class="form-select">
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
            <input type="submit" name="btnRegister" id="btnRegister" class="registerBtn btn me-2" required value="register">
            <a href="{{route('home')}}"><input type="button" class="btn-secondary btn" value="Cancel"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 offset-md-2 col-12 text-black text-center">
            <span>Already have account? <a href="{{ route('login') }}" class="">Login here</a></span>
        </div>
    </div>
</form>