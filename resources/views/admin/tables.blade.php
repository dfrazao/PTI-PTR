@extends('layouts.adminbase')
@section('content2')
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
        <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
    </head>
    @if($data[0]->role == 'admin' || $data[0]->role == 'student' || $data[0]->role == 'professor')
        <!-- Modal - Create -->
        <div class="modal" id="modal-1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form action="{{ action('AdminController@store','users')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="table" name="table" value="users">

                            <div class="form-group">
                                <label >uniNumber</label>
                                <input type="text" class="form-control" name="uniNumber" id="uniNumber">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Role</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="student">Student</option>
                                    <option value="professor">Professor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label >Email address</label>
                                <input type="email" class="form-control" name="email" id="email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" minlength="8" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label >Photo</label>
                                <input type="text" class="form-control" name="photo" id="photo">
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                            <button href="/tables" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>



        <!-- Modal - Import Data -->
        <div class="modal" id="modal-2" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Students Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action('AdminController@import')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="file" name="upload-file" class="form-control-file">
                            </div>
                            <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-xl" style="margin-left:10%;max-width: 90%; margin-bottom: 5%;">
            <!-- Search form -->
            <div style="margin-top: 3%;margin-bottom: 3%;">
                <h3>Users</h3>
            </div>

            <div class="content" style="">
                <div class="row">
                    <div class="col-xl-12">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                            </div>

                            <div class="card-body" >
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover">
                                        <thead class=" text-primary">
                                        <tr>

                                            <th scope="col" >
                                                ID
                                            </th>
                                            <th scope="col">
                                                uniNumber
                                            </th>
                                            <th scope="col">
                                                Role
                                            </th>
                                            <th scope="col">
                                                Name
                                            </th>
                                            <th scope="col">
                                                Email
                                            </th>
                                            <th scope="col" >
                                                Photo
                                            </th>
                                            <th scope="col" >
                                                Country
                                            </th>
                                            <th scope="col" >
                                                City
                                            </th>
                                            <th scope="col" >
                                                Description
                                            </th>
                                            <th scope="col" >
                                                Tools
                                            </th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($data as $user)
                                            <tr>
                                                <td>
                                                    {{$user->id}}
                                                </td>
                                                <td>
                                                    {{$user->uniNumber}}
                                                </td>
                                                <td>
                                                    {{$user->role}}
                                                </td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                            <span class="profile-picture">
                        <img class="editable img-responsive rounded" style="height: 50px;" alt=" Avatar" id="avatar2" src="/profilePhotos/{{ $user->photo }}">
                    </span>
                                                </td>
                                                <td>
                                                    {{$user->country}}
                                                </td>
                                                <td>
                                                    {{$user->city}}
                                                </td>
                                                <td>
                                                    {{$user->description}}
                                                </td>
                                                <td class="text-right">

                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fal fa-tools"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" id="edit" href="/admin/edit-user/{{$user->id}}" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-3" id="edit" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>

                                            <!-- Modal - Delete -->
                                            <div class="modal" id="modal-3" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <form action="/admin/delete-user/{{$user->id}}" method="POST">
                                                                {{ csrf_field() }}
                                                                {{method_field('DELETE')}}
                                                                <div class="form-group">
                                                                    <p>Are you sure you want to delete this?</p>
                                                                </div>
                                                                <button type="submit" class="btn btn-danger">Delete</button>

                                                            </form>
                                                            <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    @elseif($data[0]->idGeneralSubject > 0 )

        <!-- Modal - Create -->
        <div class="modal" id="modal-1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">


                        <form action="{{ action('AdminController@store','subjects')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="table" name="table" value="subjects">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">General Subject</label>
                                <select class="form-control" name="idGenSubject" id="idGenSubject">
                                    {{--@foreach($general_subjects as $gsubject)--}}

                                        {{--<option value="{{$gsubject->idGeneralSubject}}">{{$gsubject->name}}</option>--}}
                                    {{--@endforeach--}}

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Subject Name</label>
                                <input type="text" class="form-control" name="subjectName" id="subjectName">
                            </div>
                            <div class="form-group">
                                <label>Class</label>
                                <input type="text" class="form-control" name="class" id="class">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Academic Year</label>
                                <select class="form-control" name="academicYear" id="academicYear">
                                    {{--@foreach($academicYears as $year)--}}

                                    {{--<option value="{{$year->academicYear}}">{{$year->academicYear}}</option>--}}
                                    {{--@endforeach--}}

                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Create</button>
                            <button href="/tables" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- Modal - Import Data -->
        <div class="modal" id="modal-2" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action('AdminController@import')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="file" name="upload-file" class="form-control-file">
                            </div>
                            <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-xl" style="margin-left:10%;max-width: 90%; margin-bottom: 5%;">
            <!-- Search form -->
            <div style="margin-top: 3%;margin-bottom: 3%;">
                <h3>Subjects</h3>
            </div>

            <div class="content" style="">
                <div class="row">
                    <div class="col-xl-12">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                            </div>

                            <div class="card-body" >
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover">
                                        <thead class=" text-primary">
                                        <tr>
                                            <th scope="col" >
                                                idSubject
                                            </th>
                                            <th scope="col" >
                                                idGeneralSubject
                                            </th>
                                            <th scope="col">
                                                Subject Name
                                            </th>
                                            <th scope="col">
                                                Class
                                            </th>
                                            <th scope="col" >
                                                Academic Year
                                            </th>
                                            <th scope="col" class="text-right">
                                                Tools
                                            </th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($data as $subjects)
                                            <tr>
                                                <td>
                                                    {{$subjects->idSubject}}
                                                </td>
                                                <td>
                                                    {{$subjects->idGeneralSubject}}
                                                </td>
                                                <td>
                                                    {{$subjects->subjectName}}
                                                </td>
                                                <td>
                                                    {{$subjects->class}}
                                                </td>
                                                <td>
                                                    {{$subjects->academicYear}}
                                                </td>
                                                {{--</td>--}}
                                                <td class="text-right">

                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fal fa-tools"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" id="edit" href="/admin/edit-user/{{$subjects->idGeneralSubject}}" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-3" id="edit" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>

                                            <!-- Modal - Delete -->
                                            <div class="modal" id="modal-3" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <form action="/admin/delete-user/{{$subjects->idGeneralSubject}}" method="POST">
                                                                {{ csrf_field() }}
                                                                {{method_field('DELETE')}}
                                                                <div class="form-group">
                                                                    <p>Are you sure you want to delete this?</p>
                                                                </div>
                                                                <button type="submit" class="btn btn-danger">Delete</button>

                                                            </form>
                                                            <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @else
            <!-- Modal - Create -->
                <div class="modal" id="modal-1" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">


                                <form action="{{ action('AdminController@store','subjectEnrollments')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="table" name="table" value="subjectEnrollments">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User</label>
                                        <select class="form-control" name="idUser" id="idUser">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Subject</label>
                                        <select class="form-control" name="idSubject" id="idSubject">
                                            @foreach($subjects as $sub)
                                                <option value="{{$sub->idSubject}}">{{$sub->subjectName}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User</label>
                                        <select class="form-control" name="class" id="class">
                                            @foreach($subjects as $sub)
                                                <option value="{{$ze = $sub->class}}">{{$sub->class}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Create</button>
                                    <button href="/tables" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- Modal - Import Data -->
                <div class="modal" id="modal-2" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Import Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ action('AdminController@import')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="file" name="upload-file" class="form-control-file">
                                    </div>
                                    <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-xl" style="margin-left:10%;max-width: 90%; margin-bottom: 5%;">
                    <!-- Search form -->
                    <div style="margin-top: 3%;margin-bottom: 3%;">
                        <h3>Subjects Enrollments</h3>
                    </div>

                    <div class="content" style="">
                        <div class="row">
                            <div class="col-xl-12">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                        <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                                    </div>

                                    <div class="card-body" >
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-hover">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th scope="col" >
                                                        idUser
                                                    </th>

                                                    <th scope="col">
                                                        idSubject
                                                    </th>
                                                    <th scope="col">
                                                        Class
                                                    </th>

                                                    <th scope="col" class="text-right">
                                                        Tools
                                                    </th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($data as $enroll)
                                                    <tr>
                                                        <td>
                                                            {{$enroll->idUser}}
                                                        </td>
                                                        <td>
                                                            {{$enroll->idSubject}}
                                                        </td>
                                                        <td>
                                                            {{$enroll->Class}}
                                                        </td>

                                                        <td class="text-right">

                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fal fa-tools"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    {{--<a class="dropdown-item" id="edit" href="/admin/edit-user/{{$subjects->idGeneralSubject}}" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>--}}
                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-3" id="edit" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                                </div>
                                                            </div>

                                                        </td>

                                                    </tr>

                                                    <!-- Modal - Delete -->
                                                    <div class="modal" id="modal-3" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">

                                                                    {{--<form action="/admin/delete-user/{{$subjects->idGeneralSubject}}" method="POST">--}}
                                                                        {{ csrf_field() }}
                                                                        {{method_field('DELETE')}}
                                                                        <div class="form-group">
                                                                            <p>Are you sure you want to delete this?</p>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-danger">Delete</button>

                                                                    </form>
                                                                    <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif







        <script>$(document).ready( function () {
                $('#datatable').DataTable();
            } );</script>
@endsection

