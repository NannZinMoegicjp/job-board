<form action="{{ route('register.jobseeker') }}" method="post" class="bg-white px-3 pb-2 rounded shadow-lg"
    onsubmit="return check();" @if($errors->any() && old('form') === 'form1') style="display:block;" @endif>
    @csrf
    <div id="error"></div>
    <div>
        <h4 class="text-center py-4">Sign up for job seeker</h4>
    </div>
    <div class="row mb-3">
        <div class="col-md-3 offset-md-1 col-12">
            <label for="userName" class="col-form-label">Name</label></div>
        <div class="col-md-7 col-12">
            <input type="text" class="form-control" required name="userName" id="userName" placeholder="Name" value="{{ old('userName') }}">
        </div>
        <div id="nameError" class="text-danger"></div>                      
    </div>
    <div class="row mb-3">
       <div class="col-md-3 offset-md-1 col-12"><label for="userEmail" class="col-form-label">Email</label></div>
        <div class="col-md-7 col-12">
            <input type="email" class="form-control" required placeholder="Email" name="userEmail" id="userEmail" value="{{ old('userEmail') }}">
            <div id="emailError" class="text-danger"></div>
        </div>
    </div>
    <div class="row mb-3">
       <div class="col-md-3 offset-md-1 col-12"><label for="userPhoneNumber" class="col-form-label">Phone</label></div>
        <div class="col-md-7 col-12">
            <input type="number" class="form-control" min="0" required placeholder="Phone, eg. 09454096528"
                name="userPhoneNumber" id="userPhoneNumber"  value="{{ old('userPhoneNumber') }}">
            <div id="phoneNoError" class="text-danger"></div>
        </div>
    </div>
    <div class="row mb-3">
       <div class="col-md-3 offset-md-1 col-12"><label for="dob" class="col-form-label">Date of birth</label></div>
        <div class="col-md-7 col-12">
            <input type="date" class="form-control" required placeholder="dob"
                name="dob" id="dob" value="{{ old('dob') }}">            
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row mb-3">
    <div class="col-md-3 offset-md-1 col-12"><label for="password" class="col-form-label">Password</label></div>
        <div class="col-md-7 col-12">
            <input type="password" class="form-control mypassword position-relative" required placeholder="Password"
                name="password" id="password" value="{{ old('password') }}">
            <div id="passError" class="text-danger"></div>
        </div>
    </div>
    <div class="row mb-3">
       <div class="col-md-3 offset-md-1 col-12"><label for="password_confirmation" class="col-form-label">Confirm password</label></div>
        <div class="col-md-7 col-12">
            <input type="password" class="form-control" required placeholder="Confirm password"
                name="password_confirmation" id="password_confirmation"  value="{{ old('password_confirmation') }}">
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row mb-3">
       <div class="col-md-3 offset-md-1 col-12"><label for="address" class="col-form-label">Address</label></div>
        <div class="col-md-7 col-12">
        <textarea class="form-control address" placeholder="Enter details address" required id="address"
                            name="address">{{ old('address') }}</textarea>
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row my-4">
        <div class="col-md-3 offset-md-1 col-12"></div>
        <div class="col-md-7 col-12">
        <input type="hidden" name="register_type" value="job_seeker">
            <input type="submit" name="btnRegister" id="btnRegister" class="form-control border-1 registerBtn"
                value="Register">
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 offset-md-2 col-12 text-black text-center">
            <span>Already have account? <a href="{{ route('login') }}" class="">Login here</a></span>
        </div>
    </div>
</form>
<script>
    let checkName=()=>{
    let name = userName.value;
    let pattern=/^[A-Z]{1}[a-z]*( [A-Z]{1}[a-z]+)*$/;
    let err = document.querySelector('.nameErr');
    if(pattern.test(name)){
        err.innerHTML="";
        return true;
    }else{
        err.innerHTML="wrong name format!eg., Su Myat";
        userName.focus();
        return false;
    }
}
let checkPassword=()=>{
    let password = userPassword.value;
    let pattern=/((?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@%$#!*&])).{8,}/;
    let err = document.querySelector('.passErr');
    if(pattern.test(password)){
        err.innerHTML="";
        return true;
    }else{
        err.innerHTML="not strong password format!.(at least 8 characters that includes 1 letter,1 digit,1 special character(@%$#!*&))";
        userPassword.focus();
        return false;
    }
}
let checkEmail=()=>{
    let email = userEmail.value;
    // let pattern=/[a-zA-Z0-9.-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    let pattern=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g; 
    let err = document.querySelector('.emailErr');
    if(pattern.test(email)){
        err.innerHTML="";
        return true;
    }else{
        err.innerHTML="incorrect email format";
        userEmail.focus();
        return false;
    }
}
let check=()=>{
    let result = checkName() && checkPassword() && checkEmail();
    return result;
}
document.getElementById("userName").addEventListener("change",checkName);
document.getElementById("userPassword").addEventListener("change",checkPassword);
document.getElementById("userEmail").addEventListener("change",checkEmail);
</script>
