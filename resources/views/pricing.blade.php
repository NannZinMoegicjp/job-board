@extends('master_admin')
@section('content')
<div class="container my-4">
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/price-tag.png')}}" alt="price">
                </div>
                @php
                $no=1;
                $id=-1;
                $latestPrice = 0;
                @endphp
                <div>
                @foreach($data as $price)
                @php
                    if(is_null($price["updated_at"])){
                    $latestPrice=$price["price"];
                    $id = $price["id"];
                    }
                @endphp
                @endforeach
                    <h4>{{$latestPrice}}</h4>
                    <h6 class="text-secondary">Current Price</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md col-12">
            <h3>Price per credit</h3>
        </div>
        <div class="col-md col-12 text-md-end">
            @if($data->isEmpty())
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprice">
                <i class="bi bi-plus"></i> Add Price
            </button>
            @else
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-pencil-fill"></i> Update current price
            </button>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Price</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>

            @foreach($data as $price)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$price["price"]}}</td>
                <td>{{$price["created_at"]}}</td>
                <td>{{$price["updated_at"]}}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- update Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/admin/pricing/update/'.$id)}}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label"><label for="curPrice">Current Price</label>
                            </div>
                            <div class="col-md-5"><input type="number" min="0" disabled value="{{$latestPrice}}"
                                    name="curPrice" id="curPrice" class="myinput"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label">
                                <label for="newPrice">New Price</label>
                            </div>
                            <div class="col-md-5">
                                <input type="number" min="0" name="newPrice" id="newPrice" class="myinput">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 offset-md-3 col-form-label">
                            </div>
                            <div class="col-md-4 d-flex">
                                <input type="submit" value="update" class="btn btn-primary me-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- insert Model -->
    <div class="modal fade" id="addprice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addpriceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addpriceLabel">Add price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/admin/pricing/insert')}}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label">
                                <label for="price">Price</label>
                            </div>
                            <div class="col-md-5">
                                <input type="number" required min="0" name="price" id="price" class="myinput">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 offset-md-3 col-form-label">
                            </div>
                            <div class="col-md-4 d-flex">
                                <input type="submit" value="add" class="btn btn-primary me-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection