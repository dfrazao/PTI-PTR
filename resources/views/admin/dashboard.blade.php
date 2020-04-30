@extends('layouts.adminbase')
@section('content')

    <div class="container w-75 h-75">
        <h3 class="pt-3 pb-3 rounded">Admin Dashboard</h3>
        <nav class="navbar navbar-expand navbar-light bg-light ">
            <div class="collapse navbar-collapse ">
                <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">

                    <li class="nav-item">
                        <a class="nav-link pl-0" href="{{url('/admin/users')}}"><i class="far fa-user" ></i> <span class="d-none d-md-inline" style="text-align:center;">Users</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-0" href="{{url('/admin/subjects')}}"><i class="far fa-book" ></i> <span class="d-none d-md-inline" style="text-align:center;">Subjects</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-0" href="{{url('/admin/subjectEnrollments')}}"><i class="far fa-users"></i> <span class="d-none d-md-inline" style="text-align:center;">Enrollment</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-0" href="{{url('/admin/universities')}}"><i class="far fa-university"></i> <span class="d-none d-md-inline" style="text-align:center;">Universities</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-0" href="{{url('/admin/courses')}}"><i class="far fa-file-certificate"></i> <span class="d-none d-md-inline" style="text-align:center;">Courses</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-0" href="{{url('/admin/academicYears')}}"><i class="fal fa-calendar-alt"></i> <span class="d-none d-md-inline" style="text-align:center;">Academic Years</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        </div>
    </div>

@endsection
