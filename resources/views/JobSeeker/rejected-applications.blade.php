@extends('JobSeeker.master')
@section('content')
<div class="container my-2">
    <h3>Rejected applications</h3>
    <div class="row g-2">
        <div class="table-responsive my-5">
            <table class="table table-striped" id="datatable">
                @php
                $no=1;
                @endphp
                <thead>
                    <tr class="align-middle">
                        <th>No</th>
                        <th>Company</th>
                        <th>Title</th>
                        <th>Applied date</th>
                        <th>Posted date</th>
                        <th>Replied date</th>
                        <th>Job staus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['applications'] as $application)
                    <tr class="align-middle">
                        <td>{{$no++}}</td>
                        <td><a href="{{ route('company-details',[$application->job->address->company->id]) }}">{{$application->job->address->company->company_name}}</a></td>
                        <td><a href="{{ route('job-details',[$application->job->id]) }}">{{$application->job->title}}</a></td>
                        <td>{{$application->created_at->todatestring()}}</td>
                        <td>{{$application->job->created_at->todatestring()}}</td>
                        <td>{{$application->updated_at->todatestring()}}</td>                        
                        <td>@if($application->job->status == 'active') Open @else Closed @endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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