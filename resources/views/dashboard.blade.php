@extends('welcome')
@section('content')
<div class="container my-2">
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
                    <img src="{{URL::asset('images/dashboard/order.png')}}" alt="job">
                </div>
                <div>
                    <h4>{{$count["conOrders"]}}</h4>
                    <h6 class="text-secondary">Confirmed Orders</h6>
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
                    <h6 class="text-secondary">Awaiting Orders</h6>
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
    <div>
        
        @php
        $labels = [];
        $values = [];
        foreach ($data["monthlySales"] as $sale){
            array_push($labels,$sale->month);
            array_push($values,$sale->total_credit_point_sold);
        }        
        $chartData = [
        'labels' => $labels,
        'values' => $values,
        ];
        @endphp
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div>
    <h4 class="fw-bold text-primary text-center">Monthly <h4>
            <canvas id="saleChart"></canvas>
</div>

<script>
    const ctx = document.getElementById("saleChart");
    const chartData = {!! json_encode($chartData) !!};
    const data = {
        labels: chartData.labels,
        datasets: [{
            label: 'item count',
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
                    max: 50
                }
            }
        }
    });
</script>
<div>
    <canvas id="myChart"></canvas>
  </div>  
  <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endsection