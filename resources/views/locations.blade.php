@extends('master')
@section('content')
<section class="bg-light">
    <h3 class="text-center title">Top Locations</h3>
    <div class="container">
        <div class="row g-4 py-2">
        @foreach ($locations as $location)
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <a href="{{route('jobs-by-state',[$location->id])}}" class="text-decoration-none">
                    <div class="bg-white text-center shadow location position-relative">
                        <img src="{{asset('images/states/'.$location->image)}}" alt="" class="img img-fluid">
                        <p class="py-1 fw-bold">
                            <span class="cityName">{{$location->name}}</span>
                        </p>
                    </div>
                </a>                    
            </div>
            @endforeach            
        </div>
    </div>
</section>
@endsection