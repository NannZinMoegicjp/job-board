@extends('master_admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }} <br>
            @endforeach
        </div>
        @endif
    </div>
    <div class="row text-end my-2">
        <a href="{{url('/admin/companies')}}">companies list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-1">
        <div class="col-md-8 offset-md-2 col-12">
            @if(isset($updateId))
            <form action="{{url('/admin/company/update/'.$updateId)}}" class="bg-white px-3 pb-2 rounded shadow"
                method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Update Company</h4>
                </div>
                <div class="row my-2">
                    <div class="col-md-10 offset-md-1 col-12">
                        <h6>Account information</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="contactPerson">Contact Person</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="contactPerson" id="contactPerson"
                            value="{{$company['contact_person']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" min="0" placeholder="Phone, eg. 09454096528" id="phone"
                            name="phone" value="{{$company['phone']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 offset-md-2 col-12">

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
                    <div class="col-md-7 col-12"> <input type="text" class="form-control" id="comName" name="comName"
                            value="{{$company['company_name']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="estDate">Established date</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="estDate"
                            name="estDate" value="{{$company['established_date']}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="websiteLink">Website link</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" name="websiteLink" id="websiteLink"
                            placeholder="https://studyrightnow-mdy.com" value="{{$company['websitelink']}}">
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
                        <label for="state">Division/state</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="state" id="state" class="form-select" placeholder="Your division/state">
                            @if(isset($states))
                            @foreach ($states as $state)
                            @if ($state['name']==$company->city->state->name)
                            <option value="{{$state['id']}}" selected>{{$state['name']}}</option>
                            @else
                            <option value="{{$state['id']}}">{{$state['name']}}</option>
                            @endif
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
                            @if ($city['name']==$company->city->name)
                            <option value="{{$city['id']}}" selected>{{$city['name']}}</option>
                            @else
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                            @endif
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
                        <textarea class="form-control address" placeholder="Enter details address" id="address"
                            name="address">{{$company['address']}}</textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="industry">Main Industry</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="industry[]" id="industry" class="form-select" multiple>
                            @if(isset($industries))
                            @php
                            $industriesNames = [];
                            @endphp
                            @foreach($company->industries as $industry)
                            @php
                            array_push($industriesNames,$industry['name']);
                            @endphp
                            @endforeach
                            @foreach ($industries as $industry)
                            @if(in_array($industry['name'],$industriesNames))
                            <option value="{{$industry['id']}}" selected>{{$industry['name']}}</option>
                            @else
                            <option value="{{$industry['id']}}">{{$industry['name']}}</option>
                            @endif
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
                            <option value="1-5" {{$company->no_of_employee == "1-5" ? 'selected' : ''}}>1-5</option>
                            <option value="6-10" {{$company->no_of_employee == "6-10" ? 'selected' : ''}}>6-10</option>
                            <option value="11-20" {{$company->no_of_employee == "11-20" ? 'selected' : ''}}>11-20
                            </option>
                            <option value="21-50" {{$company->no_of_employee == "21-50" ? 'selected' : ''}}>21-50
                            </option>
                            <option value="51-100" {{$company->no_of_employee == "51-100" ? 'selected' : ''}}>51-100
                            </option>
                            <option value="101-200" {{$company->no_of_employee == "101-200" ? 'selected' : ''}}>101-200
                            </option>
                            <option value="201-500" {{$company->no_of_employee == "201-500" ? 'selected' : ''}}>201-500
                            </option>
                            <option value="501-1000" {{$company->no_of_employee == "501-1000" ? 'selected' :
                                ''}}>501-1000</option>
                            <option value="1001-5000" {{$company->no_of_employee == "1001-5000" ? 'selected' :
                                ''}}>1001-5000</option>
                            <option value="5000-10000" {{$company->no_of_employee == "5001-10000" ? 'selected' :
                                ''}}>5000-10000</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="submit" class="form-control registerBtn btn" value="Update">
                    </div>
                </div>
            </form>
            @else
            <form action="{{url('/admin/company/add')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Add Company</h4>
                </div>
                <div class="row my-2">
                    <div class="col-md-10 offset-md-1 col-12">
                        <h6>Account information</h6>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="contactPerson">Contact Person</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="contactPerson" id="contactPerson"
                            value="{{ old('contactPerson') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="userEmail">Email</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="email" class="form-control" required name="userEmail" id="userEmail"
                            value="{{ old('userEmail') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" min="0" required placeholder="eg. 09454096528"
                            id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>
                {{-- <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control" required placeholder="Password" name="password"
                            id="password" value="{{old('password')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="conPass">Confirm Password</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="password" class="form-control" required placeholder="Confirm password"
                            name="conPass" id="conPass" value="{{old('conPass')}}">
                    </div>
                </div> --}}
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
                            name="comName" value="{{old('comName')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="estDate">Established date</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="estDate"
                            name="estDate" value="{{old('estDate')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="websiteLink">Website link</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" name="websiteLink" id="websiteLink"
                            placeholder="https://studyrightnow-mdy.com" value="{{old('websiteLink')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="logofile" class="form-label">Company Logo</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="Logo" name="logofile" id="logofile"
                            value="{{old('logofile')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="images" class="form-label">Company Photos</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="images" name="images[]" id="images"
                            multiple value="{{old('images')}}">
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
                            name="address">{{old('address')}}</textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="industry">Main Industry</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="industry[]" id="industry" class="form-select" multiple>
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
                        <input type="submit" class="form-control registerBtn btn" required value="Add">
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
            $('#state').on('change', function () {
                var stateId = this.value;
                $("#city").html('');
                $.ajax({
                    url: "{{url('/api/fetch/cities')}}",
                    type: "POST",
                    data: {
                        state_id: stateId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#city').html('<option value="">-- Select city --</option>');
                        $.each(result.cities, function (key, value) {
                            $("#city").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });}) --}}
            @endsection