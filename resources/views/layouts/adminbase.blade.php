@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('css/emojionearea.min.css')}}"/>
<script type="text/javascript" src="{{asset('js/emojionearea.min.js')}}"></script>
@section('content')
<div class="container-fluid" >
    <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-sm-2 p-0 bg-light flex-shrink-1" >
            <nav class="navbar navbar-expand navbar-light bg-light flex-md-column flex-row align-items-middle py-2">
                <div class="collapse navbar-collapse ">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link pl-0 text-nowrap" href="{{url('/admin/')}}"><i class="far fa-home" ></i>  <span class="font-weight-bold" style="text-align:center;">{{__('gx.dashboard')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{url('/admin/users')}}"><i class="far fa-user" ></i> <span class="d-none d-md-inline" style="text-align:center;">{{__('gx.adminUsers')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{url('/admin/subjects')}}"><i class="far fa-book" ></i> <span class="d-none d-md-inline" style="text-align:center;">{{__('gx.adminSubjects')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{url('/admin/subjectEnrollments')}}"><i class="far fa-users"></i> <span class="d-none d-md-inline" style="text-align:center;">{{__('gx.adminEnrollments')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{url('/admin/universities')}}"><i class="far fa-university"></i> <span class="d-none d-md-inline" style="text-align:center;">{{__('gx.adminUniversities')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{url('/admin/courses')}}"><i class="far fa-file-certificate"></i> <span class="d-none d-md-inline" style="text-align:center;">{{__('gx.adminCourses')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="{{url('/admin/academicYears')}}"><i class="fal fa-calendar-alt"></i> <span class="d-none d-md-inline" style="text-align:center;">{{__('gx.adminAcademicYears')}}</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col col-sm-10 bg-faded py-3 flex-grow-1">
            @yield('content2')
        </main>
    </div>
</div>
@endsection





