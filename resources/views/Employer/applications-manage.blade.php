@extends('Employer.master_employer')
@section('content')
<div class="container-fluid my-4">
    @if(session(status))
        <div class="alert alert-success">

        </div>                              
    @endif
    @if(session(error))
        <div class="alert alert-danger">

        </div>
    @endif
    div class="table-responsive">
        <table class="table table-striped" id="datatable">
            @php
            $no=1;
            @endphp
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Applicant</th>
                    <th>Applied date</th>
                    <th>Cv file</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$application->job->title}}</td>
                    <td>{{$application->jobSeeker->name}}</td>
                    <td>{{$application->created_at}}</td>
                    <td></td>
                    <td>
                        <div class="d-flex">
                            <a href="{{url('/employer/application/details/'.$application->id)}}"><i
                                    class="bi bi-info-circle-fill info"></i></a>
                            <a href="{{url('/employer/application/update/'.$application->id)}}"><i
                                    class="bi bi-pencil-fill update"></i></a>
                            <a onclick='return confirm("Want to delete application?")'
                                href="{{url('/employer/application/delete/'.$application->id)}}"><i
                                    class="bi bi-trash3-fill cancel me-2"></i></a>
                            <a onclick='return confirm("Want to close application?")'
                                href="{{url('/employer/application/deactivate/'.$application->id)}}"><i
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