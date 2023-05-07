@extends('welcome')
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
            <h3>Jobs</h3>
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
                <th>Company</th>
                <th>Title</th>
                <!-- <th>Opening positions</th> -->
                <th>Posted date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($jobs as $job)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$job->address->company->company_name}}</td>
                <td>{{$job->title}}</td>
                <!-- <td>{{$job->open_position}}</td> -->
                <td>{{$job->created_at}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url('/admin/job/details/'.$job->id)}}"><i class="bi bi-info-circle-fill info"></i></a>
                        {{-- <a href="{{url('/admin/job/update/'.$job->id)}}"><i class="bi bi-pencil-fill update"></i></a> --}}
                        <a onclick='return confirm("Want to delete?")'  href="{{url('/admin/job/delete/'.$job->id)}}"><i
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