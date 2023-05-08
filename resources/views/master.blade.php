<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    {{-- navbar --}}
    <section>
        <nav class="navbar navbar-light navbar-expand-lg mynavbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <div>
                        <img src="images/jobsearchicon1.png" alt="" class="me-2 logoImg">
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
                            <a class="nav-link" href="{{url('/jobs')}}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/categories')}}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/locations')}}">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/industries')}}">Industries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Companies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/register')}}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/login')}}" class="text-decoration-none">
                                <button class="button-18 greenBtn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    {{-- content --}}
    <div class="pageContent">
        @section('content')
        @show
    {{-- footer --}}
    <footer class="container-fluid">        
        <div class="row py-3">
            <div class="col-md-1"></div>    
            <div class="col-md-3 socialMedia d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <a href="#" class="text-decoration-none">
                        <img src="images/jobsearchicon1.png" class="logoImg" alt="">
                        <span class="navbarBrand">JOB BOARD</span>
                    </a>                    
                </div>
                <div>
                    <a href=""><i class="bi bi-facebook"></i></a>                
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-telegram"></i></a>
                </div>
            </div> 
            <div class="col-md-3">
                <p class="text-white">QUICK LINKS</p>
                <ul class="quickLinks">
                    <li><a href="">Jobs</a></li>
                    <li><a href="">Categories</a></li>
                    <li><a href="">Companies</a></li>
                    <li><a href="">Industries</a></li>
                    <li><a href="">Locations</a></li>
                </ul>
            </div> 
            <div class="col-md-4">                                
                <div class="address">
                    <p><i class="bi bi-geo-alt"></i> <br> No.220A,East Horse Racing Course Road, Room No.3A,Tamwe A Wine Lay Condo,Tamwe Township,Yangon.</p>
                    <p><i class="bi bi-envelope"></i> <br> Helpdesk@myjobs.com.mm <br> Inquiry@myjobs.com.mm</p>
                    <p><i class="bi bi-voicemail"></i> <br> +95 9 313 49834</p>
                </div>
            </div>         
        </div>
        <p class="text-center text-secondary mb-0">Copyright © 2023 GIC. All Rights Reserved. Powered by: NZM</p>
    </footer>
</body>
</html>