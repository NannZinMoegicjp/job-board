@extends('welcome')
@section('content')
<div class="container-fluid">
    <div class="row my-3">
        <div class="col-md-8 offset-md-2 col-12 mb-1">
            @if (isset($status))
            <div class="alert alert-success">
                {{ $status }}
            </div>
            @endif
            <form action="{{route('admin.change.password')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Change password</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="currentPass">Current password</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control  @if(session('currentPassError')) is-invalid @endif" required name="currentPass" id="currentPass"
                            value="{{old('currentPass')}}" />
                        @if(session('currentPassError'))
                        <span class="text-danger">{{ session('currentPassError') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password">New password</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control @error('password') is-invalid @enderror @if(session('newPassError')) is-invalid @endif" required
                            name="password" id="password" value="{{old('password')}}">
                        @error('password')
                        <span class="invalid-feedback">
                        <span class="text-danger">{{$message}}</span>
                        </span>
                        @enderror
                        @if(session('newPassError'))
                        <span class="text-danger">{{ session('newPassError') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password_confirmation">Confirm password</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            required name="password_confirmation" id="password_confirmation"
                            value="{{old('password_confirmation')}}">
                        @error('password_confirmation')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/admin')}}"><input type="button" class="btn-secondary btn" value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection