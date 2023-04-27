@extends('master_admin')
@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-md-end align-items-md-center my-3">
        <a href="{{url('/admin/order')}}">Awaiting Orders<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 col-12 d-flex align-items-center">
            <h3>Confirmed Orders</h3>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            @php
            $no=1;
            @endphp
            <tr>
                <th>No</th>
                <th>Company Name</th>
                <th>No of credits</th>
                <th>Price per credit</th>
                <th>Total Amount</th>
                <th>Payment method</th>
                <th>Payment Screenshot</th>
                <th>Ordered Date</th>
                <th>Is confirmed</th>
                <th>Confirmed Date</th>
            </tr>
            @if (isset($confirmedOrders))
            @foreach ($confirmedOrders as $conOrder)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$conOrder->company->company_name}}</td>
                <td>{{$conOrder->no_of_credit}}</td>
                <td>{{$conOrder->creditPrice->price}}</td>
                <td></td>
                <td>{{$conOrder->paymentAccount->paymentMethod->name}}</td>
                <td><img src="{{url('images/payment_methods/'.$conOrder->screenshot)}}" alt=""></td>
                <td>{{$conOrder->created_at}}</td>
                <td>{{$conOrder->orderConfirmation->is_confirmed}}</td>
                <td>{{$conOrder->orderConfirmation->created_at}}</td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
</div>
@endsection