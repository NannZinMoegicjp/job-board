@extends('Employer.master_employer')
@section('content')
<div class="row my-3">
    <div class="col-md-8 offset-md-2 col-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <form action="{{url('employer/buy/credit')}}" class="bg-white px-3 pb-2 rounded shadow" method="post"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h4 class="text-center py-4">Buy credit</h4>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12">
                    <label for="price">Price per credit</label>
                </div>
                <input type="hidden" value="{{$data['creditPrice']->id}}" name="priceId">
                <div class="col-md-6 col-12" id="price">
                    {{$data['creditPrice']->price}}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12 col-form-label">
                    <label for="noOfCredit">No of credit</label>
                    <span class="text-danger"> *</span>
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
                <div class="col-md-4 offset-md-1 col-12 ">
                    <label for="paymentMethod" class="col-form-label">Payment method</label>
                    <span class="text-danger"> *</span>
                </div>
                <div class="col-md-6 col-12">
                    <select name="paymentMethod" id="paymentMethod" class="form-select" required>
                        <option value="">-- Select payment method --</option>
                        @foreach($data['paymentMethods'] as $paymentMethod)
                        <option value="{{$paymentMethod['id']}}">{{$paymentMethod['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12">
                    <label for="paymentAccount" class="col-form-label">Transfter to this account</label>
                    <span class="text-danger"> *</span>
                </div>
                <div class="col-md-6 col-12">
                    <select name="paymentAccount" id="paymentAccount" class="form-select" required>
                        <option value="">-- Select payment account --</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12 col-form-label">
                    <label for="screenshot" class="form-label">Transferred screenshot</label>
                    <span class="text-danger"> *</span>
                </div>
                <div class="col-md-6 col-12">
                    <input type="file" class="form-control @error('screenshot') is-invalid @enderror" name="screenshot" id="screenshot"
                        value="{{old('screenshot')}}" accept=".jpeg,.jpg,.svg,.gif,.png,.tiff,.jfif,.bmp,.webp"
                        required>
                    @error('screenshot')
                    <span class="invalid-feedback mb-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 offset-md-1 col-12">
                </div>
                <div class="col-md-6 col-12 d-flex">
                    <input type="submit" class="btn-primary btn me-2" value="Buy">
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
let calculateTotal = () => {
    var price = parseInt(document.getElementById('price').innerHTML);
    var no_of_credit = document.getElementById('noOfCredit').value;
    var total = document.getElementById('totalAmount');
    total.innerHTML = price * no_of_credit;
}
$(document).ready(function() {
    $('#paymentMethod').on('change', function() {
        var paymentMethodId = this.value;
        $("#paymentAccount").html('<option value="">-- Select paymentAccount --</option>');
        $.ajax({
            url: "/api/fetch-payment-accounts/" + paymentMethodId,
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    $("#paymentAccount").append('<option value="' + value
                        .id + '">' + value.account_name + '/' + value
                        .account_no + '</option>');
                });
            },
        });
    });
});
</script>
@endsection