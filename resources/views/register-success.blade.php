@extends('master')
@section('content')
<section class="bg-light py-2">
    <div class="container bg-white my-4 pageContent d-flex flex-column justify-content-center align-items-center">
        <p>Registered successfully. Please login in</p>
        <p class="mt-2"><a href="{{ url('/login') }}" class="btn btn-secondary">login</a></p>
    </div>   
</section>
@endsection