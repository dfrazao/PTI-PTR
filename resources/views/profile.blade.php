@extends('layout.base')
@section('content')



    <div class="container m-4">
            <div class="row">
                <div class="col-xs-12 col-sm-3 center">
							<span class="profile-picture">
								<img class="editable img-responsive" alt=" Avatar" id="avatar2" src="http://bootdey.com/img/Content/avatar/avatar6.png">
							</span>

                    <div class="space space-4"></div>

                    <a href="#" class="btn btn-sm btn-block btn-success">
                        <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                        <span class="bigger-110">Add as a friend</span>
                    </a>

                    <a href="#" class="btn btn-sm btn-block btn-primary">
                        <i class="ace-icon fa fa-envelope-o bigger-110"></i>
                        <span class="bigger-110">Send a message</span>
                    </a>
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-9">
                    <h4>
                        <span class="middle">John Doe</span>
                    </h4>

                    <div class="container">
                        <h2>Modal Scroll Example</h2>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
                            Editar Perfil
                        </button>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Editar Perfil</h3>
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

                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Username </div>

                            <div class="profile-info-value">
                                <span>alexdoe</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Country </div>

                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <span>Netherlands</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div id="city" class="profile-info-name"> City </div>

                            <div class="profile-info-value">
                                <span>Amsterdam</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Instituição </div>

                            <div class="profile-info-value">
                                <span>Faculdade de Ciências</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Age </div>

                            <div class="profile-info-value">
                                <span>38</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Joined </div>

                            <div class="profile-info-value">
                                <span>2010/06/20</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Last Online </div>

                            <div class="profile-info-value">
                                <span>3 hours ago</span>
                            </div>
                        </div>
                    </div>

                    <div class="hr hr-8 dotted"></div>

                    <div class="profile-user-info">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Website </div>

                            <div class="profile-info-value">
                                <a href="#" target="_blank">www.alexdoe.com</a>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> <i class="fa fa-facebook" aria-hidden="true"></i> </div>

                            <div class="profile-info-value">
                                <a href="#">Find me on Facebook</a>

                            </div>
                        </div>


                        <div class="profile-info-row">
                            <div class="profile-info-name">
                                <i class="middle ace-icon fa fa-twitter-square bigger-150 light-blue"></i>
                            </div>

                            <div class="profile-info-value">
                                <a href="#">Follow me on Twitter</a>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- /.col -->
            </div><!-- /.row -->

            <div class="space-20"></div>

            <div class="row">
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
                                    My job is mostly lorem ipsuming and dolor sit ameting as long as consectetur adipiscing elit.
                                </p>
                                <p>
                                    Sometimes quisque commodo massa gets in the way and sed ipsum porttitor facilisis.
                                </p>
                                <p>
                                    The best thing about my job is that vestibulum id ligula porta felis euismod and nullam quis risus eget urna mollis ornare.
                                </p>
                                <p>
                                    Thanks for visiting my profile.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /#home -->

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
