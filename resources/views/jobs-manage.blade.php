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
            <h3>Jobs</h3>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            @php
            $no=1;
            @endphp
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Opening positions</th>
                <th>Posted date</th>
                <th>Actions</th>
            </tr>
            @foreach ($jobs as $job)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$job->title}}</td>
                <td>{{$job->open_position}}</td>
                <td>{{$job->created_at}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url('/admin/job/details/'.$job->id)}}"><i class="bi bi-info-circle-fill info"></i></a>
                        <a href="{{url('/admin/job/update/'.$job->id)}}"><i class="bi bi-pencil-fill update"></i></a>
                        <a onclick='return confirm("Want to delete?")'  href="{{url('/admin/job/delete/'.$job->id)}}"><i
                                class="bi bi-trash3-fill cancel"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection