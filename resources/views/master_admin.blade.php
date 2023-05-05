<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job board</title>
    <link rel="stylesheet" href="{{URL::asset('css/admin.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/order.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}" />
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid">
        <div class="row border-bottom top">
            <div class="col-12">
                <div class="text-warning p-2s d-flex justify-content-md-end">
                    <img src="{{URL::asset('images/admin.png')}}" alt="admin image" class="adminImg m-2">
                    <div class="dropdown m-2">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{session('name')}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a class="dropdown-item" href="{{url('/admin/profile/1')}}"><i
                                        class="fa-solid fa-user"></i> profile</a></li>
                            <li><a class="dropdown-item" href=""><i class="fa-solid fa-right-from-bracket"></i>
                                    logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 left border-end">
                <nav class="navbar navbar-light navbar-expand-lg mynavbar position-lg-fixed">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon text-white"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav nav flex-column">
                                <li class="nav-item">
                                    <a href="{{url('/admin')}}"><i class="bi bi-house-fill"></i> Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/pricing')}}"><i class="bi bi-cash-coin"></i> Price
                                        Management</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/payment')}}"><i class="bi bi-cart-plus-fill"></i> Order
                                        Confirmation</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/companies')}}"><i class="bi bi-building"></i> Companies
                                        Management</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/job-seekers')}}"><i class="bi bi-person-workspace"></i> Job
                                        Seekers Management</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/jobs')}}"><i class="bi bi-briefcase-fill"></i> Jobs
                                        Management</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/payment-methods')}}"><i
                                            class="bi bi-credit-card-2-front-fill"></i> Payment Account
                                        Management</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin/manage')}}"><i class="bi bi-person-fill-lock"></i> Admin
                                        Management</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-10">
                @section('content')
                @show
            </div>
        </div>
    </div>
    @section('scripts')
    @show
</body>

</html>