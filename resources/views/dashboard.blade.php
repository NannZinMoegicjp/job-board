@extends('welcome')
@section('content')
<div class="container m-2">
    <h3 class="py-3">Admin Dashboard</h3>
    <div class="row g-2">
        <div class="col-md-3">
            <div class="item orangeBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/suitcase.png')}}" alt="job">
                </div>
                <div>
                    <h5>{{$count["activeJobs"]}}</h5>
                    <h6 class="text-secondary">Active jobs</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/checklist.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["awaitOrders"]}}</h4>
                    <h6 class="text-secondary">Today Pending credit proposal</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/office-building.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["companies"]}}</h4>
                    <h6 class="text-secondary">Companies</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/employee.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["jobSeekers"]}}</h4>
                    <h6 class="text-secondary">Job Seekers</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                <div class="p-2">
                    <img src="{{URL::asset('images/dashboard/message.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["applications"]}}</h4>
                    <h6 class="text-secondary">Applications</h6>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="my-5">
    @php
    use Carbon\Carbon;
    @endphp
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- for credits --}}
    <div class="my-3">
        {{-- for credit title and date form--}}
        <div class="my-2">
            <h4 class="fw-bold text-primary text-center">
                @if($data["creditData"]["type"] == 1)
                Daily
                @elseif($data["creditData"]["type"] == 3)
                Yearly
                @else
                Monthly
                @endif sold credits
            </h4>
            <form action="{{ route('admin.dashboard.filter') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2 text-md-end"><label for="start-date" class="form-label fs-6">Start
                            Date:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" id="start-date" class="form-control" name="start_date" required
                            value="{{$data["creditData"]['startDate']}}">
                    </div>
                    <div class="col-md-2 text-md-end"><label for="end-date" class="form-label fs-6">End
                            Date:</label></div>
                    <div class="col-md-2">
                        <input type="date" id="end-date" class="form-control" name="end_date" required value="{{$data["creditData"]['endDate']}}">
                    </div>
                    <div class="col-md-2">
                        <select name="type" id="type" class="form-select" required>
                            <option value="">--select time--</option>
                            $data["creditData"]["type"]
                            <option value="1" @if( $data["creditData"]["type"]==1) selected @endif>daily</option>
                            <option value="2" @if( $data["creditData"]["type"]==2) selected @endif>monthly</option>
                            <option value="3" @if( $data["creditData"]["type"]==3) selected @endif>yearly</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <a><button id="filter-button" class="btn btn-primary me-2 reportBtn">Filter</button></a>
                        <a href="{{ route('admin.dashboard') }}"><button onclick="clearData();"
                                class="btn btn-secondary reportBtn" type="button">clear</button></a>
                    </div>
                </div>
            </form>
        </div>
        {{-- for credit chart and table --}}
        <div class="row mx-2">
            <div class="col-md-6">
                <canvas id="creditChart"></canvas>
            </div>
            <div class="col-md-6">
                @php
                $no=1;
                @endphp
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="align-middle">
                                <th>No</th>
                                <th>
                                    @if($data["creditData"]["type"] == 1)
                                    Date
                                    @elseif($data["creditData"]["type"] == 3)
                                    Year
                                    @else
                                    Month
                                    @endif
                                </th>
                                <th>No of credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["creditData"]["creditSold"] as $credit)
                            <tr class="align-middle">
                                <td>{{$no++;}}</td>
                                <td>@if($data["creditData"]["type"] == 1)
                                    {{$credit->daily}}
                                    @elseif($data["creditData"]["type"] == 3)
                                    {{$credit->year}}
                                    @else
                                    {{$credit->month}}
                                    @endif
                                </td>
                                <td>{{$credit->total_credit_point_sold}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- credit chart data --}}
        @php
        $labels = [];
        $values = [];
        foreach ( $data["creditData"]["creditSold"] as $credit){
        if($data["creditData"]["type"] == 1){
        array_push($labels, $credit->daily);
        }
        elseif($data["creditData"]["type"] == 3){
        array_push($labels,$credit->year);
        }
        else{
        array_push($labels,$credit->month);
        }
        array_push($values,$credit->total_credit_point_sold);
        }
        $chartData = [
        'labels' => $labels,
        'values' => $values,
        ];
        @endphp
        <script>
            var ctx = document.getElementById("creditChart");
                    var chartData = {!! json_encode($chartData) !!};
                    var data = {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'no of credit sold',
                            data:chartData.values,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                        };
                        new Chart(ctx, {
                            type: 'line',
                            data: data,
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                    }
                                }
                            }
                        });
        </script>
    </div>
    {{-- for sales --}}
    <div  class="my-3">
        {{-- for sale title and date form--}}
        <div class="my-2">
            <h4 class="fw-bold text-primary text-center">
                @if($data["salesData"]["type"] == 1)
                Daily
                @elseif($data["salesData"]["type"] == 3)
                Yearly
                @else
                Monthly
                @endif sales
            </h4>
            <form action="{{ route('admin.dashboard.filter') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2 text-md-end"><label for="start-dateSale" class="form-label fs-6">Start
                            Date:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" id="start-dateSale" class="form-control" name="start_dateSale" required
                            value="{{$data["salesData"]['startDate']}}">
                    </div>
                    <div class="col-md-2 text-md-end"><label for="end-dateSale" class="form-label fs-6">End
                            Date:</label></div>
                    <div class="col-md-2">
                        <input type="date" id="end-dateSale" class="form-control" name="end_dateSale" required
                            value="{{$data["salesData"]['endDate']}}">
                    </div>
                    <div class="col-md-2">
                        <select name="typeSale" id="typeSale" class="form-select" required>
                            <option value="">--select time--</option>
                            <option value="1" @if( $data["salesData"]["type"]==1) selected @endif>daily</option>
                            <option value="2" @if( $data["salesData"]["type"]==2) selected @endif>monthly</option>
                            <option value="3" @if( $data["salesData"]["type"]==3) selected @endif>yearly</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <a><button id="filter-button" class="btn btn-primary me-2 reportBtn">Filter</button></a>
                        <a href="{{ route('admin.dashboard') }}"><button onclick="clearData();"
                                class="btn btn-secondary reportBtn" type="button">clear</button></a>
                    </div>
                </div>
            </form>
        </div>
        {{-- for sale chart and table --}}
        <div class="row mx-2">
            <div class="col-md-6">
                <canvas id="saleChart"></canvas>
            </div>
            <div class="col-md-6">
                @php
                $no=1;
                @endphp
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="align-middle">
                                <th>No</th>
                                <th>
                                    @if($data["salesData"]["type"] == 1)
                                    Date
                                    @elseif($data["salesData"]["type"] == 3)
                                    Year
                                    @else
                                    Month
                                    @endif
                                </th>
                                <th>Sale amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["salesData"]["sales"] as $sale)
                            <tr class="align-middle">
                                <td>{{$no++;}}</td>
                                <td>@if($data["salesData"]["type"] == 1)
                                    {{$sale->daily}}
                                    @elseif($data["salesData"]["type"] == 3)
                                    {{$sale->year}}
                                    @else
                                    {{$sale->month}}
                                    @endif
                                </td>
                                <td>{{$sale->total_sale}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- sales chart data --}}
        @php
        //monthly sales
        $labels = [];
        $values = [];
        foreach ($data["salesData"]["sales"] as $sale){
        if($data["salesData"]["type"] == 1){
        array_push($labels, $sale->daily);
        }
        elseif($data["salesData"]["type"] == 3){
        array_push($labels,$sale->year);
        }
        else{
        array_push($labels,$sale->month);
        }
        array_push($values,$sale->total_sale);
        }
        $chartData = [
        'labels' => $labels,
        'values' => $values,
        ];
        @endphp
        <script>
            ctx = document.getElementById("saleChart");
                     chartData = {!! json_encode($chartData) !!};
                     data = {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'total amount',
                            data:chartData.values,
                            backgroundColor: [
                                '#2200FE',
                                '#e4026f',
                                '#895ae8',
                                '#934d68',
                                '#d8e815',
                                '#841414',
                                '#2cd5a0',
                                '#1a6c85',
                                '#fd3412',
                                '#40e0d0',
                                '#8e3a59',
                                '#00a7e1'
        ],
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                        };
                        new Chart(ctx, {
                            type: 'bar',
                            data: data,
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                    }
                                }
                            }
                        });
        </script>
    </div>

<script>
        let clearData=()=>{
        var myStartDateInput = document.getElementById("start-date");
        var myEndDateInput = document.getElementById("end-date");
        myStartDateInput.value = null;
        myEndDateInput.value = null;
    }
</script>
</div>
@endsection