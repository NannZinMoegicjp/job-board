@extends('master')
@section('content')
<section class="bg-light pb-4">
    <h3 class="text-center title shadow py-2 mb">Job details</h3>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-9">
                <div class="row p-3 mx-3">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href=""><img src="{{url('images/companies/anandalogo.png')}}" alt="Ananda Digital Myanmar"></a>    
                    </div>
                    <div class="col-9">
                        <a href="" class="text-decoration-none text-dark"><h4 class="title fw">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title fw">Ananda Co., ltd</h5></a>
                        <div class="row my-1">
                            <div class="col-lg-3 col-6"><i class="bi bi-clock-fill clock"></i> Full Time</div>
                            <div class="col-lg-3 col-6"><i class="bi bi-geo-alt-fill location"></i> Yangon</div>
                            <div class="col-lg-3 col-6"><i class="bi bi-calendar-check-fill date"></i> 07 Apr 2023</div>
                            <div class="col-lg-3 col-6"><i class="bi bi-currency-dollar money"></i>500000</div>
                        </div>                        
                        <span>Career level :</span> <span class="text-secondary"> Management level</span> <br>
                        <span>Functional Area : </span> <span class="text-secondary">Business Development & Management</span><br>                
                    </div>
                </div>              
            </div>
            <div class="col-md-3">
                <div class="m-md-2 m-3 p-3 apply">
                    <h5 class="title">APPLY FOR HERE</h5>
                    <hr>
                    <input type="submit" class="border form-control greenBtn btn" value="Apply">
                </div>
            </div>
        </div>
        <div class="p-3">
            <div>
                <h5 class="bg-light p-2 title">Job Description</h5>
                <ul class="list">
                    <li>Responsible for protect implementation & day by day operation of site work.</li>
                    <li>Responsible for protect implementation & day by day operation of site work.</li>
                    <li>Responsible for protect implementation & day by day operation of site work.</li>
                    <li>Responsible for protect implementation & day by day operation of site work.</li>
                    <li>Responsible for protect implementation & day by day operation of site work.</li>
                </ul>
            </div>
            <div>
                <h5 class="bg-light p-2 title">Job Requirements</h5>
                <ul>
                    <li>Above 2 years’ experiences in site engineer and preferable to M&E engineer and ACMV.</li>
                    <li>Above 2 years’ experiences in site engineer and preferable to M&E engineer and ACMV.</li>
                    <li>Above 2 years’ experiences in site engineer and preferable to M&E engineer and ACMV.</li>
                    <li>Above 2 years’ experiences in site engineer and preferable to M&E engineer and ACMV.</li>
                    <li>Above 2 years’ experiences in site engineer and preferable to M&E engineer and ACMV.</li>
                </ul>
            </div>
            <div>
                <h5 class="bg-light p-2 title">OpenTo</h5>
                <i class="bi bi-check-circle-fill ps-2 gender"></i> <span class="text-secondary">Male</span>
            </div>
            <div>
                <h5 class="bg-light p-2 title">Company Overview</h5>
                <div class="row comOverview">
                    <div class="col-md-3 col-6"><p><i class="bi bi-building ps-2"></i> Ananda Myanamar Co., ltd</p></div>
                    <div class="col-md-3 col-6"><p><i class="bi bi-people-fill"></i> 201-500 employee</p></div>
                    <div class="col-md-3 col-6">
                        <p><i class="bi bi-card-checklist ps-2"></i> 
                        <a href="" class="text-decoration-none companyJobsLink text-dark">13 current jobs openings</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-6"><p><i class="bi bi-geo-alt-fill ps-2"></i> Yangon</p></div>
                </div>              
            </div>
        </div>
    </div>    
</section>
@endsection