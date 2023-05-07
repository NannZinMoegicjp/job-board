@extends('welcome')
@section('content')
<div class="container-fluid ">
    <div class="row text-end">
        <a href="{{url('/admin/companies')}}">companies list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-1">
        <div class="col-md-8 offset-md-2 col-12">
            <form action="{{url('/admin/company/add')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Sign up for employer</h4>
                </div>
                <div class="row my-2">
                    <div class="col-md-8 offset-md-2 col-12">
                        <h6>Account information</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 col-12">
                        <input type="text" class="form-control" required placeholder="Contact Person"
                            name="contactPerson" id="contactPerson">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 col-12">
                        <input type="email" class="form-control" required placeholder="Email" name="userEmail"
                            id="userEmail">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 col-12">
                        <input type="text" class="form-control" min="0" required placeholder="Phone, eg. 09454096528"
                            id="phone" name="phone">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 col-12">
                        <input type="password" class="form-control" required placeholder="Password" name="password"
                            id="password">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 col-12">
                        <input type="password" class="form-control" required placeholder="Confirm password"
                            name="conPass" id="conPass">
                    </div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-10 offset-md-1 col-12  col-form-label">
                        <h6>Company information</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="comName">Company name</label>
                    </div>
                    <div class="col-md-7 col-12"> <input type="text" class="form-control" required id="comName"
                            name="comName">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="estDate">Established date</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" required placeholder="eastablished date" id="estDate"
                            name="estDate">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="websiteLink">Website link</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" name="websiteLink" id="websiteLink"
                            placeholder="https://studyrightnow-mdy.com">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="logofile" class="form-label">Company Logo</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="Logo" name="logofile" id="logofile">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="images" class="form-label">Company Photos</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="images" name="images[]" id="images"
                            multiple>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="state">Division/state</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="state" id="state" class="form-select" placeholder="Your division/state">
                            @if(isset($states))
                            @foreach ($states as $state)
                            <option value="{{$state['id']}}">{{$state['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="city">City</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="city" id="city" class="form-select">
                            @if(isset($cities))
                            @foreach ($cities as $city)
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <textarea class="form-control address" placeholder="Enter details address" required id="address"
                            name="address"></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="cities">Branch cities</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="cities[]" id="cities" class="form-select">
                            @if(isset($cities))
                            @foreach ($cities as $city)
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="industry">Main Industry</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="industry[]" id="industry" class="form-select">
                            @if(isset($industries))
                            @foreach ($industries as $industry)
                            <option value="{{$industry['id']}}">{{$industry['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="size">Number of employee</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="size" id="size" class="form-select">
                            <option value="1-5">1-5</option>
                            <option value="6-10">6-10</option>
                            <option value="11-20">11-20</option>
                            <option value="21-50">21-50</option>
                            <option value="51-100">51-100</option>
                            <option value="101-200">101-200</option>
                            <option value="201-500">201-500</option>
                            <option value="501-1000">501-1000</option>
                            <option value="1001-5000">1001-5000</option>
                            <option value="5000-10000">5000-10000</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="submit" class="form-control registerBtn btn" required value="Register">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection