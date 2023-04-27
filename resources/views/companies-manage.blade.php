@extends('master_admin')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="d-flex">
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
        <table class="table table-striped">
            @php
            $no=1;
            @endphp
            <tr>
                <th>No</th>
                <th>Company name</th>
                <th>City</th>
                <th>Contact person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            @foreach ($companies as $company)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$company->company_name}}</td>
                <td>{{$company->city->name}}</td>
                <td>{{$company->contact_person}}</td>
                <td>{{$company->email}}</td>
                <td>{{$company->phone}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url('/admin/company/details/'.$company->id)}}"><i class="bi bi-eye-fill view"></i></a>
                        <a href="{{url('/admin/company/update/'.$company->id)}}"><i class="bi bi-pencil-fill update"></i></a>
                        <a onclick='return confirm("Want to delete?")'  href="{{url('/admin/company/delete/'.$company->id)}}"><i
                                class="bi bi-trash3-fill cancel"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection