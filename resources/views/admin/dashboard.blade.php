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
                                {{--<a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>--}}
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
                                {{--<a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>--}}
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
                                {{--<a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>--}}
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
                                {{--<a href="#" class="small-box-footer">{{__('gx.more info')}} <i class="fas fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <!-- /.row -->
                </div>

            </section>
                        <!-- /.Left col -->

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
