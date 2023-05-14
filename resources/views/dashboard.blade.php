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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="my-2">
        <h4 class="fw-bold text-primary text-center">Monthly sold credits<h4>
                <form action="{{ route('admin.dashboard.filter') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col text-end"><label for="start-date" class="form-label fs-6">Start Date:</label>
                        </div>
                        <div class="col">
                            <input type="date" id="start-date" class="form-control" name="start_date" required
                                value="{{$data['startDate']}}">
                        </div>
                        <div class="col text-end"><label for="end-date" class="form-label fs-6">End Date:</label></div>
                        <div class="col">
                            <input type="date" id="end-date" class="form-control" name="end_date" required
                                value="{{$data['endDate']}}">
                        </div>
                        <div class="col">
                            <button id="filter-button">Filter</button>
                            <button onclick="clearData();" type="button">clear</button>
                        </div>
                    </div>
                </form>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <canvas id="creditChart"></canvas>
        </div>
        <div class="col-md-6 col-12">
            @php
            $no=1;
            @endphp
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Month</th>
                            <th>No of credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data["creditSold"] as $credit)
                        <tr>
                            <td>{{$no++;}}</td>
                            <td>{{$credit->month}}</td>
                            <td>{{$credit->total_credit_point_sold}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-6">
            <h4 class="fw-bold text-primary text-center">Top 5 hiring companies<h4>
                    <canvas id="companyChart"></canvas>
        </div>
        <div class="col-6">
            <h4 class="fw-bold text-primary text-center">Monthly sales<h4>
                    <canvas id="saleChart"></canvas>
        </div>
    </div>
    @php
    //monthly sold credit
    $labels = [];
    $values = [];
    foreach ($data["creditSold"] as $credit){
    array_push($labels,$credit->month);
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
    @php
    //monthly sales
    $labels = [];
    $values = [];
    foreach ($data["monthlySales"] as $sale){
    array_push($labels,$sale->month);
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
    @php
    //monthly sold credit
    $labels = [];
    $values = [];
    foreach ($data["topHiringCompanies"] as $company){
    array_push($labels,$company->company_name);
    array_push($values,$company->job_count);
    }
    $chartData = [
    'labels' => $labels,
    'values' => $values,
    ];
    @endphp
    <script>
        var options = {
    responsive: true,
    maintainAspectRatio: false,
    aspectRatio: 1,
    width: 500,
    height: 500
    };
    chart = document.getElementById("companyChart");
    chartData = {!! json_encode($chartData) !!};
     data = {
  labels: chartData.labels,
  datasets: [{
    label: 'Number of jobs',
    data: chartData.values,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'green',
        '#fd3412'
    ],
    hoverOffset: 4
  }]
    };
    new Chart(chart, {
        type: 'pie',
        data: data,
        options:options
    });
    </script>
    <script>
        let clearData=()=>{
        alert('clear');
        var myStartDateInput = document.getElementById("start-date");
        var myEndDateInput = document.getElementById("end-date");
        myStartDateInput.value = null;
        myEndDateInput.value = null;
    }
    </script>
</div>
@endsection