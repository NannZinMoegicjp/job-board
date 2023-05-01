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
        <a href="{{url('/admin/job-seekers')}}">job seeker list<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row my-3">
        @if(isset($updateId))
        <div class="col-md-7 col-12 mb-1">
            <form action="{{url('/admin/job-seekers/update/'.$updateId)}}" class="bg-white px-3 pb-2 rounded shadow"
                method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Update Job seeker</h4>
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
                        <input type="submit" class="form-control btn-primary btn" value="Update">
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
                            id="newlogofile" value="{{old('logofile')}}">
                        <input type="submit" class="btn btn-outline-primary" value="upload new logo">
                    </form>
                </div>
            </div>         
        </div>        
        @else
        <div class="col-md-8 offset-md-2 col-12">
            <form action="{{url('/admin/job-seekers/add')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h4 class="text-center py-4">Add Job Seeker</h4>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" class="form-control" required name="name" id="name"
                            value="{{ old('name') }}">
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
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="dob">Date of birth</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="date" class="form-control" placeholder="eastablished date" id="dob"
                            name="dob" value="{{old('dob')}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12  col-form-label">
                        <label for="profileImage" class="form-label">Profile image</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="file" class="form-control" placeholder="profileImage" name="profileImage" id="profileImage"
                            value="{{old('profileImage')}}">
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
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="radio" name="female" id="gender">Female
                        <input type="radio" name="male" id="gender">Male
                    </div>
                </div>               
                <div class="row mb-2">
                    <div class="col-md-3 offset-md-1 col-12">
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="submit" class="form-control btn-primary btn" required value="Add">
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
let showDeleteIcon=(photo)=>{
    photo.children[1].classList.remove('d-none');
    photo.children[1].classList.add('d-inline');
}
let hideDeleteIcon=(photo)=>{
    photo.children[1].classList.remove('d-inline');
    photo.children[1].classList.add('d-none');
}
</script>
@endsection