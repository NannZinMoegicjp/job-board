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
                <form action="" method="post" class="container my-3 searchbgcolor p-3 rounded-1">
                    @csrf
                    <div class="row g-lg-1 g-2">
                        <div class="col-lg-3 col-md-6">
                            <input class="form-control" type="text" placeholder="Positions,Companies"
                                aria-label="positions companies">
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <select class="form-select" aria-label="job categories">
                                <option selected>All job categories</option>
                                <option value="1">Sales, Business Development</option>
                                <option value="2">IT Hardware, Software</option>
                                <option value="3">Finance, Accounting, Audit</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <select class="form-select" aria-label="job locations">
                                <option selected>All job locations</option>
                                <option value="1">Yangon</option>
                                <option value="2">Mandalay</option>
                                <option value="3">Shan</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <button class="border-0 form-control greenBtn" role="button">Find jobs</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
{{-- recents jobs --}}
<section class="">
    <div class="container py-4">
        <h3 class="text-center"><span class="titleFirstPart">Recent</span> <span class="titleSecondPart">Jobs</span>
        </h3>
        <div class="row g-4 py-2">
            @if(isset($data["jobs"]))
            @foreach($data["jobs"] as $job)
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <div class="shadow d-flex flex-column justify-content-center align-items-center py-5 job">
                    <img src="{{URL::asset('images/companies/'.$job->address->company->logo)}}" alt="company image"
                        class="me-2 p-1">
                    <h5>{{$job->address->company->company_name}}</h5>
                    <p class="mb-2 text-center">{{$job->title}}</p>
                    <p class="mb-2 text-center">{{$job->address->city->name}}</p>
                    <p class="text-secondary mb-4 text-center">{{$job->employmentType->name}}</p>
                    <a href="{{url('job/details/'.$job->id)}}">
                        <button class="button-18 greenBtn" role="button">view details</button>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="text-center mt-3">
            <a href="" class="text-decoration-none text-dark">View more<i class="bi bi-arrow-right-short ms-2"></i></a>
        </div>
    </div>
</section>
{{-- popular categories --}}
<section class="bg-light">
    <div class="container py-4 categories">
        <h3 class="text-center"><span class="titleFirstPart">Popular </span> <span
                class="titleSecondPart">Categories</span> </h3>
        <div class="row g-3 py-2">
        @if(isset($data["popCategories"]))
            @foreach($data["popCategories"] as $category)
            <div class="col-md-4 col-6 col-xs-12">
                <a href="" class="text-decoration-none">
                    <div class="category py-2 shadow">
                        <div class="d-flex p-2">
                            <div class="circle p-3 bg-white me-2">
                                <img src="{{URL::asset('images/categories/'.$category->image)}}" alt="categor image">
                            </div>
                            <p class="text-black">{{$category->name}}<br> <span class="text-secondary">{{$category->job_count}}
                                    jobs</span></p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif            
            <div class="text-center mt-3">
                <a href="{{url('')}}">
                    <button class="button-18 greenBtn" role="button">View all categories</button>
                </a>
            </div>
        </div>
    </div>
</section>
{{-- top employers --}}
<section>
    <div class="container py-4">
        <div class="row py-2 companies">
        @if(isset($data["companies"]))
            @foreach($data["companies"] as $company)
            <div class="col-md-2 col-6 col-xs-12 text-center">
                <a href="">
                    <div class="company">
                        <img src="{{URL::asset('images/companies/'.$company->logo)}}" alt="company image" class="img img-fluid">
                        <h6 class="my-2">{{$company->company_name}}</h6>
                    </div>
                </a>
            </div>
            @endforeach
            @endif 
            <div class="col-md-2 col-6 col-xs-12 d-flex justify-content-center align-items-center">
                <a href=""><button class="button-18 myBtn mb-4" role="button">All employers</button></a>
            </div>
        </div>
    </div>
</section>
{{--popular industries --}}
<section class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-5 p-3">
                <a href="{{url('/industries')}}"><button class="button-18 myBtn mb-4" role="button">Job
                        industries</button></a>
                <div class="w-75">
                    <h4>Explore job by most popular industry</h4>
                </div>
                <p class="text-secondary">Discover jobs most relevant to you by experience
                    level,salary,location,employment type, etc.</p>
            </div>
            <div class="col-md-6">
                <div class="industries d-flex border-bottom my-1">
                    <div
                        class="bg-white me-4 circle borderColor1 shadow p-3 mb-2 d-flex justify-content-center align-items-center">
                        <img src="images/industries/o9SXyF4kPWv_4nhtaCnNLIHZvbkpWNN_R4gvPr13CNeZ-0lU0PgZXO9yhvuyC5lWKpFcn9yIfHo=.png"
                            alt="it/computer">
                    </div>
                    <div>
                        <p class="fs-5">Trading/Distribution/Import/Export</p>
                        <!-- <a href="" class="text-decoration-none text-black">
                            <small class="text-secondary">1200+ jobs</small>
                            </a> -->
                    </div>
                </div>
                <div class="industries d-flex border-bottom my-1">
                    <div
                        class="bg-white me-4 circle borderColor1 shadow p-3 mb-2 d-flex justify-content-center align-items-center">
                        <img src="images/industries/education.png" alt="it/computer">
                    </div>
                    <div>
                        <a href="" class="text-decoration-none text-black">
                            <h5>Education/Training</h5>
                        </a>
                        <small class="text-secondary">1200+ jobs</small>
                    </div>
                </div>
                <div class="industries d-flex border-bottom my-1">
                    <div
                        class="bg-white me-4 circle borderColor1 shadow p-3 mb-2 d-flex justify-content-center align-items-center">
                        <img src="images/industries/it.png" alt="it/computer">
                    </div>
                    <div>
                        <a href="" class="text-decoration-none text-black">
                            <h5>IT/Computer</h5>
                        </a>
                        <small class="text-secondary">1200+ jobs</small>
                    </div>
                </div>
                <div class="industries d-flex border-bottom my-1">
                    <div
                        class="bg-white me-4 circle borderColor1 shadow p-3 mb-2 d-flex justify-content-center align-items-center">
                        <img src="images/industries/food-and-beverage.png" alt="it/computer">
                    </div>
                    <div>
                        <a href="" class="text-decoration-none text-black">
                            <h5>Food and Beverage</h5>
                        </a>
                        <small class="text-secondary">1200+ jobs</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- featured locations --}}
<section class="">
    <div class="container py-4">
        <h3 class="text-center"><span class="titleFirstPart">Featured</span> <span
                class="titleSecondPart">Locations</span></h3>
        <div class="row g-4 py-2">
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <a href="" class="text-decoration-none">
                    <div class="bg-white text-center shadow location position-relative">
                        <img src="images/cities/mandalay.jpg" alt="" class="img-fluid">
                        <p class="py-1">
                            <span class="cityName">Mandalay</span>
                            (<span class="noOfJobs">300 jobs</span>)
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <div class="bg-white text-center shadow location position-relative">
                    <img src="images/cities/yangon.jpg" alt="" class="img-fluid">
                    <p class="p-1">
                        <span class="cityName">Mandalay</span>
                        (<span class="noOfJobs">300 jobs</span>)
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <div class="bg-white text-center shadow location position-relative">
                    <img src="images/cities/innlaylake.jpg" alt="" class="img-fluid">
                    <p class="p-1">
                        <span class="cityName">Mandalay</span>
                        (<span class="noOfJobs">300 jobs</span>)
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 col-xs-12">
                <div class="bg-white text-center shadow location position-relative">
                    <img src="images/cities/naypyidaw.jpg" alt="" class="img-fluid">
                    <p class="p-1">
                        <span class="cityName">Mandalay</span>
                        (<span class="noOfJobs">300 jobs</span>)
                    </p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{url('/locations')}}">
                <button class="button-18 greenBtn" role="button">View all locations</button>
            </a>
        </div>
    </div>
</section>
@endsection