@extends('master_admin')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
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
        <table class="table table-striped" id="datatable">
            @php
            $no=1;
            @endphp
            <thead>
            <tr>
                <th>No</th>
                <th>Company Name</th>
                <!-- <th>No of credits</th>                
                <th>Price per credit</th>
                <th>Total Amount</th>
                <th>Payment method</th> -->
                <th>Ordered Date</th>
                <th>Status</th>
                <th>Confirmed Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (isset($confirmedOrders))
            @foreach ($confirmedOrders as $corder)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$corder->order->company->company_name}}</td>
                <!-- <td>{{$corder->order->no_of_credit}}</td>
                <td>{{$corder->order->creditPrice->price}}</td>
                <td>{{$corder->order->no_of_credit*$corder->order->creditPrice->price}}</td>
                <td>{{$corder->order->paymentAccount->paymentMethod->name}}</td> -->
                <td>{{$corder->order->created_at}}</td>
                @if($corder->is_confirmed) <td class="text-success">Accepted</td> @else <td class="text-danger">Rejected</td> @endif  
                <td>{{$corder->created_at}}</td> 
                <td>
                <a href="{{url('/admin/order/confirmed/details/'.$corder->id)}}" class="text-center">
                <button type="button" class="btn btn-primary">
                 View details
                </button>    
                </a>
                </td>            
            </tr>
            @endforeach
            @endif
            </tbody>            
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js">
</script>

<script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatable').dataTable();
});
</script>
@endsection