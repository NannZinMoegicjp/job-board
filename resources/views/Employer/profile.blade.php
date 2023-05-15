@extends('Employer.master_employer')
@section('content')
@if(isset($company))
<div class="container my-2">
    @if(session('status'))
    <div class="alert alert-success m-2">
        {{session('status')}}
    </div>
    @endif
    <div class="d-flex align-items-center mb-4">
        <img src="{{url('images/companies/'.$company['logo'])}}" alt="{{$company['company_name']}} logo"
            class="companyDetailsLogo me-2">
        <h3 class="text-center title py-2 me-2">{{$company["company_name"]}}</h3>
        <a href="{{url('/employer/profile/update/'.$company->id)}}">
            <button type="button" class="btn btn-primary">
                <i class="bi bi-pencil-fill update"></i>Update</button>
        </a>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="mb-3">
                <i class="bi bi-person-circle me-2"></i><span class="title">Contact Person </span> :
                <span class="text-secondary">
                    {{$company["contact_person"]}}
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-telephone me-2"></i><span class="title">Phone </span> :
                <span class="text-secondary">{{$company["phone"]}}
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-envelope-fill me-2"></i><span class="title">Email </span> :
                <span class="text-secondary">{{$company["email"]}}
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-clock me-2 clock"></i><span class="title">Member Since </span> :
                <span class="text-secondary">
                    {{$company["created_at"]->diffForHumans()}}
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-coin me-2"></i><span class="title">No of credit left</span> :
                <span class="text-secondary">{{$company["no_of_credit"]}}
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-send me-2"></i><span class="title">No of job posted </span> :
                <span class="text-secondary">{{$jobCount}}
                </span>
            </div>
        </div>
        <div class="col-md-7">
            <div class="mb-3">
                <i class="bi bi-bookmarks-fill me-2"></i><span class="title">Industry</span> :
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
            <div class="mb-3">
                <i class="bi bi-people-fill me-2"></i><span class="title">Total Employee </span> :
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
            <div class="mb-3">
                <i class="bi bi-geo-alt-fill me-2"></i><span class="title">Address </span> :
                <span class="text-secondary">
                    {{$mainBranch->detail_address}}, {{$mainBranch->city->name}}, {{$mainBranch->city->state->name}}
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-building-fill me-2"></i><span class="title">Other branches</span> : <span
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

            <div class="mb-3">
                <i class="bi bi-calendar2-week me-2"></i><span class="title">Established date</span> :
                <span class="text-secondary">
                    @php
                    $time_input = strtotime($company["established_date"]);
                    echo date('Y-m-d',$time_input)." ";
                    @endphp
                </span>
            </div>
            <div class="mb-3">
                <i class="bi bi-globe me-2"></i><span class="title">Website Link </span> : <span
                    class="text-secondary">{{$company["websitelink"]}}</span>
            </div>
        </div>
    </div>
    <div class="row g-2 py-4">
        @foreach($company->images as $image)
        <div class="col-lg-3 col-6">
            <img src="{{url('images/companies/'.$image['name'])}}" alt="" class="img-fluid">
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection