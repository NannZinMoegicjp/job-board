<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job board</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    {{-- navbar --}}
    <section class="sticky-top">
        <nav class="navbar navbar-light navbar-expand-lg mynavbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <div>
                        <img src="{{ asset('images/jobsearchicon1.png') }}" alt="" class="me-2 logoImg">
                        <span class="navbarBrand">JOB BOARD</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav nav nav-underline ms-auto mynavs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('all-jobs')}}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('all-categories')}}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('all-locations')}}">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('all-industries')}}">Industries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('all-companies')}}">Companies</a>
                        </li>
                        <li>
                            @if(auth()->guard('jobseeker')->check() || auth()->guard('employer')->check() ||
                            auth()->guard('admin')->check())
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (auth()->guard('jobseeker')->check())
                                    {{auth()->guard('jobseeker')->user()->name}}
                                    @elseif(auth()->guard('employer')->check())
                                    {{auth()->guard('employer')->user()->contact_person}}
                                    @elseif(auth()->guard('admin')->check())
                                    {{auth()->guard('admin')->user()->name}}
                                    @endif
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        @if (auth()->guard('jobseeker')->check())
                                        <a href="{{ route('jobseeker.dashboard') }}"
                                            class="text-decoration-none text-dark">dashboard</a>
                                        @elseif(auth()->guard('employer')->check())
                                        <a href="{{ route('employer.dashboard') }}"
                                            class="text-decoration-none text-dark">dashboard</a>
                                        @elseif(auth()->guard('admin')->check())
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="text-decoration-none text-dark">dashboard</a>
                                        @endif
                                    </li>
                                    <li>
                                        <a class="nav-link">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger">logout</button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </li>
                        @if(!auth()->guard('jobseeker')->check() && !auth()->guard('employer')->check() &&
                        !auth()->guard('admin')->check())
                        <li class="nav-item">
                            <a href="{{route('register')}}"><button class="button-18 registerBtn mb-4"
                                    role="button">Register</button></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('login')}}"><button class="button-18 myBtn mb-4"
                                    role="button">login</button></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    {{-- content --}}
    @section('content')
    @show
    {{-- footer --}}
    <footer class="container-fluid">
        <div class="row py-3">
            <div class="col-md-1"></div>
            <div class="col-md-3 col-12 socialMedia d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <a href="#" class="text-decoration-none">
                        <img src="{{ asset('images/jobsearchicon1.png') }}" class="logoImg" alt="">
                        <span class="navbarBrand">JOB BOARD</span>
                    </a>
                </div>
                <div>
                    <a href="https://www.facebook.com"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.linkedin.com"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.twitter.com"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.telegram.com"><i class="bi bi-telegram"></i></a>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <p class="text-white">QUICK LINKS</p>
                <ul class="quickLinks">
                    <li><a href="{{route('all-jobs')}}">Jobs</a></li>
                    <li><a href="{{route('all-categories')}}">Categories</a></li>
                    <li><a href="{{route('all-companies')}}">Companies</a></li>
                    <li><a href="{{route('all-industries')}}">Industries</a></li>
                    <li><a href="{{route('all-locations')}}">Locations</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-12">
                <div class="address">
                    <p><i class="bi bi-geo-alt"></i> <br> No.220A,East Horse Racing Course Road, Room No.3A,Tamwe A
                        Wine Lay Condo,Tamwe Township,Yangon.</p>
                    <p><i class="bi bi-envelope"></i> <br> Helpdesk@myjobs.com.mm <br> Inquiry@myjobs.com.mm</p>
                    <p><i class="bi bi-voicemail"></i> <br> +95 9 313 49834</p>
                </div>
            </div>
        </div>
        <p class="text-center text-secondary mb-0">Copyright © 2023 GIC. All Rights Reserved. Powered by: NZM</p>
    </footer>
    <!-- <script>
        setTimeout(function() {
          $('.alert').fadeOut('fast');
         }, 5000); // 3 seconds (time is in milliseconds)
    </script> -->
</body>

</html>