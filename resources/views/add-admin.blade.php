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
    <div class="row text-end my-2">
        <a href="{{url('/admin/manage')}}">admin list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-3">
        <div class="col-md-8 offset-md-2 col-12">
            <form action="{{url('/admin/add')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Add Admin</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="name" id="name"
                            value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userEmail">Email</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="email" class="form-control" required name="userEmail" id="userEmail"
                            value="{{ old('userEmail') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="profileImage" class="form-label">Profile image</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="profileImage" name="profileImage"
                            id="profileImage" value="{{old('profileImage')}}" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Add">
                        <a href="{{url('/admin/manage')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection