@extends('Employer.master_employer')
@section('content')
<div class="container-fluid">
    <div class="row my-3">
        <div class="col-md-7 col-12 mb-1">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{url('/employer/profile/update/'.$company->id)}}" class="bg-white px-3 pb-2 rounded shadow"
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
                        <label for="contactPerson">Contact Person</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control @error('contactPerson') is-invalid @enderror"
                            name="contactPerson" id="contactPerson"
                            value="{{old('contactPerson',$company['contact_person'])}}">
                        @error('contactPerson')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="phone">Phone</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" min="0"
                            placeholder="Phone, eg. 09454096528" id="phone" name="phone"
                            value="{{old('phone',$company['phone'])}}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                        <label for="comName">Company name</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control @error('comName') is-invalid @enderror" id="comName"
                            name="comName" value="{{old('comName',$company['company_name'])}}">
                        @error('comName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="estDate">Established date</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="estDate"
                            name="estDate" value="{{old('estDate',$company['established_date'])}}"
                            max="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="websiteLink">Website link</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control @error('websiteLink') is-invalid @enderror"
                            name="websiteLink" id="websiteLink" placeholder="https://studyrightnow-mdy.com"
                            value="{{old('websiteLink',$company['websitelink'])}}">
                        @error('websiteLink')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @php
                $address = null;
                @endphp
                @foreach ($company->addresses as $addr)
                @if ($addr->detail_address != null)
                @php
                $address = $addr;
                @endphp
                @endif
                @endforeach
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="state">Division/state</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="state" id="state" class="form-select" placeholder="Your division/state">
                            @if(isset($states))
                            @foreach ($states as $state)
                            @if($state['name'] == $address->city->state->name)
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
                        <label for="city">City</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="city" id="city" class="form-select">
                            @if(isset($cities))
                            @foreach ($cities as $city)
                            @if($city['name'] == $address->city->name)
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
                        <label for="address">Address</label><span class="text-danger"> *</span>
                    </div>
                    <div class="col-md-7 col-12">
                        <textarea class="form-control address @error('address') is-invalid @enderror"
                            placeholder="Enter details address" id="address"
                            name="address">{{old('address',$address->detail_address)}}</textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="size">Number of employee</label><span class="text-danger"> *</span>
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
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/employer/profile')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5 col-12">
            <div class="row bg-white mb-3 d-flex justify-content-center shadow px-2 py-4">
                <div class="col-4">
                    <img src="{{URL::asset('images/companies/'.$company->logo)}}" alt="" class="img img-fluid">
                </div>
                <div class="col-8">
                    <form action="{{url('/employer/profile/update/logo/'.$updateId)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="newlogofile" class="col-form-label">New Logo</label><span class="text-danger"> *</span>
                        <input type="file" class="form-control mb-2 @error('newlogofile') is-invalid @enderror"
                            placeholder="Logo" name="newlogofile" id="newlogofile" value="{{old('newlogofile')}}"
                            accept=".jpeg,.jpg,.svg,.gif,.png,.tiff,.jfif,.bmp,.webp">
                        @error('newlogofile')
                        <span class="invalid-feedback mb-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input type="submit" class="btn btn-primary" value="upload new logo">
                    </form>
                </div>
            </div>
            <div class="row bg-white mb-3 shadow px-2 py-4">
                <div class="col-4">
                    <h6>Industry</h6>
                </div>
                <div class="col-8">
                    @foreach ($company->industries as $industry)
                    @if(count($company->industries)>1)
                    <div class="mb-2 d-flex">
                        {{$industry->name}} <a
                            href="{{url('/employer/profile/delete/industry/'.$company->id.'/'.$industry->id)}}"><i
                                class="bi bi-trash ms-2 text-warning"></i></a>
                    </div>
                    @else
                    <div class="mb-2 d-flex">
                        {{$industry->name}}
                    </div>
                    @endif
                    @endforeach
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addIndustry">
                        <i class="bi bi-plus"></i> Add more
                    </button>
                </div>
            </div>
            <div class="row bg-white mb-3 shadow px-2 py-4">
                <div class="col-4">
                    <h6>Branch city</h6>
                </div>
                <div class="col-8">
                    @foreach ($company->addresses as $address)
                    @if ($address->detail_address == null)
                    <div class="mb-2 d-flex">
                        {{$address->city->name}},{{$address->city->state->name}}
                        <a href="{{url('/employer/profile/delete/branch/'.$company->id.'/'.$address->id)}}"><i
                                class="bi bi-trash ms-2 text-warning"></i></a>
                    </div>
                    @endif
                    @endforeach
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addBranchCity">
                        <i class="bi bi-plus"></i> Add more
                    </button>
                </div>
            </div>
            <div class="modal fade" id="addIndustry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>Add industry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/employer/profile/add/industry/'.$company->id)}}" method="post"
                                enctype="multipart/form-data" id="branchForm">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label">
                                        <label for="industry">Industry</label><span class="text-danger"> *</span>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="industry" id="industry" class="form-select"
                                            placeholder="Branch division/state" required>
                                            <option value="">--choose industry--</option>
                                            @if(isset($industries))
                                            @foreach ($industries as $industry)
                                            <option value="{{$industry['id']}}">{{$industry['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="submit" value="add industry" class="btn btn-primary me-1">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addBranchCity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>Add branch city</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/employer/profile/add/branch/'.$company->id)}}" method="post"
                                enctype="multipart/form-data" id="branchForm">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label">
                                        <label for="bstate">Branch State</label><span class="text-danger"> *</span>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="bstate" id="bstate" class="form-select"
                                            placeholder="Branch division/state" required>
                                            <option value="">-- Select branch state --</option>
                                            @if(isset($states))
                                            @foreach ($states as $state)
                                            <option value="{{$state['id']}}">{{$state['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label">
                                        <label for="bcity">Branch City</label><span class="text-danger"> *</span>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="bcity" id="bcity" class="form-select" required>
                                            <option value="">-- Select branch city --</option>
                                            @if(isset($cities))
                                            @foreach ($cities as $city)
                                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="submit" value="add branch city" class="btn btn-primary me-1">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-4">
            @foreach($company->images as $image)
            <div class="col-lg-3 col-6 photoContainer mb-4" onmouseover="showDeleteIcon(this);"
                onmouseout="hideDeleteIcon(this);">
                <img src="{{url('images/companies/'.$image['name'])}}" alt="" class="img img-fluid">
                <a href="{{url('/employer/profile/remove/images/'.$company->id.'/'.$image->id)}}" class="d-none"><i
                        class="bi bi-x-lg deleteIcon"></i></a>
            </div>
            @endforeach
        </div>
        <form action="{{url('/employer/profile/add/images/'.$updateId)}}" method="post" enctype="multipart/form-data"
            class="mb-5">
            @csrf
            <div class="row">
                <div class="col-md-2 text-md-end">
                    <label for="newPhotos" class="col-form-label">New images</label><span class="text-danger"> *</span>
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control mb-1 @error('newPhotos') is-invalid @enderror" placeholder=""
                        name="newPhotos[]" id="newPhotos" multiple
                        accept=".jpeg,.jpg,.svg,.gif,.png,.tiff,.jfif,.bmp,.webp">
                    @error('newPhotos')
                    <span class="invalid-feedback mb-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="submit" class="btn btn-primary" value="upload new photos">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    let showDeleteIcon = (photo) => {
    photo.children[1].classList.remove('d-none');
    photo.children[1].classList.add('d-inline');
}
let hideDeleteIcon = (photo) => {
    photo.children[1].classList.remove('d-inline');
    photo.children[1].classList.add('d-none');
}
</script>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
    $('#state').on('change', function () {
                    var stateId = this.value;
                    $("#city").html('<option value="">-- Select city --</option>');
                    $.ajax({
                        url: "/api/fetch-cities/" + stateId,
                        type: "GET",
                        dataType: 'json',
                        success: function(result) {
                            $.each(result, function (key, value) {
                                $("#city").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
            },
         });
    });
});
$(document).ready(function () {
    $('#bstate').on('change', function () {
                    var stateId = this.value;
                    $("#bcity").html('<option value="">-- Select branch city --</option>');
                    $.ajax({
                        url: "/api/fetch-cities/" + stateId,
                        type: "GET",
                        dataType: 'json',
                        success: function(result) {
                            $.each(result, function (key, value) {
                                $("#bcity").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
            },
         });
    });
});
</script>
@endsection