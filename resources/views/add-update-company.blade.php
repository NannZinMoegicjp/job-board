@extends('master_admin')
@section('content')
<div class="container-fluid">
    <div class="row my-2">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
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
    <div class="row my-3">
        @if(isset($updateId))
        <div class="col-md-7 col-12 mb-1">
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
                        <label for="state">Division/state</label>
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
                        <label for="city">City</label>
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
                        <label for="address">Address</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <textarea class="form-control address" placeholder="Enter details address" required id="address"
                            name="address">{{$address->detail_address}}</textarea>
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
                    <div class="col-md-7 col-12 d-flex">
                        <input type="submit" class="btn-primary btn me-2" value="Update">
                        <a href="{{url('/admin/companies')}}"><input type="button" class="btn-secondary btn"
                                value="Cancel"></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5 col-12">
            <div class="row mb-3 d-flex justify-content-center shadow p-2">
                <div class="col-4">
                    <img src="{{URL::asset('images/companies/'.$company->logo)}}" alt="" class="img img-fluid">
                </div>
                <div class="col-8">
                    <form action="{{url('/admin/company/update/logo/'.$updateId)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control mb-2" placeholder="Logo" name="newlogofile"
                            id="newlogofile" value="{{old('logofile')}}" required>
                        <input type="submit" class="btn btn-outline-primary" value="upload new logo">
                    </form>
                </div>
            </div>
            <div class="row mb-3 shadow p-2">
                <div class="col-4">
                    <h6>Industry</h6>
                </div>
                <div class="col-8">
                    @foreach ($company->industries as $industry)
                    <div class="mb-2 d-flex">
                        {{$industry->name}} <a
                            href="{{url('/admin/company/delete/industry/'.$company->id.'/'.$industry->id)}}"><i
                                class="bi bi-trash ms-2 text-warning"></i></a>
                    </div>
                    @endforeach
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#addIndustry">
                        <i class="bi bi-plus"></i> Add more
                    </button>
                </div>
            </div>
            <div class="row mb-3 shadow p-2">
                <div class="col-4">
                    <h6>Branch city</h6>
                </div>
                <div class="col-8">
                    @foreach ($company->addresses as $address)
                    @if ($address->detail_address == null)
                    <div class="mb-2 d-flex">
                        {{$address->city->name}},{{$address->city->state->name}}
                        <a href="{{url('/admin/company/delete/branch/'.$company->id.'/'.$address->id)}}"><i
                                class="bi bi-trash ms-2 text-warning"></i></a>
                    </div>
                    @endif
                    @endforeach
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#addBranchCity" onclick="add(this);">
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
                            <form action="{{url('/admin/company/add/industry/'.$company->id)}}" method="post"
                                enctype="multipart/form-data" id="branchForm">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label">
                                        <label for="industry">Industry</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="industry" id="industry" class="form-select"
                                            placeholder="Branch division/state">
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
                            <form action="{{url('/admin/company/add/branch/'.$company->id)}}" method="post"
                                enctype="multipart/form-data" id="branchForm">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-4 col-form-label">
                                        <label for="bState">Branch State</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="bstate" id="bstate" class="form-select"
                                            placeholder="Branch division/state">
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
                                        <label for="bCity">Branch City</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="bCity" id="bCity" class="form-select">
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
                <a href="{{url('/admin/company/remove/images/'.$company->id.'/'.$image->id)}}" class="d-none"><i
                        class="bi bi-x-lg deleteIcon"></i></a>
            </div>
            @endforeach
        </div>
        <form action="{{url('/admin/company/add/images/'.$updateId)}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control mb-2" placeholder="" name="newPhotos[]" id="newPhotos" multiple>
            <input type="submit" class="btn btn-outline-primary" value="upload new photos">
        </form>
        @else
        <div class="col-md-8 offset-md-2 col-12">
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
                {{-- <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="states">Branch Division/states</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <select name="states[]" id="states" class="form-select" placeholder="Your division/state"
                            multiple>
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
            <label for="cities">Branch cities</label>
        </div>
        <div class="col-md-7 col-12">
            <select name="cities[]" id="cities" class="form-select" multiple>
                @if(isset($cities))
                @foreach ($cities as $city)
                <option value="{{$city['id']}}">{{$city['name']}}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div> --}}
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
        <div class="col-md-7 col-12 d-flex">
            <input type="submit" class="btn-primary btn me-2" required value="Add">
            <a href="{{url('/admin/companies')}}"><input type="button" class="btn-secondary btn" value="Cancel"></a>
        </div>
    </div>
    </form>
    @endif
</div>
</div>
{{-- <div class="row mb-3 mt-2">

        @foreach ($addresses as $add)

        <div class="col-md-8 offset-md-2 col-12  bg-white shadow p-2 my-2">
            <div class="row">
                <div class="col-10">
                    {{$add->detail_address}}, {{$add->city->name}}, {{$add->city->state->name}}
</div>
<div class="col-2 d-flex">
    <a href="" class="me-2" onclick="edit(this);">edit</a>
    <a href="">delete</a>
</div>
</div>

</div>

@endforeach
</div>
</div> --}}
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