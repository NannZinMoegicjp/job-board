@extends('master')
@section('content')
{{-- carousel --}}
<section>
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="images/anandacarousel.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="images/cocacolacarousel.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/unilevercarousel.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/grandroyralcarousel (1).jfif" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
{{--homepage search --}}
<section>
    <div class="bg-opacity py-5">
        <div class="content">
            <div class=" d-flex flex-column justify-content-center align-items-center h-100">
                <h1 class="text-center">The Easiest Way to Get Your Job</h1>
                <h3 class="text-center">Find Jobs, Employment & Career Opportunities</h3>
                <form action="{{url('/jobs/filter')}}" method="get" class="container my-3 searchbgcolor p-3 rounded-1">
                    @csrf
                    <div class="row g-lg-1 g-2">
                        <div class="col-lg col-md-6">
                            <input class="form-control" name="position" type="text" placeholder="Positions"
                                aria-label="positions">
                        </div>
                        <div class="col-lg col-md-6">
                            <select class="form-select" aria-label="job categories" name="category">
                                <option value="0">All job categories</option>
                                @foreach($data['categories'] as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg col-md-6">
                            <select class="form-select" aria-label="job locations" name="state" id="state">
                                <option value="0">All locations</option>
                                @foreach($data['states'] as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg col-md-6">
                            <input type="submit" class="border form-control greenBtn btn" value="Find jobs">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
{{-- recents jobs --}}
<section class="bg-light">
    <div class="container-fluid py-4">
        <h3 class="text-center"><span class="titleFirstPart">Recent</span> <span class="titleSecondPart">Jobs</span>
        </h3>
        <div class="row g-4 py-2">
            @if(isset($data["jobs"]))
            @foreach($data["jobs"] as $job)
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <div class="shadow d-flex flex-column justify-content-center align-items-center py-5 job">
                    <img src="{{URL::asset('images/companies/'.$job->address->company->logo)}}" alt="company image"
                        class="me-2 p-1 companyImg">
                    <h5 class="text-center">{{$job->title}}</h5>
                    <p class="mb-2 text-center">{{$job->address->city->state->name}}</p>
                    <p class="text-secondary mb-4 text-center">{{$job->employmentType->name}}</p>
                    <a href="{{url('jobs/details/'.$job->id)}}">
                        <button class="button-18 greenBtn" role="button">view details</button>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="text-center mt-3">
            <a href="{{url('/jobs')}}" class="text-decoration-none text-dark">View more<i
                    class="bi bi-arrow-right-short ms-2"></i></a>
        </div>
    </div>
</section>
{{-- popular categories --}}
<section class="bg-light">
    <div class="container-fluid py-4 categories">
        <h3 class="text-center"><span class="titleFirstPart">Popular </span> <span
                class="titleSecondPart">Categories</span> </h3>
        <div class="row g-4 py-2">
            @if(isset($data["popCategories"]))
            @foreach($data["popCategories"] as $category)
            <div class="col-md-4 col-6 col-xs-12">
                <a href="{{route('jobs-by-category',[$category->id])}}" class="text-decoration-none">
                    <div class="category py-2 shadow">
                        <div class="d-flex p-2">
                            <div class="circle p-3 bg-white me-2">
                                <img src="{{URL::asset('images/categories/'.$category->image)}}" alt="categor image">
                            </div>
                            <p class="text-black">{{$category->name}}<br> <span
                                    class="text-secondary">{{$category->job_count}}
                                    jobs</span></p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
            <div class="text-center mt-3">
                <a href="{{route('all-categories')}}" class="text-decoration-none text-dark">View more<i
                        class="bi bi-arrow-right-short ms-2"></i></a>
            </div>
        </div>
    </div>
</section>
{{-- top employers --}}
<section>
    <div class="container-fluid py-4">
        <div class="row py-2 companies">
            @if(isset($data["companies"]))
            @foreach($data["companies"] as $company)
            <div class="col-md-2 col-6 col-xs-12 text-center">
                <a href="{{route('company-details',[$company->id])}}">
                    <div class="company">
                        <img src="{{URL::asset('images/companies/'.$company->logo)}}" alt="company image"
                            class="img img-fluid">
                        <h6 class="my-2">{{$company->company_name}}</h6>
                    </div>
                </a>
            </div>
            @endforeach
            @endif            
        </div>
        <div class="text-center">
        <a href="{{route('all-companies')}}"><button class="button-18 greenBtn mb-4" role="button">view
                        all employers</button></a>
            </div>
    </div>
</section>

{{-- featured locations --}}
<section class="bg-light">
    <div class="container py-4">
        <h3 class="text-center"><span class="titleFirstPart">Featured</span> <span
                class="titleSecondPart">Locations</span></h3>
        <div class="row g-4 py-2">
            @if(isset($data["popularStates"]))
            @foreach($data["popularStates"] as $state)
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <a href="{{ route('jobs-by-category',[$state->id]) }}" class="text-decoration-none">
                    <div class="bg-white text-center shadow location position-relative">
                        <img src="{{URL::asset('images/states/'.$state->image)}}" alt="" class="img-fluid">
                        <p class="p-1">
                            <span class="cityName">{{$state->name}}</span>
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
        <div class="text-center">
            <a href="{{route('all-locations')}}">
                <button class="button-18 greenBtn" role="button">View all locations</button>
            </a>
        </div>
    </div>
</section>
@endsection