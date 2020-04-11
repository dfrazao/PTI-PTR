@extends('layouts.adminbase')

@section('content')

    <div class="container" >

        <!-- Search form -->
        <div style="margin-left: 10%; margin-right:auto; margin-top: 5%;margin-bottom: 5%;">

            <h3>Edit data</h3>
        </div>

        <div class="content" style="margin-left: 10%; margin-right:auto; margin-bottom: 5%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card " style="max-width: 100%;">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <form action="/admin/edit-user-update/{{ $users->id}}" method="POST">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label >uniNumber</label>
                                    <input required="required" type="text" class="form-control" id="uniNumber" name="uniNumber" value="{{$users->uniNumber}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="student">Student</option>
                                        <option value="professor">Professor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Name</label>
                                    <input type="text" required="required" class="form-control" id="name" name="name" value="{{$users->name}}">
                                </div>
                                <div class="form-group">
                                    <label >Email address</label>
                                    <input type="email" class="form-control" required="required" id="email" name="email" value="{{$users->email}}">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label >Password</label>
                                    <input required="required" type="password" minlength="8" class="form-control" id="password" name="password" value="{{$users->password}}">
                                </div>
                                <div class="form-group">
                                    <label >Photo</label>
                                    <input type="file" class="form-control-file" id="photo" name="photo" value="{{$users->photo}}">
                                </div>
                                <div class="form-group">
                                    <label >Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{$users->description}}">
                                </div>
                                <button type="submit" class="btn btn-outline-success">Update</button>
                                <button style="float: right" href="/admin" type="button" class="btn btn-outline-danger">Cancel</button>

                            </form>

                        </div>
                </div>
            </div>
        </div>

    </div>

@endsection