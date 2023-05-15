@extends('master')
@section('content')
<section class="bg-light">
    <h3 class="text-center title py-2">Top Job Industries</h3>
    <div class="container">
        <div class="row g-3 py-2 row-cols-lg-5">
            @foreach($industries as $industry)
            <div
                class="categories col-md-3 col-4 text-center d-flex flex-column justify-content-center align-items-center">
                <a href="{{route('jobs-by-industry',[$industry->id])}}" class="text-decoration-none">
                    <div class="circle mb-2 borderColor1 center bg-white">
                        <img src="{{asset('images/industries/'.$industry->image)}}" alt="" class="img img-fluid">
                    </div>
                    <p>
                        <span class="cityName">{{$industry->name}}</span>
                    </p>
                </a>                 
            </div>
            @endforeach            
        </div>
    </div>
</section>
@endsection