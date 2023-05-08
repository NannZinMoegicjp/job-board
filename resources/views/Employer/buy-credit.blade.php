@extends('Employer.master_employer')
@section('content')
@if(session('status'))
<div class="alert alert-success m-2">
    {{session('status')}}
</div>
@endif
<div class="row my-3">
    <div class="col-md-8 offset-md-2 col-12">
        <form action="{{url('employer/buy/credit')}}"
            class="bg-white px-3 pb-2 rounded shadow" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <h4 class="text-center py-4">Order credit</h4>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12">
                    <label for="price">Price</label>
                </div>
                <input type="hidden" value="{{$data['creditPrice']->id}}" name="priceId">
                <div class="col-md-6 col-12" id="price">
                    {{$data['creditPrice']->price}}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12 col-form-label">
                    No of credit
                </div>
                <div class="col-md-6 col-12">
                    <input type="number" min='1' name="noOfCredit" id="noOfCredit" required class="form-control"
                        onchange="calculateTotal();">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12">
                    Total amount
                </div>
                <div class="col-md-6 col-12" id="totalAmount">
                    0
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12 col-form-label">
                    Payment method
                </div>
                <div class="col-md-6 col-12">
                    <select name="paymentMethod" id="paymentMethod" class="form-select">
                        <option value="">-- Select payment method --</option>
                        @foreach($data['paymentMethods'] as $paymentMethod)
                        <option value="{{$paymentMethod['id']}}">{{$paymentMethod['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12 col-form-label">
                    Transfter to this account
                </div>
                <div class="col-md-6 col-12">
                    <select name="paymentAccount" id="paymentAccount" class="form-select">
                        <option value="">-- Select payment account --</option>
                        {{-- @foreach($data['paymentAccounts'] as $paymentAccount)
                        <option value="{{$paymentAccount['id']}}">{{$paymentAccount['account_no']}} ({{$paymentAccount['account_name']}})</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12 col-form-label">
                    <label for="screenshot" class="form-label">Transferred screenshot</label>
                </div>
                <div class="col-md-6 col-12">
                    <input type="file" class="form-control" name="screenshot" id="screenshot"
                        value="{{old('screenshot')}}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12">
                </div>
                <div class="col-md-6 col-12 d-flex">
                    <input type="submit" class="btn-primary btn me-2" value="Order">
                    <a href="{{url('/employer')}}"><input type="button" class="btn-secondary btn" value="Cancel"></a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
let calculateTotal=()=> {
    var price = parseInt(document.getElementById('price').innerHTML);
    var no_of_credit = document.getElementById('noOfCredit').value;
    var total = document.getElementById('totalAmount');
    total.innerHTML = price * no_of_credit;
}
$(document).ready(function () {
$('#paymentMethod').on('change', function () {
                var paymentMethodId = this.value;
                $("#paymentAccount").html('<option value="">-- Select paymentAccount --</option>');
                $.ajax({
                    url: "/api/fetch-payment-accounts/" + paymentMethodId,
                    type: "GET",
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function (key, value) {
                            $("#paymentAccount").append('<option value="' + value
                                .id + '">' + value.account_name + '/'+ value.account_no + '</option>');
                        });
                    },
                });
            });
            });
</script>
@endsection