@extends('layouts.adminbase')
@section('content2')


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

                    <form action="{{ action('AdminController@store')}}" method="POST">
                        {{ csrf_field() }}
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
                    <form style="margin-left: 10%; margin-right:auto; margin-bottom: 5%;margin-top: 5%;">
                        <p>File type accepted (CSV, XML, SQL)</p>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".csv, .sql, .xml">
                            <br>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                        Password
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
                                    @foreach($users as $user)
                                    <tr>
                                        <td style="max-width: 10%;">
                                            {{$user->id}}
                                        </td>
                                        <td style="max-width: 10%;">
                                            {{$user->uniNumber}}
                                        </td>
                                        <td style="max-width: 10%;">
                                            {{$user->role}}
                                        </td>
                                        <td style="max-width: 10%;">
                                            {{$user->name}}
                                        </td>
                                        <td style="max-width: 10%;">
                                            {{$user->email}}
                                        </td>
                                        <td style="max-width: 50px;">
                                            <button class="btn btn-primary" id="button1" onclick="myFunction()">Show</button>
                                            <script>function myFunction() {
                                                    var x = document.getElementById("myDIV");
                                                    if (x.style.display === "none") {
                                                        x.style.display = "block";

                                                    } else {
                                                        x.style.display = "none";
                                                        document.getElementById("button1").style.display = "block";

                                                    }
                                                }</script>

                                            <div id="myDIV" style="display:none;">
                                                {{$user->password}}
                                            </div>


                                        </td>
                                        <td>
                                            {{$user->photo}}
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
                                                    {{--<a class="dropdown-item" id="edit" href="/edit-user/{{$user->id}}" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-eye" aria-hidden="true"></i> View</a>--}}
                                                    <a class="dropdown-item" id="edit" href="/edit-user/{{$user->id}}" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
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

                                                    <form action="/delete-user/{{$user->id}}" method="POST">
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




        <script>$(document).ready( function () {
                $('#datatable').DataTable();
            } );</script>
@endsection

