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
                <th>Is Confirmed</th>
                <th>Confirmed Date</th>
            </tr>
            @if (isset($confirmedOrder))
            @foreach ($confirmedOrder as $corder)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$corder->order->company->company_name}}</td>
                <td>{{$corder->order->no_of_credit}}</td>
                <td>{{$corder->order->creditPrice->price}}</td>
                <td>{{$corder->order->no_of_credit*$corder->order->creditPrice->price}}</td>
                <td>{{$corder->order->paymentAccount->paymentMethod->name}}</td>
                <td><img src="{{url('images/payment_screenshots/'.$corder->order->screenshot)}}" alt=""></td>
                <td>{{$corder->order->created_at}}</td>
                <td>{{$corder->is_confirmed}}</td>   
                <td>{{$corder->created_at}}</td>             
            </tr>
            @endforeach
            @endif
        </table>
    </div>
</div>
@endsection