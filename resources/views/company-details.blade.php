@extends('master')
@section('content')
<section class="bg-light py-4">
    @if(isset($data['company']))
    <div class="container bg-white my-4">
        <div class="d-flex align-items-center mb-4">
            <img src="{{url('images/companies/'.$data['company']['logo'])}}"
                alt="{{$data['company']['company_name']}} logo" class="companyDetailsLogo me-2">
            <h3 class="text-center title py-2 me-2">{{$data['company']["company_name"]}}</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2">
                    <i class="bi bi-bookmarks-fill me-2 industry"></i><span class="title">Industry</span> :
                    <span class="text-secondary">
                        @foreach($data['company']->industries as $industry)
                        @if ($loop->last)
                        {{$industry->name}}
                        @else
                        {{$industry->name}},
                        @endif
                        @endforeach
                    </span>
                </div>
                <div class="mb-2">
                    <i class="bi bi-people-fill me-2 date"></i><span class="title">Total Employee </span> :
                    <span class="text-secondary">{{$data['company']["no_of_employee"]}}</span>
                </div>
                @php
                $branches = [];
                $mainBranch = null;
                foreach ($data['company']->addresses as $add){
                if ($add->detail_address != null)
                {
                $mainBranch = $add;
                }
                else {
                array_push($branches,$add);
                }}
                @endphp
                <div class="mb-2">
                    <i class="bi bi-geo-alt-fill me-2 location"></i><span class="title">Address </span> :
                    <span class="text-secondary">
                        {{$mainBranch->detail_address}}, {{$mainBranch->city->name}}, {{$mainBranch->city->state->name}}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <i class="bi bi-clock me-2 clock"></i><span class="title">Member Since </span> :
                    <span class="text-secondary">
                        {{$data['company']["created_at"]->diffForHumans()}}
                    </span>
                </div>

                <div class="mb-2">
                    <i class="bi bi-building-fill me-2"></i><span class="title">Branches</span> : <span
                        class="text-secondary">
                        @foreach ($branches as $add)
                        @if ($loop->last)
                        {{$add->city->name}}, {{$add->city->state->name}}
                        @else
                        {{$add->city->name}}, {{$add->city->state->name}}/
                        @endif
                        <span></span>
                        @endforeach</span>
                </div>
                <div class="mb-2">
                    <i class="bi bi-calendar2-week me-2"></i><span class="title">Established date</span> :
                    <span class="text-secondary">
                        @php
                        $time_input = strtotime($data['company']["established_date"]);
                        echo date('Y-m-d',$time_input)." ";
                        @endphp
                    </span>
                </div>
                <div class="mb-2">
                    <i class="bi bi-globe me-2"></i><span class="title">Website Link </span> : <span
                        class="text-secondary">{{$data['company']["websitelink"]}}</span>
                </div>
            </div>
        </div>
        <div class="row g-2 py-4">
            @foreach($data['company']->images as $image)
            <div class="col-lg-3 col-6">
                <img src="{{url('images/companies/'.$image['name'])}}" alt="" class="img-fluid">
            </div>
            @endforeach
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
                        <th></th>
                        <!-- <th class="text-center"><a href="" class="text-decoration-none title">View all</a></th> -->
                    </tr>
                    @foreach($data['jobs'] as $job)
                    <tr class="align-middle">
                        <td><h6>{{$job->title}}</h6></td>
                        <td>{{$job->open_position}}</td>
                        <td>{{$job->max_salary}}</td>
                        <td>{{$job->address->city->state->name}}</td>
                        <td>{{$job->created_at}}</td>
                        <td class="text-center"><a href="{{url('/jobs/details/'.$job->id)}}" class="text-decoration-none position"><button
                                    class="btn greenBtn"><span class="fw-bold">view job</span></button></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>    
    @endif
</section>
@endsection