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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/style.css')}}">
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <a href="{{route('home')}}">
                <div class="header-left">
                    <img src="{{URL::asset('/images/jobsearchicon1.png')}}" width="35" height="35" alt=""> <span
                        class="text-white">Job
                        Board</span>
                </div>
            </a>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            <div class="text-warning d-flex justify-content-end align-items-center me-5 mt-1">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="background: white" src="{{URL::asset('images/companies/'.auth()->guard('employer')->user()->logo)}}" alt="{{auth()->guard('employer')->user()->contact_person}}"
                        class="adminImg">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{url('/employer/profile')}}">
                            proflie</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/employer/change/password') }}">change password</a></li>
                        <li>
                            @if (auth()->check())
                            <a class="dropdown-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input type="submit" value="logout">
                                </form>
                            </a>
                            @endif
                        </li>
                    </ul>
                  </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul class="mynav">
                        <li>
                            <a href="{{url('/employer')}}"><i class="fa fa-dashboard"></i> <span>Employer
                                    Dashboard</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-user"></i><span>Jobs</span><span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a class="dropdown-item" href="{{url('/employer/jobs/insert')}}">Post
                                        Jobs</a></li>
                                <li><a class="dropdown-item" href="{{url('/employer/jobs')}}">Active
                                        Jobs</a></li>
                                <li><a class="dropdown-item" href="{{url('/employer/jobs/inactive')}}">Inactive
                                        Jobs</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('/employer/buy/credit')}}"><i class="bi bi-coin"></i><span>Purchase
                                    Credit</span></a>
                        </li>
                        <li>
                            <a href="{{url('/employer/order')}}"><i class="bi bi-cart-plus-fill"></i>
                                <span>Order</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-user"></i><span>Applications</span><span
                                    class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a class="dropdown-item" href="{{url('/employer/applications')}}">Applications</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{url('/employer/applications/shortlisted')}}">Shortlisted application</a>
                                </li>
                                <li><a class="dropdown-item" href="{{url('/employer/applications/rejected')}}">Rejected
                                        application</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{URL::asset('js/popper.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.slimscroll.js')}}"></script>
        <script src="{{URL::asset('js/Chart.bundle.js')}}"></script>
        <script src="{{URL::asset('js/app.js')}}"></script>
        <div class="page-wrapper">
            @section('content')

            @show
        </div>
    </div>
    @yield('scripts')
</body>

</html>