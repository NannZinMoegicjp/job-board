var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("step");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n == (x.length - 1)) {
        if (document.getElementById("post")) {
            document.getElementById("nextBtn").innerHTML = "Post";
        } else if (document.getElementById("update")) {
            document.getElementById("nextBtn").innerHTML = "Update";
        }
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("step");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("signUpForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("step");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].classList.add("is-invalid");
            y[i].nextElementSibling.classList.remove("d-none");
            y[i].nextElementSibling.classList.add("d-inline-block");
            // and set the current valid status to false
            valid = false;
        }
    }
    selectboxes = x[currentTab].getElementsByTagName("select");
    for (i = 0; i < selectboxes.length; i++) {
        // If a field is empty...
        if (selectboxes[i].value == "") {
            // add an "invalid" class to the field:
            selectboxes[i].classList.add("is-invalid");
            selectboxes[i].nextElementSibling.classList.remove("d-none");
            selectboxes[i].nextElementSibling.classList.add("d-inline-block");
            // and set the current valid status to false
            valid = false;
        }
    }
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checked = false;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checked = true;
            break;
        }
    }
    if (!checked) {
        var genderError = document.getElementById("genderError");
        genderError.classList.remove("d-none");
        genderError.classList.add("d-inline-block");
    }
    var minSalary = document.getElementById('minSalary').value;
    var maxSalary = document.getElementById('maxSalary').value;
    var salaryError = false;
    if (maxSalary < minSalary) {
        var salaryError = document.getElementById("salaryError");
        salaryError.classList.remove("d-none");
        salaryError.classList.add("d-inline-block");
        salaryError = true;
    }
    var emptyDesc = false;
    var editor1 = tinymce.get("myeditorinstance1");
    var value1 = editor1.getContent();
    if (currentTab == 1 && value1.trim().length<1) {  
        editor1.getElement().classList.add("is-invalid");
        var descriptionError = document.getElementById("descriptionError");
        descriptionError.classList.remove("d-none");
        descriptionError.classList.add("d-inline-block");
        emptyDesc = true;
    }
    var emptyRequirement = false;
    var editor2 = tinymce.get("myeditorinstance2");
    var value2 = editor2.getContent();
    if (currentTab == 2 && value2.trim().length<1) {    
        editor2.getBody().classList.add("is-invalid");
        var requirementError = document.getElementById("requirementError");
        requirementError.classList.remove("d-none");
        requirementError.classList.add("d-inline-block");
        emptyRequirement = true;
    }
    alert(emptyDesc);
    var result = valid && checked && !salaryError && !emptyDesc && !emptyRequirement;
    // If the valid status is true, mark the step as finished and valid:
    if (result) {
        document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
    }
    return result; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("stepIndicator");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}