@extends('Employer.master_employer')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
    </div>
    <h3 class="my-2">Pending purchasement</h3>
    <div class="table-responsive">
        <table class="table table-striped" id="awaitingOrderTable">
            @php
            $no=1;
            @endphp
            <thead>
                <tr class="align-middle">
                    <th>No</th>
                    <th>No of credit</th>
                    <th>Price</th>
                    <th>Total amount</th>
                    <th>Ordered date</th> 
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($awaitingOrders as $awaitingOrder)
                <tr class="align-middle">
                    @if($awaitingOrder)
                    <td>{{$no++}}</td>
                    <td>{{$awaitingOrder->no_of_credit}}</td>
                    <td>{{$awaitingOrder->creditPrice->price}}</td>
                    <td>{{$awaitingOrder->no_of_credit*$awaitingOrder->creditPrice->price}}</td>
                    <td>{{$awaitingOrder->created_at->todatestring()}}</td>
                    <td><span class="text-warning">Pending</span></td>
                    <td>
                        <div class="d-flex">
                            <a href="{{url('/employer/awaiting/order/details/'.$awaitingOrder->id)}}"><button class="btn btn-primary">view</button></a>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h3 class="my-2 mt-3">Purchasement history</h3>
    <div class="table-responsive">
        <table class="table table-striped" id="datatable">
            @php
            $no=1;
            @endphp
            <thead>
                <tr class="align-middle">
                    <th>No</th>
                    <th>No of credit</th>
                    <th>Price</th>
                    <th>Total amount</th>
                    <th>Ordered date</th>
                    <th>Confirmed date</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($confirmedOrders as $confirmedOrder)
                <tr class="align-middle">
                    @if($confirmedOrder)
                    <td>{{$no++}}</td>
                    <td>{{$confirmedOrder->order->no_of_credit}}</td>
                    <td>{{$confirmedOrder->order->creditPrice->price}}</td>
                    <td>{{$confirmedOrder->order->no_of_credit*$confirmedOrder->order->creditPrice->price}}</td>
                    <td>{{$confirmedOrder->order->created_at->todatestring()}}</td>
                    <td>{{$confirmedOrder->created_at->todatestring()}}</td>
                    @if($confirmedOrder->is_confirmed) <td class="text-success">Accepted</td> @else <td class="text-danger">Rejected</td> @endif  
                    <td>
                        <div class="d-flex">
                            <a href="{{url('/employer/confirmed/order/details/'.$confirmedOrder->id)}}"><button class="btn btn-primary">view</button></a>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
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
$(document).ready(function() {
    $('#awaitingOrderTable').dataTable();
});
</script>
@endsection