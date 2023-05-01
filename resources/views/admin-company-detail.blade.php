@extends('master_admin')
@section('content')
<section>
    <div class="row text-end my-2">
        <a href="{{url('/admin/companies')}}">companies list<i class="bi bi-arrow-right"></i></a>
    </div>
    @if(isset($company))
    <div class="container bg-white">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{url('images/companies/'.$company['logo'])}}" alt="{{$company['company_name']}} logo"
                class="companyDetailsLogo">
            <h3 class="text-center title py-2">{{$company["company_name"]}}</h3>
        </div>
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="m-1">
                    <i class="bi bi-person-circle me-2"></i><span class="title">Contact Person </span> :
                    <span class="text-secondary">
                        {{$company["contact_person"]}}
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-telephone me-2"></i><span class="title">Phone </span> :
                    <span class="text-secondary">{{$company["phone"]}}
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-envelope-fill me-2"></i><span class="title">Email </span> :
                    <span class="text-secondary">{{$company["email"]}}
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-clock me-2 clock"></i><span class="title">Member Since </span> :
                    <span class="text-secondary">
                        {{$company["created_at"]->diffForHumans()}}
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-coin me-2"></i><span class="title">No of credit </span> :
                    <span class="text-secondary">{{$company["no_of_credit"]}}
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-send me-2"></i><span class="title">No of job posted </span> :
                    <span class="text-secondary">
                    </span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="m-1">
                    <i class="bi bi-bookmarks-fill me-2 industry"></i><span class="title">Industry</span> :
                    <span class="text-secondary">
                        @foreach($company->industries as $industry)
                        @if ($loop->last)
                        {{$industry->name}}
                        @else
                        {{$industry->name}},
                        @endif
                        @endforeach
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-people-fill me-2 date"></i><span class="title">Total Employee </span> :
                    <span class="text-secondary">{{$company["no_of_employee"]}}</span>
                </div>
                @php
                $branches = [];
                $mainBranch = null;
                foreach ($addresses as $add){
                if ($add->detail_address != null)
                {
                    $mainBranch = $add;
                }
                else {
                    array_push($branches,$add);
                }}
                @endphp
                <div class="m-1">
                    <i class="bi bi-geo-alt-fill me-2 location"></i><span class="title">Address </span> :
                    <span class="text-secondary">
                        {{$mainBranch->detail_address}}, {{$mainBranch->city->name}}, {{$mainBranch->city->state->name}}
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-building-fill"></i><span class="title">Other branches</span> : <span
                        class="text-secondary">
                        @foreach ($branches as $add)                        
                        <div>{{$add->city->name}}, {{$add->city->state->name}}</div>
                        @endforeach</span>
                </div>

                <div class="m-1">
                    <i class="bi bi-calendar2-week me-2"></i><span class="title">Established date</span> :
                    <span class="text-secondary">
                        @php
                        $time_input = strtotime($company["established_date"]);
                        echo date('Y-m-d',$time_input)." ";
                        @endphp
                    </span>
                </div>
                <div class="m-1">
                    <i class="bi bi-globe me-2"></i><span class="title">Website Link </span> : <span
                        class="text-secondary">{{$company["websitelink"]}}</span>
                </div>
            </div>
        </div>
        <div class="row g-2 border-bottom py-4">
            @foreach($company->images as $image)
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/'.$image['name'])}}" alt="" class="img-fluid">
            </div>
            @endforeach
        </div>
        <!-- <div class="mydiv">
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
                        <td><a href="" class="text-decoration-none title">
                                <h6>Procurement Manager - Logistic/RPM</h6>
                            </a></td>
                        <td>3</td>
                        <td>Negotiable</td>
                        <td>Yangon</td>
                        <td>15 Mar 2023</td>
                        <td class="text-center"><a href="" class="text-decoration-none position"><button
                                    class="btn btn-success"><span class="fw-bold">view job</span></button></a></td>
                    </tr>
                </table>
            </div>
        </div> -->
    </div>
    @endif
</section>
@endsection