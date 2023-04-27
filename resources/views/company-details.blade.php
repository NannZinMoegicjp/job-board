@extends('master')
@section('content')
<section class="bg-light pb-4">
    {{-- <h3 class="text-center title shadow py-2 mb-4">Company details</h3> --}}
    <h3 class="text-center title shadow py-2 mb-4">Unilever Myanmar</h3>

    <div class="container bg-white">        
        <div class="row g-2 border-bottom py-2">
            <div class="col-4 d-flex justify-content-center align-items-center p-3 border-end">
                <a href=""><img src="{{url('images/companies/unilever/o9SXyF4kPWv_4nhtaCnNLKCh5ySN9sCJBF3l61hQuN4ufYcLUH3OAaEy8yx2iqYWda1bgDijr4zHaHAKRlLLeA==.png')}}" alt="Ananda Digital Myanmar"></a>    
            </div>
            <div class="col-8 ps-lg-4">
                <div>
                    <div class="m-2">
                        <i class="bi bi-bookmarks-fill me-2 industry"></i><span class="fw-bold title">Industry</span> : <span class="text-secondary">FMCG, Manufacturing</span>
                    </div>
                    <div class="m-2">
                        <i class="bi bi-people-fill me-2 date"></i><span class="fw-bold title">Total Employee </span> : <span class="text-secondary">501-1000</span>
                    </div>                
                    <div class="m-2">
                        <i class="bi bi-clock-fill me-2 clock"></i><span class="fw-bold title">Member Since </span> : <span class="text-secondary">Apr 06, 2023</span>                    
                    </div>
                    <div class="m-2">
                        <i class="bi bi-geo-alt-fill me-2 location"></i><span class="fw-bold title">Address </span> : <span class="text-secondary">No.29, C-2, Corner of U Wisara Road and Dhamayone Street,Yangon, Myanmar</span>
                    </div>
                    <div class="m-2">
                        <i class="bi bi-calendar2-week me-2"></i><span class="fw-bold title">Established date</span> : <span class="text-secondary">Apr 06, 2003</span>                    
                    </div>
                    <div class="m-2">
                        <i class="bi bi-globe me-2"></i><span class="fw-bold title">Website Link </span> : <span class="text-secondary">https://www.food.com</span>
                    </div>
                </div>           
                
            </div>
        </div>  
        {{-- <div class="border-bottom py-2">
            <h4 class="title">About company</h4>
            <p class="text-secondary param">Unilever Myanmar Group of Companies (UEMCL, UMM, UMS) has been providing billions of people all over the world with home care, personal care, and food products. There are over 400 brands under Unilever and most of them are prominent household names. As a matter of fact, there is at least one Unilever product in seven out of ten households.</p>
        </div>       --}}
        <div class="row g-2 border-bottom py-4">
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/unileverPhoto1.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/unileverPhoto2.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/unileverPhoto3.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/unileverPhoto4.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/o9SXyF4kPWv_4nhtaCnNLFzJNdQIkNckrkyRDdRhX2fzIA8FaiXepI6xROOtKeUPMRQdZVE9WgNvGHr-XtQ9uxtfy6BplOteFaoSSfuLCAeesiZ1BCBQgQ==.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/o9SXyF4kPWv_4nhtaCnNLFzJNdQIkNckrkyRDdRhX2fQHELFM8J0vv14Gaqyb4duZCAunjKo_6JcG8j-v-9lQHoBIlV8CdgG8GUbp_bEIys2fjRYPQQa3A==.jfif')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/unilever/o9SXyF4kPWv_4nhtaCnNLFzJNdQIkNckrkyRDdRhX2fCsJ7G7fPuEGLe8TjmToxQz9u3ETGkQ6_OR3a7y5tZyErAdMOP1HVlizIL7s7kvJvWIqo1u5hcx_W-9f6-UWGXv.png')}}" alt="" class="img-fluid">
            </div>
        </div>
        <div class="mydiv">
            <h4 class="mb-4 title">All job openings</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Positions</th>
                        <th>Posts</th>
                        <th>Max Salary</th>
                        <th>Job Location</th>
                        <th>Last Posted</th>
                        <th class="text-center"><a href="" class="text-decoration-none title">View all</a></th>
                    </tr>
                    <tr class="align-middle">
                        <td><a href="" class="text-decoration-none title"><h6>Procurement Manager - Logistic/RPM</h6></a></td>
                        <td>3</td>
                        <td>Negotiable</td>
                        <td>Yangon</td>
                        <td>15 Mar 2023</td>
                        <td  class="text-center"><a href="" class="text-decoration-none position"><button class="btn greenBtn"><span class="fw-bold">view job</span></button></a></td>
                    </tr>                    
                </table>
            </div>            
        </div>
    </div>    
</section>
@endsection