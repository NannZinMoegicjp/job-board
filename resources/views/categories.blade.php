@extends('master')
@section('content')
<section>
    <h3 class="text-center title py-2 shadow mb">Top Job Categories</h3>
    <div class="container my-3 categories">
        <div class="row g-3 py-2">
            @foreach($categories as $category)
            <div class="col-md-4 col-6 col-xs-12">
                <a href="{{route('jobs-by-category',[$category->id])}}" class="text-decoration-none">
                    <div class="category py-2">                        
                        <div class="d-flex p-2 align-items-center">
                            <div class="circle p-3 bg-white me-2">
                                <img src="{{asset('images/categories/'.$category->image)}}" alt="">
                            </div>
                            <p class="text-black">{{$category->name}}</p>
                        </div>  
                    </div> 
                </a>
            </div>
            @endforeach            
        </div>
    </div>
</section>
@endsection