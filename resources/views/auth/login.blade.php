@extends('master')
@section('content')
<div class="container">
<div class="row my-5">
    <div class="col-md-8 offset-md-2 col-12 shadow">
        @if(isset($status))
        <div class="alert  alert-success">
            {{ $status }}
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="my-5">
            @csrf
            <div>
                <h4 class="text-center title">Login</h4>
            </div>
            <div class="row my-3">
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                          placeholder="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                        <input id="password" type="password" placeholder="password" value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3">
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
</div>
@endsection