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
    <div class="d-flex mb-3">
        <div>
            <h3>Companies</h3>
        </div>
        <div class="ms-auto">
            <a href="{{url('/admin/company/add')}}">
                <button type="button" class="ms-auto btn btn-primary">
                    <i class="bi bi-plus"></i> Add Companies
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
                <th>Company name</th>
                <th>Contact person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>           
            <tbody>
            @foreach ($companies as $company)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$company->company_name}}</td>
                <td>{{$company->contact_person}}</td>
                <td>{{$company->email}}</td>
                <td>{{$company->phone}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url('/admin/company/details/'.$company->id)}}"><i
                                class="bi bi-info-circle-fill info"></i></a>
                        <a href="{{url('/admin/company/add/credit/'.$company->id)}}"><i
                                class="bi bi-pencil-fill update"></i></a>
                        <a onclick='return confirm("Want to delete?")'
                            href="{{url('/admin/company/delete/'.$company->id)}}"><i
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