<form action="register_success.php" method="post" class="bg-white px-3 pb-2 rounded shadow-lg"
    onsubmit="return check();">
    <div id="error"></div>
    <div>
        <h4 class="text-center py-4">Sign up for job seeker</h4>
    </div>
    <div class="row mb-3">
        <div class="col-md-8 offset-md-2 col-12">
            <input type="text" class="form-control" required name="userName" id="userName" placeholder="Name">
        </div>
        <!-- <div id="nameError" class="text-danger"></div>                       -->
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
            <input type="password" class="form-control" required placeholder="Confirm password"
                name="userConfirmPassword" id="userConfirmPassword">
            <!-- <div id="validationConfirmPassFeedback" class="invalid-feedback d-none">
                                password does not match
                                </div> -->
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
