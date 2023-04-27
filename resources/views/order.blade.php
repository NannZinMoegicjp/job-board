@extends('master_admin')
@section('content')
<div class="container-fluid my-4">
    <div class="d-flex justify-content-md-end align-items-md-center my-3">
        <a href="{{url('/admin/payment')}}">Confirmed Orders<i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row mb-2">
        <div class="col-md-3 col-12 d-flex align-items-center">
            <h3>Awaiting Orders</h3>
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
                <th>Action</th>
            </tr>
            @if (isset($awaitingOrders))
            @foreach ($awaitingOrders as $order)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$order->company->company_name}}</td>
                <td>{{$order->no_of_credit}}</td>
                <td>{{$order->creditPrice->price}}</td>
                <td>{{$order->no_of_credit}}*{{$order->creditPrice->price}}</td>
                <td>{{$order->paymentAccount->paymentMethod->name}}</td>
                <td><img src="{{url('images/payment_methods/'.$order->screenshot)}}" alt=""></td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->orderConfirmation->is_confirmed}}</td>
                <td>{{$order->orderConfirmation->created_at}}</td>
                <td>
                <div class="d-flex">
                        <a href="{{url('/admin/order/approve/'.$order->id)}}"><i class="bi bi-eye-fill view"></i></a>
                        <a onclick='return confirm("Want to reject order?")'  href="{{url('/admin/order/reject/'.$order->id)}}"><i
                                class="bi bi-trash3-fill cancel"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
</div>
@endsection