@extends('welcome')
@section('content')
<div class="container-fluid">
    <div class="row my-2">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }} <br>
            @endforeach
        </div>
        @endif
    </div>
    <div class="row my-3">
        <div class="col-md-7 col-12 mb-1">
            <form action="{{route('admin.change.password')}}" class="bg-white px-3 pb-2 rounded shadow"
                method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Change password</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="currentPass">Current password</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control" required name="currentPass" id="currentPass"
                            value="{{old('currentPass')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password">New password</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control @error('password.confirmed') is-invalid @enderror" required name="password" id="password"
                        value="{{old('password')}}">
                    </div>
                </div> 
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password_confirmation">Confirm password</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control" required name="password_confirmation" id="password_confirmation"
                        value="{{old('password_confirmation')}}">
                        <span>***one lowercase letter, one uppercase letter, one digit, and one special character</span>                        
                    </div>
                </div>   
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/admin')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
       </div>
</div>
@endsection