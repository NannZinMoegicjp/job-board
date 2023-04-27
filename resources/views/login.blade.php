@extends('master')
@section('content')
<div class="row my-5">
    <div class="col-md-6 offset-md-3 col-12 shadow">
        <form action="" method="post" class="my-5">
            @csrf
            <div>
                <h4 class="text-center title">Login</h4>
            </div>
           
            
            <div class="row my-3">
                <!-- <div class="col-md-2 offset-md-2 col-12">
                    <label for="userEmail">Email</label>
                </div> -->
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <!-- <input type="text" class="form-control" required name="userEmail" id="userEmail" placeholder="Email"> -->
                </div>
            </div>
            <div class="row my-3">
                <!-- <div class="col-md-2 offset-md-2 col-12">
                    <label for="password">Password</label>
                </div> -->
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                        <input type="text" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                    </div>
                    <!-- <input type="text" class="form-control" required name="password" id="password" placeholder="Password"> -->
                </div>
            </div>
            <div class="row my-3">
                <!-- <div class="col-md-2 offset-md-2 col-12">
                    
                </div> -->
                <div class="col-md-6 offset-md-3 col-12">
                    <button class="btn form-control loginBtn">Login</button>
                </div>
            </div>
            <div class="text-center">
                Don't have account? <a href="{{url('/register')}}">Sign up here</a>
            </div>
        </form>
    </div>
</div>
@endsection