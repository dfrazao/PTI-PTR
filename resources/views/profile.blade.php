@extends('layouts.app')
@section('content')
<div class="container-xl">
    <div class="container m-4">
            <div class="row">
                <div class="col-xs-12 col-sm-3 center">
                    <span class="profile-picture">
                        <img class="editable img-responsive" alt=" Avatar" id="avatar2" src="/profilePhotos/{{ $user->photo }}">
                    </span>

                    <div class="space space-4"></div>
                        @if(Auth::user()->id != $user->id)
                            <a href="#" class="btn btn-sm btn-block btn-success mt-3">
                                <i class="fas fa-envelope"></i>
                                <span>Send a message</span>
                            </a>
                        @elseif(Auth::user()->id == $user->id)
                            <a href="#" class="btn btn-sm btn-block btn-primary mt-3">
                                <i class="fas fa-portrait"></i>
                                <span>Change profile photo</span>
                            </a>
                        @endif
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-9">
                    <h1 class="float-left">
                        <span class="middle">{{ $user->name }}</span>
                    </h1>

                    <div class="container">

                        @if(Auth::user()->id == $user->id)
                            <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
                                    Edit Profile
                                </button>

                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h3 class="modal-title">Edit Profile</h3>
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="container">
                                                <form action="/action_page.php">
                                                    <div class="form-group">
                                                        <label for="country">Country:</label>
                                                        <input type="text" class="form-control" id="country" placeholder="Enter country" name="country">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City:</label>
                                                        <input type="text" class="form-control" id="city_modal" placeholder="#demo" name="city">
                                                        <script>
                                                            var myElement = document.getElementById("city");
                                                            document.getElementById("demo").innerHTML =
                                                                myElement.innerHTML;
                                                        </script>



                                                    </div>
                                                    <div class="form-group">
                                                        <label for="website">Website:</label>
                                                        <input type="text" class="form-control" id="website" placeholder="Enter website" name="website">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="about">About Me:</label>
                                                        <input type="text" class="form-control" id="about" placeholder="Enter description" name="about">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="about">Alterar fotografia:</label>
                                                        <input id="profile-image-upload" class="hidden" type="file">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="profile-user-info">

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Role </div>

                            <div class="profile-info-value">
                                <span>
                                    @if($user->role == 'student')
                                        Student
                                    @elseif($user->role == 'professor')
                                        Professor
                                    @else
                                        Admin
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> University </div>

                            <div class="profile-info-value">
                                <span>{{ $universityName }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Course </div>

                            <div class="profile-info-value">
                                <span>{{ $courseName }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Number </div>

                            <div class="profile-info-value">
                                <span>{{ $user->uniNumber }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div id="city" class="profile-info-name"> E-Mail </div>

                            <div class="profile-info-value">
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div id="city" class="profile-info-name"> City </div>

                            <div class="profile-info-value">
                                <span>{{ $user->city }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div id="city" class="profile-info-name"> Country </div>

                            <div class="profile-info-value">
                                <span>{{ $user->country }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Joined </div>

                            <div class="profile-info-value">
                                <span>{{ $user->created_at }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Last Online </div>

                            <div class="profile-info-value">
                                <span>{{ $user->updated_at }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="hr hr-8 dotted"></div>

                </div>
               <!-- /.col -->
            </div><!-- /.row -->

            <div class="space-20"></div>

            <div class="row mt-3">
                <div class="col-xs-12 col-sm-6">
                    <div class="widget-box transparent">
                            <div class="widget-header widget-header-small">
                            <h4 class="widget-title smaller">
                                Little About Me
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <p>
                                    @if(is_null($user->description) or empty($user->description))
                                        @if(Auth::user()->id != $user->id)
                                            This user doesn't have a description.
                                        @elseif(Auth::user()->id == $user->id)
                                            You don't have a description.
                                        @endif
                                    @else
                                        {{ $user->description }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /#home -->
</div>
    <style>
        .align-center, .center {
            text-align: center!important;
        }

        .profile-user-info {
            display: table;
            width: 98%;
            width: calc(100% - 24px);
            margin: 0 auto
        }

        .profile-info-row {
            display: table-row
        }

        .profile-info-name,
        .profile-info-value {
            display: table-cell;
            border-top: 1px dotted #D5E4F1
        }

        .profile-info-name {
            text-align: right;
            padding: 6px 10px 6px 4px;
            font-weight: 400;
            color: #667E99;
            background-color: transparent;
            width: 110px;
            vertical-align: middle
        }

        .profile-info-value {
            padding: 6px 4px 6px 6px
        }

        .profile-info-value>span+span:before {
            display: inline;
            content: ",";
            margin-left: 1px;
            margin-right: 3px;
            color: #666;
            border-bottom: 1px solid #FFF
        }

        .profile-info-value>span+span.editable-container:before {
            display: none
        }

        .profile-info-row:first-child .profile-info-name,
        .profile-info-row:first-child .profile-info-value {
            border-top: none
        }

        .profile-user-info-striped {
            border: 1px solid #DCEBF7
        }

        .profile-user-info-striped .profile-info-name {
            color: #336199;
            background-color: #EDF3F4;
            border-top: 1px solid #F7FBFF
        }

        .profile-user-info-striped .profile-info-value {
            border-top: 1px dotted #DCEBF7;
            padding-left: 12px
        }


    </style>

@endsection
