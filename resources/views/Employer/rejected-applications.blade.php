@extends('Employer.master_employer')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
@section('content')
<div class="container-fluid my-4">   
    <h3>Rejected Applications</h3>
    <div class="table-responsive">
        <table class="table table-striped" id="datatable">
            @php
            $no=1;
            @endphp
            <thead>
                <tr class="align-middle">
                    <th>No</th>
                    <th>Title</th>
                    <th>Applicant</th>
                    <th>Applied date</th>
                    <th>Cv file</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                <tr class="align-middle">
                    <td>{{$no++}}</td>
                    <td>{{$application->job->title}}</td>
                    <td>{{$application->jobSeeker->name}}</td>
                    <td>{{$application->created_at->todatestring()}}</td>
                    <td><a onclick="return confirm('Want to download cv file?')" href="{{URL::asset('/applications/'.$application->cvfile)}}" download="{{$application->cvfile}}">{{$application->cvfile}}</a></td>
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