@extends('master')
@section('content')
<section class="bg-light">
    <h3 class="text-center pt-2">Top companies</h3>
    <div class="container my-3 py-2">
        @foreach($companies as $company)
        <a href="{{route('company-details',[$company->id])}}"><div class="row border-bottom company">
            <div class="col-2 d-flex justify-content-center align-items-center p-3 border-end">
                <img src="{{asset('images/companies/'.$company->logo)}}" alt="">
            </div>
            <div class="col-10 ps-lg-4">
                <h4 class="title">{{$company->company_name}}</h4>
                <div class="row ">
                    <div class="col-6">
                        <div>
                            <span class="title">Industry</span> : <span class="text-secondary">FMCG,
                                @foreach($company->industries as $industry)
                                @if ($loop->last)
                                {{$industry->name}}
                                @else
                                {{$industry->name}},
                                @endif
                                @endforeach</span>
                        </div>
                        <div>
                            <span class="title">Total Employee </span> : <span
                                class="text-secondary">{{$company["no_of_employee"]}}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            @php
                            $branches = [];
                            $mainBranch = null;
                            foreach ($company->addresses as $add){
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
                                    {{$mainBranch->detail_address}}, {{$mainBranch->city->name}},
                                    {{$mainBranch->city->state->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></a>
        @endforeach
    </div>
</section>
@endsection