@extends('layouts.app')
@section('content')
    <head>
        <title>Groups</title>
    </head>
    <div class="container-fluid pl-5 pr-5 pb-2 mt-3">
        @include('layouts.messages')
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
                <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
                <li class="breadcrumb-item " aria-current="page" >{{__('gx.group creation')}} - {{$subject->subjectName}} - {{$project->name}}</li>
            </ol>
        </nav>
        <div class="container-fluid overflow-auto">
            <div style="display: flex;text-align: center;align-items: center;"><i class='far fa-lg fa-users float-left'></i><div id="timer1-{{$project->idProject}}" class="timer"></div></div>
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
                        document.getElementById("timer1-{{$project->idProject}}").innerHTML = '<div class="ml-2">Terminado</div>';
                    } else if (d==0 && h==0 && m==0) {
                        document.getElementById("timer1-{{$project->idProject}}").innerHTML = '<div>' + s + '<span>seconds</span></div>';
                    } else if (d==0) {
                        document.getElementById("timer1-{{$project->idProject}}").innerHTML =
                            '<div>' + h + '<span>hours</span></div>' +
                            '<div>' + m + '<span>minutes</span></div>' +
                            '<div>' + s + '<span>seconds</span></div>';
                    } else {
                        document.getElementById("timer1-{{$project->idProject}}").innerHTML =
                            '<div>' + d + '<span>days</span></div>' +
                            '<div>' + h + '<span>hours</span></div>' +
                            '<div>' + m + '<span>minutes</span></div>';
                    }
                }
                updateTimer1();
                setInterval('updateTimer1()', 1000);
            </script>
            <div class="table-responsive">
                <table class="table bg-white" style="text-align:center;">
                    <thead>
                    <tr>
                        <th>{{__('gx.group')}}</th>
                        <th>{{__('gx.nº elements')}}</th>
                        <th>{{__('gx.elements')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody style="overflow: auto;max-height: 20%">

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
                                    <td><button type="button" class="btn btn-danger" disabled>{{__('gx.group full')}}</button> </td>
                            @elseif(in_array($user,$studentsIdGroupValues))
                                    <td><button type="button" class="btn btn-info disabled" disabled>{{__('gx.join group')}}</button> </td>
                            @else
                                <td>
                                    @csrf
                                    {!!Form::open(['action' => ['GroupController@update', $project -> idProject], 'method' => 'POST'])!!}
                                    {!!Form::hidden('userJoin', $user)!!}
                                    {!!Form::hidden('idProject', $project->idProject)!!}
                                    {!!Form::hidden('idGroupJoin', $groupN)!!}
                                    {!!Form::hidden('_method','PUT')!!}
                                    {{Form::Submit('Join Group', ['class'=>'btn btn-info','id'=>'Join Group'])}}
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

    @if(count($subjectStudentsNoGroup)==0 or $numberGroupsInsideProject == $projectMaxGroups or in_array($user,$studentsIdGroupValues))

                    <div style="padding-left:40%;margin-bottom: 20%">
                        <button type="button" class="btn btn-primary disabled" data-toggle ="modal" style="width: 11em" >{{__('gx.create group')}} </button>
                        <button  type="button" class="btn btn-info disabled" data-toggle="modal" style="width: 11em">{{__('gx.student sugestions')}}</button>
                    </div>
    @else
                    <div style="padding-left:40%;margin-bottom: 20%">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCriarGrupo" style="width: 11em">{{__('gx.create group')}}</button>
                        <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#modalSugestaoGrupo" style="width: 11em">{{__('gx.student sugestions')}}</button>
                    </div>

    @endif


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
                        <h5 class="pb-2" style="float: left">{{__('gx.min elements')}} : {{$projectMinElements}}</h5> <br>
                        <br>
                        <h5 class="pb-2" style="float: left">{{__('gx.max elements')}} : {{$projectMaxElements}}</h5>


                    </div>


                    @csrf
                    {!! Form::open(['action' => ['GroupController@store', $project->idProject], 'method' => 'POST']) !!}
                    {!!Form::hidden('userId', $user)!!}
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>{{__('gx.name')}}</th>
                            <th>{{__('gx.student number')}}</th>
                            <th>{{__('gx.class')}}</th>
                            <th></th>

                        </tr>
                        <tbody>
                        @foreach($subjectStudentsNoGroup as $studentInfo)
                            <tr>
                                <td>{!!Form::label('nameStudent', $studentInfo->name)!!}</td>
                                <td>{!!Form::label('uniNumber', $studentInfo->uniNumber)!!}</td>
                                <td>{!!Form::label('class', $studentInfo->class)!!}</td>
                                <td>{!!Form::checkbox('idStudent[]'.$studentInfo->id, $studentInfo->id,false)!!}</td>
                                <!-- adicionar às checkboxes class="custom-control-input"-->
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    {{Form::submit('Create Group',['class'=>'btn btn-primary'],['style'=>'display: block; margin: 0 auto'])}}
                    {{Form::hidden('project', $project->idProject)}}
                    {{Form::hidden('numberGroupsInsideProject', $numberGroupsInsideProject)}}

                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('gx.cancel')}}</button>
                    {!!Form::close()!!}
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
                    <p>Sorted By Average</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <table id="datatable2" class="display">
                        <thead>
                        <tr>
                            <th>{{__('gx.name')}}</th>
                            <th>{{__('gx.student number')}}</th>
                            <th>{{__('gx.class')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjectStudentsNoGroup as $studentInfo)
                            <tr>
                                <td>{{$studentInfo->name}}</td>
                                <td>{{$studentInfo->uniNumber}}</td>
                                <td>{{$studentInfo->class}}</td>
                                <td><p><a href="#"><i class="fa fa-envelope" style="font-size: 1em"></i></a></p></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('gx.close')}}</button>
                </div>
                </div>
                </div>
            </div>
        </div>







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

    <script>$('#datatable').dataTable( {
            "columnDefs": [
                { "orderable": false, "targets": 4 }
        ]
    } );</script>


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
                "ordering": false});
    </script>


<style>
    .modal-body{
        max-height: calc(100vh - 300px);
        overflow-y: auto;
    }

    </style>


@endsection

