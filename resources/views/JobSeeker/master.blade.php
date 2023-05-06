<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{URL::asset('css/admin.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/order.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}" />
    <link rel="stylesheet" type="text/css"
    href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid p-2">
        <h3 class="py-3">Job seeker Dashboard</h3>
        <div class="row g-2">
            <div class="col-md-3 col-12">
                <div class="item orangeBorder d-flex justify-content-center align-items-center shadow-sm">
                    <div class="p-2">
                        <img src="{{URL::asset('images/dashboard/message.png')}}" alt="job">
                    </div>
                    <div>
                        <h5>{{count($data["applications"])}}</h5>
                        <h6 class="text-secondary">Total Applications</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="item yellowBorder d-flex justify-content-center align-items-center shadow-sm">
                    <div class="p-2">
                        <img src="{{URL::asset('images/dashboard/miscellaneous.png')}}" alt="job">
                    </div>
                    <div>
                        <h4>{{count($data["shortlistedApps"])}}</h4>
                        <h6 class="text-secondary">Shortlisted applications</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
                    <div class="p-2">
                        <img src="{{URL::asset('images/dashboard/rejected.png')}}" alt="job">
                    </div>
                    <div>
                        <h4>{{count($data["rejectedApps"])}}</h4>
                        <h6 class="text-secondary">Rejected applications</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="item greenBorder d-flex justify-content-center align-items-center shadow-sm">
                    <div class="p-2">
                        
                    </div>
                    <div>
                        <h4>{{count($data["pendingApps"])}}</h4>
                        <h6 class="text-secondary">Pending applications</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive my-5">
            <table class="table table-striped" id="datatable">
                @php
                $no=1;
                @endphp
                <thead>
                <tr>
                    <th>No</th>
                    <th>Company</th>
                    <th>Title</th>
                    <th>Applied date</th>
                    <th>Posted date</th>
                    <th>App status</th>
                    <th>Job staus</th>
                </tr>
                </thead>           
                <tbody>
                @foreach ($data['applications'] as $application)
                <tr>
                    <td>{{$no++}}</td>
                    <td><a href="">{{$application->job->address->company->company_name}}</a></td>
                    <td><a href="">{{$application->job->title}}</a></td>
                    <td>{{$application->created_at}}</td>
                    <td>{{$application->job->created_at}}</td>                    
                    <td>@if($application->status == 'rejected') <span class="badge bg-danger align-middle pb-2">{{$application->status}}</span> @elseif($application->status == 'shortlisted') <span class="badge bg-success  align-middle pb-2">{{$application->status}}</span> @else <span class="badge bg-warning  align-middle pb-2">{{$application->status}}</span> @endif</td>
                    <td>@if($application->job->status == 'active') Open @else Closed @endif</td>
                </tr>            
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#datatable').dataTable();
    });
    </script>
</body>
</html>