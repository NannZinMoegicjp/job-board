@extends('master')
@section('content')
<section>
    {{-- <h3 class="text-center title shadow py-2 mb">Job Listing</h3> --}}
<div class="container rounded-1 py-2">
    <form action="" method="post" class="my-2 p-2">
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
                <input type="submit" class="border form-control greenBtn btn" value="Find jobs">
            </div>
        </div>
    </form>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-12 ">            
            <div class="mb-4 p-2">  
                <form action="">
                    <div class="fw">
                        Filter By :
                    </div>                    
                    @csrf
                    <label for="postedDate" class="fw">Freshness</label>
                    <select class="form-select mb-2" id="postedDate" name="postedDate">
                        <option selected>Any days</option>
                        <option value="1">Today</option>
                        <option value="2">Last 7 days</option>
                        <option value="3">Last 14 days</option>
                        <option value="4">Last 30 days</option>
                    </select>
                    <label for="industry" class="fw">Industry</label>
                    <select class="form-select mb-2" id="industry" name="industry">
                        <option selected>Any industries</option>
                        <option value="1">Education/Training</option>
                        <option value="2">IT/Computer</option>
                        <option value="3">Banking</option>
                        <option value="4">Food and Beverage</option>
                    </select>
                    <label for="company" class="fw">Company</label>
                    <select class="form-select mb-2" id="company" name="company">
                        <option selected>Any Companies</option>
                        <option value="1">Ananda Myanmar</option>
                        <option value="2">Coca cola</option>
                        <option value="3">Yoma bank</option>
                        <option value="4">Grand royal</option>
                    </select>
                    <label for="expLevel" class="fw">Experience Level</label>
                    <select class="form-select mb-2" id="expLevel" name="expLevel">
                        <option selected>Any Level</option>
                        <option value="1">Entry</option>
                        <option value="2">Senior Level</option>
                        <option value="3">Manager Level</option>
                        <option value="4">Director and above</option>
                    </select>
                    <div>
                        <input class="btn orangeBtn" type="reset" value="Clear all">
                        <input type="submit" class="greenBtn btn" value="Filter">
                    </div>
                </form>                                  
            </div>
        </div>
        <div class="col-lg-9 col-12">
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="images/companies/anandalogo.png" alt="Ananda Digital Myanmar"></a>    
                </div>
                <div class="col-9">
                    <a href="{{url('/job/details/1')}}" class="text-decoration-none text-dark"><h4 class="jobLink title">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title">Ananda Co., ltd</h5></a>
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
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="images/companies/anandalogo.png" alt="Ananda Digital Myanmar"></a>    
                </div>
                <div class="col-9">
                    <a href="{{url('/jobs/jobdetails/1')}}" class="text-decoration-none text-dark"><h4 class="jobLink title">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title">Ananda Co., ltd</h5></a>
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
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="images/companies/anandalogo.png" alt="Ananda Digital Myanmar"></a>    
                </div>
                <div class="col-9">
                    <a href="{{url('/jobs/jobdetails/1')}}" class="text-decoration-none text-dark"><h4 class="jobLink title">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title">Ananda Co., ltd</h5></a>
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
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="images/companies/anandalogo.png" alt="Ananda Digital Myanmar"></a>    
                </div>
                <div class="col-9">
                    <a href="{{url('/jobs/jobdetails/1')}}" class="text-decoration-none text-dark"><h4 class="jobLink title">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title">Ananda Co., ltd</h5></a>
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
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="images/companies/anandalogo.png" alt="Ananda Digital Myanmar"></a>    
                </div>
                <div class="col-9">
                    <a href="{{url('/jobs/jobdetails/1')}}" class="text-decoration-none text-dark"><h4 class="jobLink title">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title">Ananda Co., ltd</h5></a>
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
            <div class="row border rounded p-3 mx-3 my-2 jobpost">
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a href=""><img src="images/companies/anandalogo.png" alt="Ananda Digital Myanmar"></a>    
                </div>
                <div class="col-9">
                    <a href="{{url('/jobs/jobdetails/1')}}" class="text-decoration-none text-dark"><h4 class="jobLink title">Business Lecture</h4></a>
                        <a href="" class="text-decoration-none text-dark"><h5 class="companyLink title">Ananda Co., ltd</h5></a>
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
            <div class="pagination">
                <button class="btn-nav left-btn">
                    <i class="bi bi-arrow-left-short"></i>
                </button>
                <div class="page-numbers">
                    <button class="btn-page btn-selected">1</button>
                    <button class="btn-page">2</button>
                    <button class="btn-page">3</button>
                    <button class="btn-page">4</button>
                    <button class="btn-page">5</button>
                    <button class="btn-page">6</button>
                </div>
                <button class="btn-nav right-btn">
                    <i class="bi bi-arrow-right-short"></i>
                </button>
            </div>
        </div>
    </div>
</div>
</section>
@endsection