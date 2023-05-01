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
            <h3>Job seekers</h3>
        </div>
        <div class="ms-auto">
            <a href="{{url('/admin/job-seekers/add')}}">
                <button type="button" class="ms-auto btn btn-primary">
                    <i class="bi bi-plus"></i> Add Job Seeker
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
                <!-- <th>Profile image</th> -->
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <!-- <th>Address</th> -->
                <!-- <th>Date of birth</th> -->
                <!-- <th>Gender</th> -->
                <th>Actions</th>
            </tr>
            @foreach ($jobSeekers as $jobseeker)
            <tr>
                <td>{{$no++}}</td>
                <!-- <td><img src="{{URL::asset('images/jobseekers/'.$jobseeker->image)}}" alt="" class="myimg"></td> -->
                <td>{{$jobseeker->name}}</td>
                <td>{{$jobseeker->email}}</td>
                <td>{{$jobseeker->phone}}</td>
                <!-- <td>{{$jobseeker->address}}</td>
                <td>{{$jobseeker->dob}}</td>
                <td>{{$jobseeker->gender}}</td>                 -->
                <td>
                    <div class="d-flex">     
                    <a href="{{url('/admin/job-seekers/details/'.$jobseeker->id)}}"><i class="bi bi-info-circle-fill info"></i></a>                   
                        <a href="{{url('/admin/job-seekers/update/'.$jobseeker->id)}}"><i
                                class="bi bi-pencil-fill update"></i></a>
                        <a onclick='return confirm("Want to delete?")'
                            href="{{url('/admin/job-seekers/delete/'.$jobseeker->id)}}"><i
                                class="bi bi-trash3-fill cancel"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection