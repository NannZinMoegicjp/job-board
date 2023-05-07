@extends('welcome')
@section('css')
<link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
@endsection
@section('content')
<div class="container my-4">
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <!-- payment methods -->
    <div class="row mb-3">
        <div class="col">
            <div class="d-flex">
                <div>
                    <h3>Payment methods</h3>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addPaymentMethod">
                        <i class="bi bi-plus"></i> Add payment method
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped" id="paymentMethodTable">
                    @php
                    $no=1;
                    @endphp
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $payment_method)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$payment_method["name"]}}</td>
                        <td>
                            <img src="{{url('images/payment_methods/'.$payment_method['image'])}}" alt="" class="myimg">
                        </td>
                        <td>
                            <div class="d-flex">
                                <input type="hidden" value='{{$payment_method["id"]}}'>
                                <a onclick="filldata(this);" data-bs-toggle="modal"
                                    data-bs-target="#updatePaymentMethod">
                                    <i class="bi bi-pencil-fill update"></i>
                                </a>
                                <a onclick='return confirm("Want to delete?")'
                                    href="{{url('/admin/payment-methods/delete/'.$payment_method->id)}}"><i
                                        class="bi bi-trash3-fill cancel"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- payment account -->
    <div class="row mt-5 mb-3">
        <div class="col">
            <div class="d-flex">
                <div>
                    <h3>Accounts</h3>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addPaymentAccount">
                        <i class="bi bi-plus"></i> Add account
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped" id="paymentAccountTable">
                    @php
                    $no=1;
                    @endphp
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Acc no</th>
                        <th>Method</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $payment_account)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$payment_account["account_name"]}}</td>
                        <td>{{$payment_account["account_no"]}}</td>
                        <td>{{$payment_account->paymentMethod->name}}</td>
                        <td>
                            <div class="d-flex">
                                <input type="hidden" value='{{$payment_account["id"]}}'>
                                <a onclick="fillAccountData(this);" data-bs-toggle="modal"
                                    data-bs-target="#updatePaymentAccount">
                                    <i class="bi bi-pencil-fill update"></i>
                                </a>
                                <a onclick='return confirm("Want to delete?")'
                                    href="{{url('/admin/payment-accounts/delete/'.$payment_account->id)}}"><i
                                        class="bi bi-trash3-fill cancel"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- update payment method -->
    <div class="modal fade" id="updatePaymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update payment method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updatePM">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label">
                                <label for="updateName">name</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="updateName" id="updateName" class="myinput" value="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label">
                                <label for="updateImage">Image</label>
                            </div>
                            <div class="col-md-5">
                                <input type="file" name="updateImage" id="updateImage" class="myinput">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 offset-md-3 col-form-label">
                            </div>
                            <div class="col-md-4 d-flex">
                                <input type="submit" value="update payment method" class="btn btn-primary me-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- insert payment method -->
    <div class="modal fade" id="addPaymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>Add payment method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/admin/payment-methods/add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label">
                                <label for="name">name</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" required name="name" id="name" class="myinput">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-2 col-form-label">
                                <label for="image">Image</label>
                            </div>
                            <div class="col-md-5">
                                <input type="file" required name="image" id="image" class="myinput">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 offset-md-3 col-form-label">
                            </div>
                            <div class="col-md-4 d-flex">
                                <input type="submit" value="add payment method" class="btn btn-primary me-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- insert payment account -->
    <div class="modal fade" id="addPaymentAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>Add account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/admin/payment-accounts/add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4 col-form-label">
                                <label for="payMethod">Payment Method</label>
                            </div>
                            <div class="col-md-7">
                                <select name="payMethod" id="payMethod" class="form-select">
                                    @foreach($data as $payment_method)
                                    <option value="{{$payment_method['id']}}">{{$payment_method["name"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 col-form-label">
                                <label for="accName">Account Name</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" required name="accName" id="accName" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 col-form-label">
                                <label for="accNo">Account Number</label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" required name="accNo" id="accNo" class="form-control">
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-7">
                                <input type="submit" value="add account" class="btn btn-primary me-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- update payment account -->
    <div class="modal fade" id="updatePaymentAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>Update account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="updatePA">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4 col-form-label">
                                <label for="updateAccName">Account Name</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" required name="updateAccName" id="updateAccName"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 col-form-label">
                                <label for="updateAccNo">Account Number</label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" required name="updateAccNo" id="updateAccNo" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 col-form-label">
                                <label for="updatePayMethod">Payment Method</label>
                            </div>
                            <div class="col-md-7">
                                <select name="updatePayMethod" id="updatePayMethod" class="form-select">
                                    @foreach($data as $payment_method)
                                    <option value="{{$payment_method['id']}}">{{$payment_method["name"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-7">
                                <input type="submit" value="update account" class="btn btn-primary me-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    let filldata = (a) => {
        let td = a.parentNode.parentNode.parentNode.children;
        document.getElementById("updateName").value = td[1].innerHTML;
        let ch = a.parentNode.children;
        document.getElementById("updatePM").action = "{{url('/admin/payment-methods/update')}}".concat('/', ch[0]
            .value);
    }
    let fillAccountData = (a) => {
        let td = a.parentNode.parentNode.parentNode.children;
        document.getElementById("updateAccName").value = td[1].innerHTML;
        document.getElementById("updateAccNo").value = td[2].innerHTML;
        let selectedMethod = td[3].innerHTML;
        
        let select = document.getElementById('updatePayMethod');
        for (let option of select.options) {
            if (option.text === selectedMethod) {                
                option.selected = true;
                break;
            }
        }
        let ch = a.parentNode.children;
        document.getElementById("updatePA").action = "{{url('/admin/payment-accounts/update')}}".concat('/', ch[0]
            .value);
    }
    </script>
</div>
@endsection
@section('scripts')
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#paymentMethodTable').dataTable();
});
$(document).ready(function() {
    $('#paymentAccountTable').dataTable();
});
</script>
@endsection