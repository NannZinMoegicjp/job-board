<form action="" class="bg-white px-3 pb-2 rounded shadow-lg">
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
</form>