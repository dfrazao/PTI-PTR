@extends('layouts.adminbase')
@section('content2')
    <head>
        <title>Admin Dashboard</title>
    </head>
    <link rel="stylesheet" href="{{asset('adminLTE3.0.4/css/adminlte.min.css')}}">
    <div class="wrapper">
        <script src="{{asset('dist/Chart.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('dist/Chart.min.css')}}">


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$countUsers}}</h3>

                                    <p>{{__('gx.user registrations')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$countStudents}}{{--<sup style="font-size: 20px">%</sup>--}}</h3>

                                    <p>{{__('gx.students')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{$countProfessors}}</h3>

                                    <p>{{__('gx.professors')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$countUniversities}}</h3>

                                    <p>{{__('gx.adminUniversities')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Stats
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Line</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="revenue-chart"
                                             style="position: relative; height: 600px;">
                                            <canvas id="line-chart" ></canvas>
                                            <script>
                                                new Chart(document.getElementById("line-chart"), {
                                                    type: 'line',
                                                    data: {
                                                        labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                                                        datasets: [{
                                                            data: [86,114,106,106,107,111,133,221,783,2478],
                                                            label: "Africa",
                                                            borderColor: "#3e95cd",
                                                            fill: false
                                                        }, {
                                                            data: [282,350,411,502,635,809,947,1402,3700,5267],
                                                            label: "Asia",
                                                            borderColor: "#8e5ea2",
                                                            fill: false
                                                        }, {
                                                            data: [168,170,178,190,203,276,408,547,675,734],
                                                            label: "Europe",
                                                            borderColor: "#3cba9f",
                                                            fill: false
                                                        }, {
                                                            data: [40,20,10,16,24,38,74,167,508,784],
                                                            label: "Latin America",
                                                            borderColor: "#e8c3b9",
                                                            fill: false
                                                        }, {
                                                            data: [6,3,2,2,7,26,82,172,312,433],
                                                            label: "North America",
                                                            borderColor: "#c45850",
                                                            fill: false
                                                        }
                                                        ]
                                                    },
                                                    options: {
                                                        title: {
                                                            display: true,
                                                            text: 'World population per region (in millions)'
                                                        }
                                                    }
                                                });

                                            </script>
                                        </div>
                                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 600px;">
                                            <canvas id="doughnut-chart" width="300" height="300"></canvas>
                                            <script>
                                                new Chart(document.getElementById("doughnut-chart"), {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                                                        datasets: [
                                                            {
                                                                label: "Population (millions)",
                                                                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                                                data: [2478,5267,734,784,433]
                                                            }
                                                        ]
                                                    },
                                                    options: {
                                                        title: {
                                                            display: true,
                                                            text: 'Predicted world population (millions) in 2050'
                                                        }
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->



                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">

                            <!-- solid sales graph -->
                            <div class="card bg-gradient-info">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-th mr-1"></i>
                                        Sales Graph
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer bg-transparent">
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                                                   data-fgColor="#39CCCC">

                                            <div class="text-white">Mail-Orders</div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-4 text-center">
                                            <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                                                   data-fgColor="#39CCCC">

                                            <div class="text-white">Online</div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-4 text-center">
                                            <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                                   data-fgColor="#39CCCC">

                                            <div class="text-white">In-Store</div>
                                        </div>
                                        <!-- ./col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->

                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
                <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->




    <!-- AdminLTE App -->
    <script src="{{asset('adminLTE3.0.4/js/adminlte.min.js')}}"></script>
    <script src="{{asset('adminLTE3.0.4/js/pages/dashboard.js')}}"></script>




@endsection
