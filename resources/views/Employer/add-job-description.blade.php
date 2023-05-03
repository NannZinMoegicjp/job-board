@extends('Employer.master_employer')
@section('content')
<div class="container-fluid">
    <div class="row my-2">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }} <br>
            @endforeach
        </div>
        @endif
    </div>
    <div class="row text-end my-2">
        <a href="{{url('/employer/jobs')}}">job list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-3">       
        <div class="col-md-8 offset-md-2 col-12">
            
        </div>
    </div>
</div>
@endsection
