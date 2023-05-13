@extends('welcome')
@section('content')
<div class="container-fluid">
    <div class="row my-2">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
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
            <form action="{{url('/admin/profile/update')}}" class="bg-white px-3 pb-2 rounded shadow"
                method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Update Profile</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="name" id="name"
                            value="{{$admin['name']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userEmail">Email</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="email" class="form-control" required name="userEmail" id="userEmail"
                            value="{{$admin['email']}}" disabled>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="number" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{$admin['phone']}}">
                    </div>
                </div>           
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/admin/profile')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5 col-12">
            <div class="row mb-3 d-flex justify-content-center shadow p-2">
                <div class="col-4">
                    <img src="{{URL::asset('images/admins/'.$admin->profile_image)}}" alt="" class="img img-fluid">
                </div>
                <div class="col-8">
                    <form action="{{url('/admin/profile/update/image')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control mb-2" name="newProfileImage"
                            id="newProfileImage" value="{{old('logofile')}}" required>
                        <input type="submit" class="btn btn-outline-primary" value="upload new profile">
                    </form>
                </div>
            </div>         
        </div>       
        
    </div>
</div>
@endsection