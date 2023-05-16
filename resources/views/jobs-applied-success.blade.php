@extends('master')
@section('content')
<section class="bg-light py-2">
    <div class="container bg-white my-4 pageContent d-flex flex-column justify-content-center align-items-center">
        <p>Your application has been submitted!</p>
        <img src="{{asset('images/applylogo.png')}}">
        <p class="mt-2"><a href="{{ url('/jobs') }}" class="btn btn-secondary">View more jobs</a></p>
    </div>   
</section>
@endsection