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
    <div class="d-flex mb-4">
        <div>
            <h3>Job seekers</h3>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="datatable">
            @php
            $no=1;
            @endphp
            <thead>
                <tr class="align-middle">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobSeekers as $jobseeker)
                <tr class="align-middle">
                    <td>{{$no++}}</td>
                    <td>{{$jobseeker->name}}</td>
                    <td>{{$jobseeker->email}}</td>
                    <td>{{$jobseeker->phone}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{url('/admin/job-seekers/details/'.$jobseeker->id)}}" class="me-2"><i
                                    class="bi bi-eye-fill" title="view job seeker details"></i></a>
                            <a onclick='return confirm("Want to delete?")'
                                href="{{url('/admin/job-seekers/delete/'.$jobseeker->id)}}"><i
                                    class="bi bi-trash3-fill cancel" title="delete job seeker"></i></a>
                        </div>
                    </td>
                    <td> <a href="{{route('reset.jobseeker.password',[$jobseeker->id])}}"
                            onclick='return confirm("Want to reset password?")'><button class="btn btn-primary">Reset
                                password</button></a></td>
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