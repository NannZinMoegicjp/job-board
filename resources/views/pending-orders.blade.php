@extends('welcome')
@section('content')
<div class="row text-end my-2 me-2">
    <a href="{{url('/admin/payment')}}">Pending credit proposal<i class="bi bi-arrow-right"></i></a>
</div>
<div class="row">
    <div class="col-md-10 offset-md-1 col-12">
        <div class="bg-white shadow my-3 p-1">
            <h3 class="text-center my-3">Payment summary</h3>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Customer</div>
                <div class="col-md-5 col-7">{{$corder->order->company->company_name}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">No of credit</div>
                <div class="col-md-5 col-7">{{$corder->order->no_of_credit}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Price per credit</div>
                <div class="col-md-5 col-7">{{$corder->order->creditPrice->price}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Total amount</div>
                <div class="col-md-5 col-7">{{$corder->order->no_of_credit*$corder->order->creditPrice->price}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Order date</div>
                <div class="col-md-5 col-7">{{$corder->order->created_at}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Payment method</div>
                <div class="col-md-5 col-7">{{$corder->order->paymentAccount->paymentMethod->name}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Status</div>
                <div class="col-md-5 col-7">
                    @if($corder->is_confirmed) <span class="text-success">Accepted</span> @else <span
                        class="text-danger">Rejected</span> @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Confirmed date</div>
                <div class="col-md-5 col-7">{{$corder->created_at}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 offset-md-2 text-end col-5">Screenshot</div>
                <div class="col-md-5 col-12">
                    <img src="{{URL::asset('images/payment_screenshots/'.$corder->order->screenshot)}}" alt=""
                        id="imageBox1" class="img img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection