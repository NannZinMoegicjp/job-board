<form action="{{url('/jobseeker/register')}}" method="post" class="bg-white px-3 pb-2 rounded shadow-lg"
    onsubmit="return check();">
    @csrf
    <div id="error"></div>
    <div>
        <h4 class="text-center py-4">Sign up for job seeker</h4>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="text" class="form-control" required name="userName" id="userName" placeholder="Name">
        </div>
        <div id="nameError" class="text-danger"></div>                      
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="email" class="form-control" required placeholder="Email" name="userEmail" id="userEmail">
            <!-- <div id="validationEmailFeedback" class="invalid-feedback d-none">
                                Incorrect email Format
                                </div> -->
            <div id="emailError" class="text-danger"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="number" class="form-control" min="0" required placeholder="Phone, eg. 09454096528"
                name="userPhoneNumber" id="userPhoneNumber">
            <!-- <div id="validationPhoneFeedback" class="invalid-feedback d-none">
                                at least 8 characters <br> at least one of [a-z],one of [A-Z],one of [0-9],one of [@#$%&*!^-_]
                                </div> -->
            <div id="phoneNoError" class="text-danger"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2  col-12">
            <input type="password" class="form-control mypassword position-relative" required placeholder="Password"
                name="userPassword" id="userPassword">
            <!-- <div id="validationPassFeedback" class="invalid-feedback d-none">
                                at least 8 characters <br> at least one of [a-z],one of [A-Z],one of [0-9],one of [@#$%&*!^-_]
                                </div> -->
            <div id="passError" class="text-danger"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="date" class="form-control" required placeholder="dob"
                name="dob" id="dob">            
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="password" class="form-control" required placeholder="Confirm password"
                name="userConfirmPassword" id="userConfirmPassword">
            
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="password" class="form-control" required placeholder="Confirm password"
                name="userConfirmPassword" id="userConfirmPassword">
            
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="password" class="form-control" required placeholder="Confirm password"
                name="userConfirmPassword" id="userConfirmPassword">
            
        </div>
        <div id="conPassError" class="text-danger"></div>
    </div>
    <div class="row my-4">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="submit" name="btnRegister" id="btnRegister" class="form-control border-1 registerBtn"
                value="Register">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12 text-black text-center">
            <span>Already have account? <a href="Login.php" class="">Login here</a></span>
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
