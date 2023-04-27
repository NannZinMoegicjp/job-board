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
                <th>Actions</th>
            </tr>
            @if (isset($awaitingOrders))
            @foreach ($awaitingOrders as $order)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$order->company->company_name}}</td>
                <td>{{$order->no_of_credit}}</td>
                <td>{{$order->creditPrice->price}}</td>
                <td>{{$order->no_of_credit*$order->creditPrice->price}}</td>
                <td>{{$order->paymentAccount->paymentMethod->name}}</td>
                <td><img src="{{URL::asset('images/payment_screenshots/'.$order->screenshot)}}" alt="" id="imageBox1" class="myimg"></td>
                <td>{{$order->created_at}}</td>
                <td><div class="d-flex">
                    <a href="{{url('/admin/order/approve/'.$order->id)}}"><i class="bi bi-check-square-fill me-2"></i></a>
                    <a onclick='return confirm("Want to reject order?")'  href="{{url('/admin/order/reject/'.$order->id)}}">
                        <i class="bi bi-x-square"></i></a>
                </div></td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
    <div id="myModal" class="myModal">
        <div class="mymodal-content">
          <span class="close">&times;</span>
          <img src="" id="modal-image" class="img img-fluid">
        </div>
      </div>
    <script>
        // Get the gallery box
var imageBox1 = document.getElementById("imageBox1");

// Get the modal image tag
var modal = document.getElementById("myModal");

var modalImage = document.getElementById("modal-image");

// When the user clicks the big picture, set the image and open the modal
imageBox1.onclick = function (e) {
  var src = e.srcElement.src;
  modal.style.display = "block";
  modalImage.src = src;
};

var span = document.getElementsByClassName("close")[0];
span.onclick = function () {
  modal.style.display = "none";
};
    </script>
</div>
@endsection