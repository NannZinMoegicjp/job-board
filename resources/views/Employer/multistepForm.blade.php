@extends('Employer.master_employer')
@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/css/multistepFormStyle.css')}}" />
<x-head.tinymce-config/>
@endsection
@section('content')
<h3 class="text-center">Post job</h3>
<form id="signUpForm" action="{{url('/multiStepForm/add')}}" method="post">
    @csrf
    <!-- start step indicators -->
    <div class="form-header d-flex mb-4">
        <span class="stepIndicator">Job information</span>
        <span class="stepIndicator">Description</span>
        <span class="stepIndicator">Requirements</span>
        <span class="stepIndicator">Benefits</span>
    </div>
    <!-- end step indicators -->

    <!-- step one -->
    <div class="step">
        <p class="text-center mb-4">Job detial information</p>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="title">Title</label>
            </div>
            <div class="col-md-7 col-12">                
                <input type="text" class="form-control" required name="title" id="title" value="{{ old('title') }}"
                    oninput="this.className = 'form-control'">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="minSalary">Min Salary</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" class="form-control" required name="minSalary" id="minSalary" value="{{ old('salary') }}"
                    oninput="this.className = 'form-control'">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12">
                <label for="maxSalary">Max Salary</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" class="form-control" required name="maxSalary" id="maxSalary" value="{{ old('salary') }}"
                    oninput="this.className = 'form-control'">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="openPosition">Open position</label>
            </div>
            <div class="col-md-7 col-12">
                <input type="number" class="form-control" id="openPosition" name="openPosition"
                    value="{{old('openPosition')}}" oninput="this.className = 'form-control'">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label>Gender</label>
            </div>
            <div class="col-md-7 col-12 d-flex">
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" value="female" id="female" name="female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="male" id="male" name="male">
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="jobCategory">Job Category</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="jobCategory" id="jobCategory" class="form-select">
                    @if(isset($data['jobCategories']))
                    @foreach ($data['jobCategories'] as $jobCat)
                    <option value="{{$jobCat['id']}}">{{$jobCat['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="expLevel">Experience level</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="expLevel" id="expLevel" class="form-select">
                    @if(isset($data['expLevels']))
                    @foreach ($data['expLevels'] as $expLev)
                    <option value="{{$expLev['id']}}">{{$expLev['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="empType">Employment type</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="empType" id="empType" class="form-select">
                    @if(isset($data['empTypes']))
                    @foreach ($data['empTypes'] as $empType)
                    <option value="{{$empType['id']}}">{{$empType['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 offset-md-1 col-12  col-form-label">
                <label for="address">City</label>
            </div>
            <div class="col-md-7 col-12">
                <select name="address" id="address" class="form-select">
                    @if(isset($data['addresses']))
                    @foreach ($data['addresses'] as $addr)
                    <option value="{{$addr['id']}}">{{$addr->city->state->name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <!-- step two -->
    <div class="step">
        <p class="text-center mb-4">Job descriptions</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance1" name="description"></textarea>
        </div>
    </div>

    <!-- step three -->
    <div class="step">
        <p class="text-center mb-4">Job requirements</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance2" name="requirement"></textarea>
        </div>
    </div>

    <div class="step">
        <p class="text-center mb-4">Job benefits</p>
        <div class="row mb-2">
            <textarea id="myeditorinstance3" name="benefit"></textarea>
        </div>
    </div>

    <!-- start previous / next buttons -->
    <div class="form-footer d-flex">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
    <!-- end previous / next buttons -->
</form>
@endsection
@section('scripts')
<script>
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
            document.getElementById("nextBtn").innerHTML = "Submit";
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
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
          }
          return valid; // return the valid status
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
</script>

@endsection