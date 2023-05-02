@extends('master_admin')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="d-flex my-4">
        <div>
            <h3>Admins</h3>
        </div>
        <div class="ms-auto">
            <a href="{{url('/admin/add')}}">
                <button type="button" class="ms-auto btn btn-primary">
                    <i class="bi bi-plus"></i> Add Admin
                </button>
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="datatable">
            @php
            $no=1;
            @endphp
            <thead>
            <tr>
                <th>No</th>
                <th>Profile Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>           
            <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{$no++}}</td>
                <td><img src="{{URL::asset('/images/admins/'.$admin->profile_image)}}" alt="" class="myimg"></td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->phone}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url('/admin/details/'.$admin->id)}}"><i
                                class="bi bi-info-circle-fill info"></i></a>
                        <a onclick='return confirm("Want to delete?")'
                            href="{{url('/admin/delete/'.$admin->id)}}"><i
                                class="bi bi-trash3-fill cancel"></i></a>
                    </div>
                </td>
            </tr>            
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatable').dataTable();
});
</script>
@endsection