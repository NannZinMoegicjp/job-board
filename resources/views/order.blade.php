@extends('welcome')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
@section('content')
<div class="container-fluid my-4">
    @if(session('status'))
    <div class="alert  alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="d-flex justify-content-md-end align-items-md-center my-3">
        <a href="{{url('/admin/payment')}}">Credit transactions<i class="bi bi-arrow-right"></i></a>
    </div>
    <h3>Pending credit proposal</h3>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped" id="datatable">
                    @php
                    $no=1;
                    @endphp
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Company Name</th>
                            <th>No of credits</th>
                            <th>Price per credit</th>
                            <!-- <th>Total Amount</th> -->

                            <!-- <th>Payment Screenshot</th> -->
                            <th>Payment method</th>
                            <th>Ordered Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($awaitingOrders))
                        @foreach ($awaitingOrders as $order)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$order->company->company_name}}</td>
                            <td>{{$order->no_of_credit}}</td>
                            <td>{{$order->creditPrice->price}}</td>
                            <!-- <td>{{$order->no_of_credit*$order->creditPrice->price}}</td> -->

                            <!-- <td><img src="{{URL::asset('images/payment_screenshots/'.$order->screenshot)}}" alt="" id="imageBox1" -->
                            <!-- class="myimg"></td> -->
                            <!-- <td><img src="{{url('images/payment_methods/'.$order->paymentAccount->paymentMethod->image)}}"
                                alt="" class="myimg"></td> -->
                            <td>{{$order->paymentAccount->paymentMethod->name}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{url('/admin/order/awaiting/details/'.$order->id)}}"><button type="button"
                                        class="btn btn-primary">View</button></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modal')
    <script src="{{URL::asset('js/script.js')}}"></script>
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