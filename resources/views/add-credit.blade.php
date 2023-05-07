@extends('welcome')
@section('content')
<div class="row my-3">
    <div class="col-md-8 offset-md-2 col-12">
        <form action="{{url('/admin/company/add/credit/'.$company->id)}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h4 class="text-center py-4">Add credit for company</h4>
            </div>
            <div class="row mb-2">
                <div class="col-md-3 offset-md-1 col-12">
                    Company Name
                </div>
                <div class="col-md-7 col-12">
                    {{ $company['company_name']}}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    Existing credit
                </div>
                <div class="col-md-7 col-12">
                    {{ $company['no_of_credit']}}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                    No of credit
                </div>
                <div class="col-md-7 col-12">
                   <input type="number" min='1' name="noOfCredit" id="noOfCredit" required class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 offset-md-1 col-12">
                </div>
                <div class="col-md-7 col-12 d-flex">
                    <input type="submit" class="btn-primary btn me-2" value="Add">
                    <a href="{{url('/admin/companies')}}"><input type="button" class="btn-secondary btn"
                            value="Cancel"></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection