<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Job board admin template</title>
    <link rel="stylesheet" href="{{URL::asset('css/admin.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/order.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}" />
    @yield('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/style.css')}}">
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="{{route('home')}}" class="logo">
                    <img src="{{URL::asset('/images/jobsearchicon1.png')}}" width="35" height="35" alt=""> <span>Job
                        Board</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul class="mynav">
                        <li>
                            <a href="{{url('/admin/profile/1')}}"><i class="fa-solid fa-user"></i>
                                <span>profile</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/pricing')}}"><i class="bi bi-cash-coin"></i> <span>Price</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/payment')}}"><i class="bi bi-cart-plus-fill"></i>
                                <span>Orders</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/companies')}}"><i class="bi bi-building"></i>
                                <span>Companies</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/jobs')}}"><i class="bi bi-briefcase-fill"></i> <span>Jobs</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/job-seekers')}}"><i class="bi bi-person-workspace"></i> <span>Job
                                    Seekers</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/payment-methods')}}"><i class="bi bi-credit-card-2-front-fill"></i>
                                <span>Payment Accounts</span></a>
                        </li>
                        <li>
                            {{-- <a href="{{url('/admin/job-seekers')}}"><i class="bi bi-person-workspace"></i>
                            <span>Admin Management</span></a> --}}
                        </li>
                        <li>
                            @if (auth()->check())
                            <a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button>logout</button>
                                </form>
                            </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            @section('content')

            @show
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{URL::asset('/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/jquery.slimscroll.js')}}"></script>
    <script src="{{URL::asset('/js/Chart.bundle.js')}}"></script>
    <script src="{{URL::asset('/js/app.js')}}"></script>
    @section('scripts')

    @show
</body>

</html>