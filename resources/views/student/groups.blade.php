@extends('layouts.app')
@section('content')
    <head>
        <title>{{__('gx.groups')}}</title>
    </head>
    <body onload="sortTable()">
    <div class="container-fluid pl-4 pr-4 pb-2 mt-3">
        @include('layouts.messages')
        <nav id="breadcrumb" aria-label="breadcrumb" >
            <ol id="breadcrumb" class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
                <li id="bc1" class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
                <li id="bc2" class="breadcrumb-item " aria-current="page" >{{__('gx.group creation')}} - {{$subject->subjectName}} - {{$project->name}}</li>
            </ol>
            <div style="padding-right: 5%"><div id="creation_deadline" class="countdown" style="float:right "><i class="far fa-lg fa-users"></i> <div id="timer1" class="timer"> </div></div></div>
        </nav>

        <br>

    </div>
        <br>
        <style>
            @media screen and (max-width: 750px){
                #breadcrumb {
                    font-size: 3vh;
                    margin:0 auto;
                    list-style:none;
                }
                #bc1 {
                    margin-left: 33%;
                }
                #bc2 {
                    margin-left: 10%; !important;
                }
            }
        </style>
    <div container-xl-fluid mt-4 pl-5 pr-5 pb-2 rounded style="padding-right:5%;padding-left: 5%;padding-bottom: 1%">
        <div class="container-xl-fluid mt-4 pl-5 pr-5 pb-2 rounded " style="background-color: #ededed;padding-left: 10%;padding-right: 10%;">

            <style>
                #creation_deadline{
                    display: flex;
                    text-align: center;
                    align-items: center;
                    justify-content: center;"
                }
                @media screen and (max-width: 750px) {
                    #creation_deadline {
                        display: block;
                    }
                }
            </style>

            <script>
                function sortTable() {
                    var table, i, x, y;
                    table = document.getElementById("tabelagrupos");
                    var switching = true;

                    // Run loop until no switching is needed
                    while (switching) {
                        switching = false;
                        var rows = table.rows;

                        // Loop to go through all rows
                        for (i = 1; i < (rows.length - 1); i++) {
                            var Switch = false;

                            // Fetch 2 elements that need to be compared
                            x = rows[i].getElementsByTagName("TD")[0];
                            y = rows[i + 1].getElementsByTagName("TD")[0];

                            // Check if 2 rows need to be switched
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase())
                            {

                                // If yes, mark Switch as needed and break loop
                                Switch = true;
                                break;
                            }
                        }
                        if (Switch) {
                            // Function to switch rows and mark switch as completed
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                }

            </script>

            <script>
                function updateTimer1() {
                    future = Date.parse("{{$project->groupCreationDueDate}}");
                    now = new Date();
                    diff = future - now;

                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60));
                    mins = Math.floor(diff / (1000 * 60));
                    secs = Math.floor(diff / 1000);

                    d = days;
                    h = hours - days * 24;
                    m = mins - hours * 60;
                    s = secs - mins * 60;

                    if (d<0 || (d==0 && h==0 && m==0 && s==0)) {
                        document.getElementById("timer1").innerHTML = '<div id="finishes" class="ml-2">{{__('gx.finished')}}</div>';
                    }
                    else if (d==0 && h==0 && m==0) {
                        document.getElementById("timer1").innerHTML = '<div>' + s + '<span>{{__('gx.seconds')}}</span></div>';
                    } else if (d==0) {
                        document.getElementById("timer1").innerHTML =
                            '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                            '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>' +
                            '<div>' + s + '<span>{{__('gx.seconds')}}</span></div>';
                    } else {
                        document.getElementById("timer1").innerHTML =
                            '<div>' + d + '<span>{{__('gx.days')}}</span></div>' +
                            '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                            '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>';
                    }
                }

                updateTimer1();
                setInterval('updateTimer1()', 1000);
            </script>

            <script>
                 function updateTimer2() {
                    future = Date.parse("{{$project->groupCreationDueDate}}");
                    now = new Date();
                    diff = future - now;

                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60));
                    mins = Math.floor(diff / (1000 * 60));
                    secs = Math.floor(diff / 1000);

                    d = days;
                    h = hours - days * 24;
                    m = mins - hours * 60;
                    s = secs - mins * 60;

                    if (d<0 || (d==0 && h==0 && m==0 && s==0)) {
                        return true
                    }
                    else{
                        return false
                    }
                }

            </script>

            <br>
            <div class="table-responsive rounded" >
                <table  class="table bg-white table-striped" id="tabelagrupos">
                    <thead>
                    <tr id="table_groups">
                        <th class="text-center">{{__('gx.group')}}</th>
                        <th class="text-center">{{__('gx.nº elements')}}</th>
                        <th class="text-center">{{__('gx.elements')}}</th>
                        <th ></th>
                    </tr>
                    </thead>
                    <style>
                        #table_groups{
                            font-size: 1.8vh;
                        }
                    </style>
                    <tbody class="t-body" style="text-align: center">

                    @if(count($groupNumber) > 0)
                        @foreach($groupNumber as $groupN)
                            <tr>
                                <td>
                                    {{$students_per_group[$groupN][0]->idGroupProject }}
                                </td>
                                <td>
                                    {{count($students_per_group[$groupN])}}/{{$projectMaxElements}}</td>
                                <td>
                                    @foreach($students_per_group[$groupN] as $studInfo)
                                        <a href="/profile/{{$studInfo->id }}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$studInfo->photo)}}"><span style="vertical-align: middle;"> {{$studInfo->name}}</span></a>


                                @endforeach


                                @if(count($students_per_group[$groupN]) == $projectMaxElements)
                                    <td><button type="button" class="btn btn-danger" style="width: 12em" disabled><i class="fas fa-ban"></i> {{__('gx.group full')}}</button> </td>
                                @elseif(in_array($user,$studentsIdGroupValues))
                                    <td><button type="button" class="btn btn-primary disabled" style="width: 12em" disabled> <i class="fas fa-sign-in-alt"></i> {{__('gx.join group')}}</button> </td>
                                @else
                                    <td>
                                        @csrf
                                        {!!Form::open(['action' => ['GroupController@update', $project -> idProject], 'method' => 'POST'])!!}
                                        {!!Form::hidden('userJoin', $user)!!}
                                        {!!Form::hidden('idProject', $project->idProject)!!}
                                        {!!Form::hidden('idGroupJoin', $groupN)!!}
                                        {!!Form::hidden('_method','PUT')!!}
                                        {{Form::button('<i class="fas fa-sign-in-alt"></i> '.trans('gx.join group'),['type' => 'submit','class'=>'btn btn-primary btn_joinGroup'],['style'=>'width: 12em'])}}

                                        {!!Form::close()!!}
                                    </td>

                            </tr>

                            @endif
                        @endforeach
                    @else

                        <tr>

                            <td colspan="4"><h5>{{__('gx.no groups found')}}</h5></td>
                        </tr>
                    @endif


                    </tbody>
                </table>
            </div>

            <br>
            <br>
            @if(count($subjectStudentsNoGroup)==0 or $numberGroupsInsideProject == $projectMaxGroups or in_array($user,$studentsIdGroupValues) )

                <div style="padding-left:40%;margin-bottom: 20%">
                    <button type="button" class="btn btn-success disabled " data-toggle ="modal" style="width: 11em" ><i class="fas fa-plus-circle"></i> {{__('gx.create group')}} </button>
                    <button  type="button" id="btn2" class="btn btn-primary disabled" data-toggle="modal" style="width: 11em"><i class="far fa-user-graduate"></i>{{__('gx.student sugestions')}}</button>
                </div>
            @else
                <div style="padding-left:40%;margin-bottom: 20%">
                    <button id="btn_criargrupo" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCriarGrupo" style="width: 12em"><i class="fas fa-plus-circle"></i> {{__('gx.create group')}}</button>
                    <button id="btn_sugestoes" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSugestaoGrupo" style="width: 12em"><i class="fas fa-user-graduate"></i> {{__('gx.student sugestions')}}</button>
                </div>

            @endif
            <script>
                if (updateTimer2()){
                    document.getElementById("btn_criargrupo").disabled = true;
                    document.getElementById("btn_sugestoes").disabled = true;
                    var elems = document.getElementsByClassName("btn_joinGroup");
                    for(var i = 0; i < elems.length; i++) {
                        elems[i].disabled = true;
                    }
                }
            </script>


            <style>
                @media screen and (max-width: 750px){
                    #btn_criargrupo {
                        margin-bottom: 2%;
                    }
                }
            </style>

            <div id="modalCriarGrupo"  class="modal" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">{{__('gx.group creation')}}</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body" style="display: inline"  >

                            <div>
                                <h4 class="pb-2" style="float: left" >{{__('gx.group elements')}} : <span id="members" class="rounded">1</span>/{{$projectMaxElements}}</h4> <br>
                            </div>


                            @csrf
                            {!! Form::open(['action' => ['GroupController@store', $project->idProject], 'method' => 'POST']) !!}
                            {!!Form::hidden('userId', $user)!!}
                            <br>
                            <!--<h6 style="padding-top: 2%">Sel</h6>-->
                            <table id="datatable" class="display">
                                <thead>
                                <tr style="font-size: 1.3vh">
                                    <th>{{__('gx.name')}}</th>
                                    <th>{{__('gx.student number')}}</th>
                                    <th>{{__('gx.class')}}</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>

                                <tbody class="t-body">
                                @foreach($subjectStudentsNoGroup as $studentInfo)
                                    <tr style="font-size: 1.3vh">
                                        <td>{!!Form::label('nameStudent', $studentInfo->name)!!}</td>
                                        <td>{!!Form::label('uniNumber', $studentInfo->uniNumber)!!}</td>
                                        <td>{!!Form::label('class', $studentInfo->class)!!}</td>
                                        <td><p><a onclick='chat()' data-dismiss="modal"><i class="far fa-envelope" style="font-size: 1.5em;padding-top:10%;cursor: pointer;"></i></a></p></td>
                                        <td style="cursor: pointer">{!!Form::checkbox('idStudent[]'.$studentInfo->id, $studentInfo->id,false,['onClick' => 'countCheck()'])!!}</td>

                                        <script>
                                            function chat() {
                                                var x = document.getElementById("este");
                                                if (x.style.display === "block") {
                                                    x.style.display = "none";
                                                } else {
                                                    x.style.display = "block";
                                                }
                                            }
                                        </script>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> {{__('gx.cancel')}}</button>

                            {{Form::button('<i class="fas fa-plus-circle"></i> ' . trans('gx.create group'),['type' => 'submit','class'=>'btn btn-success'],['style'=>'display: block; margin: 0 auto'])}}
                            {{Form::hidden('project', $project->idProject)}}
                            {{Form::hidden('numberGroupsInsideProject', $numberGroupsInsideProject)}}


                            {!!Form::close()!!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
        <div id="modalSugestaoGrupo" class="modal" tabindex="-1" role="dialog"  >
            <div class="modal-dialog modal-xl" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <h2 class="modal-title">{{__('gx.student sugestions')}}</h2>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="display: inline" >
                        <h5>{{__('gx.sorted by average')}}</h5>
                        <table id="datatable2" class="display rounded">
                            <thead >
                            <tr style="font-size: 1.3vh">
                                <th>{{__('gx.name')}}</th>
                                <th>{{__('gx.student number')}}</th>
                                <th>{{__('gx.class')}}</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="t-body">
                            @foreach($stdSugestWGrade as $studentInfo)
                                <tr style="font-size: 1.3vh">
                                    <td>{{$studentInfo->name}}</td>
                                    <td>{{$studentInfo->uniNumber}}</td>
                                    <td>{{$studentInfo->class}}</td>
                                    <td></td>
                                    <td><p><a onclick='chat()' data-dismiss="modal"><i class="far fa-envelope" style="font-size: 1.5em;padding-top:10%;cursor: pointer;"></i></a></p></td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> {{__('gx.close')}}</button>
                    </div>
                </div>
            </div>
        </div>







    <script>
        function chat() {
            var x = document.getElementById("testee");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>

    <script>
        function countCheck() {
            var numberOfChecked = $('input:checkbox:checked').length;
            var aTag = document.getElementById('members');
            aTag.style.background = 'rgba(245, 229, 27, 0.5)';

            aTag.innerHTML = numberOfChecked+1;

        }
    </script>


    <script>
        var $checkboxes = $('input[type=checkbox]');
        //var numElements = {!! json_encode($projectMaxElements) !!};
        $checkboxes.change(function () {
            if (this.checked) {
                if ($checkboxes.filter(':checked').length == {{$projectMaxElements}}-1) {
                    $checkboxes.not(':checked').prop('disabled', true);
                }
            } else {
                $checkboxes.prop('disabled', false);
            }
        });
    </script>


    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

    <script>$(document).ready( function () {
            $('#datatable').DataTable();
        } );</script>

    <script>
        $('#example').DataTable( {
            fixedHeader: true
    } );
    </script>
    <script>
        $('#datatable').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "ordering": false});
    </script>


    <script>$(document).ready( function () {
            $('#datatable2').DataTable();
        } );</script>



    <script>
        $('#datatable2').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "ordering": false,
            "language": {
                "emptyTable": "No data available in table"
            }
        });
    </script>

    <script>$(document).ready( function () {
            $('#datatable2').DataTable();
        });
    </script>







    <style>
        input[type=checkbox]
        {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
            transform: scale(1.5);
            padding: 5%;
            cursor: pointer;
        }
        .modal-body{
            max-height: calc(100vh - 300px);

        }
        table{

        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
           /* even columns width , fix width of table too*/
        }

        .t-body{
            max-height: calc(100vh - 500px);
            overflow-y: auto;
            display:block;

        }
        .t-body2{
            max-height: calc(100vh - 400px);
            overflow-y: auto;
            display:block;

        }

        #timer1 {
            font-size: 2vh;
            font-weight: 100;
            color: navy;
        }


        #timer1 div {
            display: inline-block;
            min-width: 45px;
        }

        #timer1 div span {
            color: black;
            display: block;
            font-size: .50em;
            font-weight: 400;
        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #E2E4FF; // Choose your own color here
        }

        .table-striped>tbody>tr:nth-child(even)>td,
        .table-striped>tbody>tr:nth-child(even)>th {
            background-color: #f5f8ff; // Choose your own color here
        }
    </style>
    </body>
@endsection

