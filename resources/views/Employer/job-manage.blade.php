@extends('Employer.master_employer')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
@section('content')
<div class="container my-4">
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        @if (session('noCredit'))
        <div class="alert alert-danger">
            {{session('noCredit')}}
        </div>
        @endif
    </div>
    <div class="d-flex">
        <h3> Active Jobs</h3>
        <div class="ms-auto">
            <a href="{{url('/employer/jobs/insert')}}" onclick="return hasCredit();">
                <button type="button" class="ms-auto btn btn-primary">
                    <i class="bi bi-plus"></i> Post job
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
                    <th>Title</th>
                    <th>Experience Level</th>
                    <th>Posted date</th>
                    <th>Expired date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$job->title}}</td>
                    <td>{{$job->experienceLevel->name}}</td>
                    <td>{{$job->created_at->toDateString()}}</td>
                    <td>{{Carbon\Carbon::create($job->created_at)->addMonths(6)->toDateString()}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{url('/employer/job/details/'.$job->id)}}"><i
                                    class="bi bi-info-circle-fill info"></i></a>
                            <a href="{{url('/employer/job/update/'.$job->id)}}"><i
                                    class="bi bi-pencil-fill update"></i></a>
                            <a onclick='return confirm("Want to delete job?")'
                                href="{{url('/employer/job/delete/'.$job->id)}}"><i
                                    class="bi bi-trash3-fill cancel me-2"></i></a>
                            <a onclick='return confirm("Want to close job?")'
                                href="{{url('/employer/job/deactivate/'.$job->id)}}"><i
                                    class="bi bi-bell-slash-fill"></i></a>
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