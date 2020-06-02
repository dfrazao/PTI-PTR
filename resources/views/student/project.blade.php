@extends('layouts.app')
@section('content')
<head>
    <title>Project</title>
</head>
<div class="container-fluid pl-4 pr-4 pb-2 mt-3">
    @include('layouts.messages')
    <nav id="breadcrumb" aria-label="breadcrumb" >
        <ol id="breadcrumb" class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
            <li id="bc1" class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
            <li id="bc2" class="breadcrumb-item " aria-current="page" >{{$subject->subjectName}} - {{$project->name}}</li>
        </ol>
    </nav>
    <style>
        /*#btn_leave{
            width: 11em
        }*/
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
            /*#btn_leave {
                width: 3em;
                font-size: 1.25vh;
                padding-right: 6.5vh;
                padding-left: 4vh;
            }*/
        }
    </style>

        {{--<div id="toggle_menu" class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myTab">
                <span ><i class="fa fa-align-justify"></i></span>
            </button>
        </div>
        <div id="toggle_menu" class="navbar-collapse collapse" id="myTab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="false">{{__('gx.content')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">{{__('gx.schedule')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">{{__('gx.forum')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="submission-tab" data-toggle="tab" href="#submission" role="tab" aria-controls="submission" aria-selected="false">{{__('gx.submission')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalLeaveGroup" style="width: 11em">{{__('gx.leave group')}}</button>
                </li>
            </ul>
            <style>
                @media screen and (min-width: 500px){
                    #toggle_menu{display: none}
                }
            </style>
        </div>--}}

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="false">{{__('gx.content')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">{{__('gx.schedule')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">{{__('gx.forum')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="submission-tab" data-toggle="tab" href="#submission" role="tab" aria-controls="submission" aria-selected="false">{{__('gx.submission')}}</a>
        </li>
        <li class="rightbutton ml-auto">
            <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalLeaveGroup" style="width: 11em">{{__('gx.leave group')}}</button>
            <div id="modalLeaveGroup" class="modal" tabindex="-1" role="dialog"  >
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content" >
                        <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <h5>Are you sure you want to leave the group?</h5>

                        </div>
                        <div class="modal-footer">
                            {!!Form::open(['action' => ['GroupController@destroy', $project -> idProject] , 'method' => 'POST']) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {!!Form::hidden('idGroup', $idGroup) !!}
                            {{Form::submit(trans('gx.leave group'),['class' => 'btn btn-info'])}}
                            {!!Form::close() !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('gx.cancel')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="tab-content pb-3 " id="myTabContent" style="min-height: 75vh; background-color: #ededed;">
        <div class="container-fluid fade tab-pane  ml-0 mr-0" id="content" role="tabpanel" aria-labelledby="content-tab">
            <div id="row1" class="row rounded">
                <style>
                    #row1{
                        height: 80vh;
                    }
                    @media screen and (max-width: 1300px) {
                        #row1 {
                            height: 60vh;
                        }
                    }
                        @media screen and (max-width: 700px) {
                            #row1 {
                                height: 60vh;
                            }
                        }
                        @media screen and (max-width: 500px) {
                            #row1 {
                                height: 90vh;
                            }
                        }

                </style>
                <div id="1col" class="col-md-4 mt-3 rounded" style="padding-bottom:10px; background-color: #c6c6c6; position: relative;">
                    <div class="container-fluid mt-3 pr-0 pl-3" style="height: 90%;">
                        @foreach($rep as $file)
                            <div class="file text-center" id= '{{$file->idFile}}' style="margin-right: 15px; position:relative; display: inline-block; width: 100px;">
                                <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="position:absolute; top:-10px; right:17px;" id= '{{$file->idFile}}' class="close downloadFile" download>
                                    <span class="dot" id="download" style="position:relative">
                                        <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                    </span>
                                </a>
                                <button style="position:absolute; top:-10px; right:-10px;" id= '{{$file->idFile}}' type="button" class="close deleteFile">
                                    <span class="dot" id="delete" style="position:relative">
                                        <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                    </span>
                                </button>
                                <figure>
                                    <i class="fas fa-folder fa-4x px-2" style="color: #ffce52;"></i>
                                    <figcaption>{{$file->pathFile}}</figcaption>
                                </figure>
                            </div>
                        @endforeach
                            <div id="dropzone" class="text-center" style="margin-right: 10px; position:relative; display: inline-block;">
                                {!!Form::open(['action' => ['StudentProjectsController@store', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data','files' => true, 'class' => "dropzone", 'id'=>"dropzone"])!!}
                                @csrf
                                <figure style="z-index: -1;">
                                    <i class="fal fa-file-plus fa-3x px-2 dz-message" style="margin-bottom: 0px;margin-top: 0px;"></i>
                                    <figcaption style="margin:0;">Drop or click to upload</figcaption>
                                </figure>
                                <script type="text/javascript">
                                    Dropzone.options.dropzone = {
                                        maxFilesize: 1,
                                        acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.zip,.docx,.txt,.py,.html,.css,.js",
                                        init: function () {
                                            // Set up any event handlers
                                            this.on('complete', function () {
                                                location.reload();

                                            });
                                        },
                                    };
                                </script>
                                {{ Form::hidden('group', $idGroup) }}
                                {{ Form::hidden('project', $project->idProject) }}
                                {{ Form::hidden('subject', $subject->subjectName) }}
                                {{Form::hidden('submission','newFile')}}

                                {!!Form::close()!!}
                            </div>
                        <button type="submit" disabled class="btn btn-sm mb-2 mr-2" id= 'submitFile' data-toggle="modal" data-target="#modalSubmitFile" style="width:20vh;background: #2c3fb1; color: white; position: absolute; bottom: 0px; right: 0px;">Submit</button>


                        {{-- Modal Submit File --}}
                        <div class="modal fade" id="modalSubmitFile" aria-labelledby="modalSubmitFile" aria-hidden="true" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">Submit file to evaluation</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Are you sure you want to submit this file?</h5>
                                        {!!Form::open(['action' => ['StudentProjectsController@update', $project->idProject], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])!!}
                                        <div class="filesSelected" style="padding:10px;"></div>
                                        {{ Form::hidden('filesSubmit', 'files') }}
                                        {{ Form::hidden('group', $idGroup) }}
                                        {{ Form::hidden('project', $project->idProject) }}
                                        {{ Form::hidden('subject', $subject->subjectName) }}
                                        {{ Form::hidden('submission','submitFile')}}
                                        {{ Form::submit('Submit', ['class'=>'btn btn-primary'])}}

                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="2col" style="padding-left:30px;" class="col-md-4 mt-3 rounded">
                    <div class="row h-50">
                        <div id="col_groups" class="container-fluid rounded text-center pt-2 pb-2" style="background-color: #c6c6c6;">
                            <h5>{{__('gx.group elements')}}</h5>
                            <div>
                                @foreach($groupUsers as $user)
                                    <img class="profilePhoto pr-2" style="padding-bottom:5px; border-radius: 100%; width: 13%; height: 13%; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}">
                                    <a href="/profile/{{$user->id}}">{{$user->name}} - {{$user->uniNumber}}</a>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row h-50 rounded pt-3">
                        <div id="col_docs" class="container-fluid rounded text-center pt-2" style="background-color: #c6c6c6; ">
                            <h5>{{__('gx.documentation')}} </h5>
                            <div>{{__('gx.files')}}:
                            @foreach($docs as $d)
                                <a rel="noopener noreferrer" target="_blank" href ="{{Storage::url('documentation/'.$project->idProject.'/'.$d->pathFile)}}">{{$d->pathFile}}</a>
                            @endforeach
                            </div>
                            <div>{{__('gx.deadline')}}: {{$project->dueDate}}</div>



                        </div>
                    </div>
                    <style>
                        @media screen and (max-width: 500px) {
                            #col_docs {
                                margin-top: 20px;
                                margin-right: 15px;
                            }
                            #col_groups{
                                margin-right: 15px;
                            }
                        }
                    </style>
                </div>
                <div id="3col"  class="col-md-4 mt-3">
                    <div class="container-fluid rounded notes h-100 pt-2" style="background-color: #ffe680; " >
                        <h5 class="text-center">{{__('gx.notes')}}</h5>
                        {!! Form::open(['action' => ['StudentProjectsController@store', $project -> idProject], 'method' => 'POST', 'id'=>'myform']) !!}
                        @csrf
                        {{Form::textarea('notes', $notes, ['class' => 'form-control', 'id'=>'textArea', 'rows'=>'10'])}}
                        {{Form::hidden('group',$idGroup)}}
                        {{Form::hidden('submission','notes')}}
                        {{Form::submit('Submit', ['class'=>'btn btn-primary d-none', 'id'=>'notesButton'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div id="row2" class="row rounded">
                <div class="container-fluid rounded mx-3 mt-3 p-2" style="background-color: #c6c6c6; position: relative;">
                    <div class="form-group mb-0">
                        <div class="table-fixed">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr class="tasks_letra">
                                    <th>{{__('gx.task')}}</th>
                                    <th>{{__('gx.responsible')}}</th>
                                    <th id="task_b">{{__('gx.beginning')}}</th>
                                    <th id="task_e">{{__('gx.end')}}</th>
                                    <th>{{__('gx.wasted time')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($tasks)>0)
                                    @foreach($tasks as $t)
                                        <tr class="abcd" id="{{$t -> idTask}}-show">
                                            <td>{{$t->description}}</td>
                                            <td>{{$t->responsible}}</td>
                                            <td id="task_b">{{$t->beginning}}</td>
                                            <td id="task_e">{{$t->end}}</td>
                                            <td>{{$t->duration}}</td>
                                            <td class="float-right pr-0"><button id="edit_tasks"  type="button" class="btn btn-sm btn-success editTask mr-md-2">{{__('gx.edit')}}</button><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete-{{$t->idTask}}">{{__('gx.delete')}}</button></td>
                                        </tr>
                                        <tr class="d-none" id="{{$t->idTask}}-edit">
                                            @csrf
                                            {!!Form::open(['action' => ['StudentProjectsController@update', $project -> idProject], 'method' => 'POST'])!!}
                                                <td class="form-group">
                                                    {{Form::text('description', $t->description, ['class' => 'form-control'])}}
                                                </td>
                                                <td class="form-group">
                                                    <select class="form-control " name="responsible" id="responsible">
                                                        @foreach($groupUsers as $gu)
                                                            <option value="{{$gu->name}}">{{$gu->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="form-group" style="position:relative">
                                                    {{ Form::text('beginning', $t->beginning ,['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker1-'.$t->idTask, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker1-'.$t->idTask])}}
                                                </td>
                                                <td class="form-group" style="position:relative">
                                                    {{ Form::text('end', $t->end ,['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker2-'.$t->idTask, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker2-'.$t->idTask])}}
                                                </td>
                                                <td class="form-group"></td>
                                                {{Form::hidden('submission', 'task')}}
                                                {{Form::hidden('task', $t->idTask) }}
                                                {{Form::hidden('group', $t-> idGroup)}}
                                                {{Form::hidden('_method','PUT')}}

                                                <td class="form-group float-right pr-0">{{Form::Submit('Save', ['class'=>'btn btn-sm mr-2 btn-success', 'style'=>"width: 10vh", 'id'=>'Save'])}}<button type="button" class="btn btn-sm btn-danger editTask">{{__('gx.cancel')}}</button></td>
                                            {!! Form::close() !!}
                                            <script>
                                                $(function() {$( "#datetimepicker1-{{$t->idTask}}" ).datetimepicker({
                                                    minDate: moment('{{(\Carbon\Carbon::now())}}').format('YYYY-MM-DD HH:mm:ss'),
                                                    //date: moment('{{(\Carbon\Carbon::parse($t->beginning))}}').format('YYYY-MM-DD HH:mm'),
                                                    locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                                                    icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"},
                                                    default: moment('{{(\Carbon\Carbon::parse($t->beginning))}}').format('YYYY-MM-DD HH:mm:ss')
                                                });});
                                                $(function() {$( "#datetimepicker2-{{$t->idTask}}" ).datetimepicker({
                                                    minDate: moment('{{(\Carbon\Carbon::parse($t->end))}}').format('YYYY-MM-DD HH:mm'),
                                                    date: moment('{{(\Carbon\Carbon::parse($t->end))}}').format('YYYY-MM-DD HH:mm'),
                                                    locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                                                    icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                                                });});
                                                $("#datetimepicker1-{{$t->idTask}}").on("change.datetimepicker", function (e) {
                                                    $('#datetimepicker2-{{$t->idTask}}').datetimepicker('minDate', e.date);
                                                });
                                            </script>
                                        </tr>
                                        {{-- Modal Delete Task --}}
                                        <div class="modal fade" id="modalDelete-{{$t->idTask}}" aria-labelledby="modalDelete-{{$t->idTask}}" aria-hidden="true" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.delete task')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>{{__('gx.are you sure you want to delete this task?')}}</h5>
                                                        {!!Form::open(['action' => ['StudentProjectsController@destroy', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                        {{Form::hidden('_method', 'DELETE')}}
                                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                        {{Form::hidden('submission','task')}}
                                                        {{Form::hidden('task', $t->idTask) }}
                                                        {!!Form::close()!!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"><h5>{{__('gx.your group has no tasks.')}}</h5></td>
                                    </tr>
                                @endif
                                </tbody>
                                <style>
                                    #edit_tasks{
                                        width: 10vh;
                                    }
                                    @media screen and (max-width: 500px) {
                                        #edit_tasks{
                                            margin-bottom: 5px;
                                        }
                                        #row2{
                                            margin-top:15%;
                                        }
                                        .table{}
                                    }
                                    @media screen and (max-width: 800px) {
                                        #edit_tasks{
                                            width: 5vh;
                                        }
                                        .abcd{
                                            font-size: 1.5vh;
                                        }
                                        .tasks_letra {
                                            font-size: 1.2vh;
                                        }
                                        #task_b {
                                            display: none;
                                        }
                                        #task_e {
                                            display: none;
                                        }

                                    }
                                    @media screen and (max-width: 1100px) {
                                        #edit_tasks{
                                            width: 5vh;
                                        }
                                    }
                                </style>
                            </table>
                        </div>
                        <div class="container-fluid pt-3 mr-2" style="position: relative">
                            <button type="button" class="btn btn-sm open_modal" id="{{$idGroup}}" style="width:20vh;background: #2c3fb1; color: white;position: absolute; bottom: 0px; right: 0px;">{{__('gx.new task')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Delete file --}}
        <div class="modal fade" id="modalDeleteFile" aria-labelledby="modalDeleteFile" aria-hidden="true" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Delete file</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure you want to delete this file?</h5>
                        {!!Form::open(['action' => ['StudentProjectsController@destroy', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {{ Form::hidden('group', $idGroup) }}
                        {{Form::hidden('submission','file')}}
                        {{Form::hidden('idFile','')}}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Create Task --}}
        <div class="modal fade" id="modalCreateTask" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.new task')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['action' => 'StudentProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::label('description', 'Title')}}
                            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Task title'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('responsible', 'Responsible')}}
                            <select class="form-control " name="responsible" id="responsible">
                                @foreach($groupUsers as $gu)
                                    <option value="{{$gu->name}}">{{$gu->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <td class="form-group">
                            {{Form::label('beginnig', 'Beginning Date')}}
                            {{ Form::text('beginning','',['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker', 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker'])}}
                        </td>
                        {{ Form::hidden('group', $idGroup) }}
                        {{ Form::hidden('project', $project->idProject) }}
                        {{ Form::hidden('subject', $subject->subjectName) }}
                        {{Form::hidden('submission','task')}}

                        {{Form::submit('Submit', ['class'=>'btn btn-primary mt-2'])}}

                        {!! Form::close() !!}
                    </div>
                    <script>
                        $(function() {$( "#datetimepicker" ).datetimepicker({
                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                            date: moment().format('YYYY-MM-DD HH:mm'),
                            locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                        });});
                    </script>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab" style=" position: relative">
            <h5 id="titulo_groups" class="pt-2 text-center">{{__('gx.group elements weekly availability')}}</h5>
            {!! Form::open(['action' => ['StudentProjectsController@store', $project -> idProject], 'method' => 'POST', 'id' => 'scheduleform']) !!}
            @csrf
            <style>
                @media screen and (max-width: 750px){
                    #titulo_groups{
                        font-size: 2vh;
                    }
                }
            </style>
            <div class="grid-container">
                {{--<div></div>
                <div>{{__('gx.monday+')}}</div>
                <div>{{__('gx.tuesday+')}}</div>
                <div>{{__('gx.wednesday+')}}</div>
                <div>{{__('gx.thursday+')}}</div>
                <div>{{__('gx.friday+')}}</div>
                <div>{{__('gx.saturday+')}}</div>
                <div>{{__('gx.sunday+')}}</div>--}}
                <div></div>
                <div>
                    <span class="full-text">{{__('gx.monday+')}}</span>
                    <span class="short-text">Mon</span>
                </div>
                <div>
                    <span class="full-text">{{__('gx.tuesday+')}}</span>
                    <span class="short-text">Tue</span>
                </div>
                <div>
                    <span class="full-text">{{__('gx.wednesday+')}}</span>
                    <span class="short-text">Wed</span>
                </div>
                <div>
                    <span class="full-text">{{__('gx.thursday+')}}</span>
                    <span class="short-text">Thu</span>
                </div>
                <div>
                    <span class="full-text">{{__('gx.friday+')}}</span>
                    <span class="short-text">Fri</span>
                </div>
                <div>
                    <span class="full-text">{{__('gx.saturday+')}}</span>
                    <span class="short-text">Sat</span>
                </div>
                <div>
                    <span class="full-text">{{__('gx.sunday+')}}</span>
                    <span class="short-text">Sun</span>
                </div>
                <div style="border: 1px solid black;">8:00h-9:00h</div>
                <div class="cell" id="1x1" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="1x2" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="1x3" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="1x4" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="1x5" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="1x6" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="1x7" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">9:00h-10:00h</div>
                <div class="cell" id="2x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="2x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="2x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="2x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="2x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="2x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="2x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">10:00h-11:00h</div>
                <div class="cell" id="3x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="3x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="3x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="3x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="3x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="3x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="3x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">11:00h-12:00h</div>
                <div class="cell" id="4x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="4x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="4x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="4x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="4x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="4x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="4x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">12:00h-13:00h</div>
                <div class="cell" id="5x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="5x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="5x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="5x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="5x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="5x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="5x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">13:00h-14:00h</div>
                <div class="cell" id="6x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="6x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="6x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="6x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="6x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="6x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="6x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">14:00h-15:00h</div>
                <div class="cell" id="7x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="7x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="7x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="7x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="7x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="7x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="7x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">15:00h-16:00h</div>
                <div class="cell" id="8x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="8x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="8x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="8x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="8x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="8x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="8x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">16:00h-17:00h</div>
                <div class="cell" id="9x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="9x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="9x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="9x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="9x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="9x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="9x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">17:00h-18:00h</div>
                <div class="cell" id="10x1" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="10x2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="10x3" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="10x4" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="10x5" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="10x6" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div class="cell" id="10x7" style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
            </div>
            {{Form::hidden('group',$idGroup)}}
            {{Form::hidden('submission','schedule')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary d-none'])}}
            {!! Form::close() !!}
            <style>
                .short-text { display: none; }


                @media (max-width: 800px) {
                    .short-text { display: inline-block; }
                    .full-text { display: none; }
                }
            </style>

            <div class="container p-3">
                <div class="row">
                    @foreach($groupUsers as $user)
                        <div class="col-xs-3 mx-auto">
                            {{$user->name}}
                            <div class="border Mastercolor align-middle" id="{{$user->id}}"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container-fluid rounded text-center pt-2 h-100 px-0">
                <h5 class="pt-2">{{__('gx.meetings')}}</h5>
                <div class="table-fixed">
                    <table class="table table-hover text-center">
                        <thead>
                        <tr>
                            <th>{{__('gx.number')}}</th>
                            <th>{{__('gx.description')}}</th>
                            <th>{{__('gx.date')}}</th>
                            <th>{{__('gx.place')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($meeting)>0)
                            @foreach($meeting as $m)
                                <tr>
                                    <td id="meeting">{{$m->idMeeting}}</td>
                                    <td id="meeting">{{$m->description}}</td>
                                    <td id="meeting">{{$m->date}}</td>
                                    <td id="meeting">{{$m->place}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4"><h5>{{__('gx.your group has no meetings.')}}</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div id="wrapper" class="container-fluid pt-3 " style="position: relative">
                    <button type="submit" class="btn btn-sm mr-2" id="newMeeting" data-toggle="modal" data-target="#modalCreateMeeting">{{__('gx.new meeting')}}</button>
                </div>
            </div>
        </div>

        <style>
            #newMeeting{
                position: absolute;
                width: 20vh;
                background: #2c3fb1;
                color: white;
                bottom: 0px;
                right: 0px;
            }

            @media screen and (max-width: 800px){
                #meeting{
                    font-size: 1.5vh;
                }
            }

                </style>
                <div class="container-fluid pt-3 " style="position: relative">
                    <button type="submit" class="btn btn-sm mr-2" id= 'newMeeting' data-toggle="modal" data-target="#modalCreateMeeting" style="position: absolute; width: 20vh;background: #2c3fb1; color: white;bottom: 0px; right: 0px;">{{__('gx.new meeting')}}</button>
                </div>
            </div>
        </div>
        {{-- Modal Create Meeting --}}
        <div class="modal fade" id="modalCreateMeeting" aria-labelledby="modalCreateMeeting" aria-hidden="true" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.create new meeting')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!!Form::open(['action' => ['StudentProjectsController@store', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                        <div class="form-group">
                            {{Form::label('description', trans('gx.meeting description'))}}
                            {{Form::text('description', '', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('place', 'Meeting place')}}
                            {{Form::text('place', '', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('date', 'Meeting date')}}
                            {{Form::text('date', '',['class' => 'form-control datetimepicker-input', 'id' => 'datetimepickerMeeting', 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepickerMeeting'])}}
                        </div>
                        {{ Form::hidden('group', $idGroup) }}
                        {{ Form::hidden('project', $project->idProject) }}
                        {{ Form::hidden('subject', $subject->subjectName) }}
                        {{Form::hidden('submission','meeting')}}
                        {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary'])}}

                        {!!Form::close()!!}
                    </div>
                    <script>
                        $(function() {$( "#datetimepickerMeeting" ).datetimepicker({
                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                            date: moment().format('YYYY-MM-DD HH:mm'),
                            locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                        });});
                    </script>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <button type="button" class="p-2 mt-3 mr-3 btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCreatePost" style="background-color: #2c3fb1; border-color: #2c3fb1;">{{__('gx.create post')}}</button>

            <div class="container rounded pb-3 pt-3">
                <div class="table-responsive-xl pt-2">
                    <table class="table bg-white rounded" style="text-align:center;">
                        <thead>
                        <tr class="forum_table">
                            <th>{{__('gx.subject')}}</th>
                            <th>{{__('gx.author')}}</th>
                            <th>{{__('gx.responses')}}</th>
                            <th>{{__('gx.created')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <style>
                            @media screen and (max-width: 800px){
                                .forum_table{
                                    font-size: 1.5vh;
                                }
                                .forum_content{
                                    font-size: 1.5vh;
                                }
                                #img_forum{
                                    display: none; !important;
                                }
                            }
                        </style>
                        @if(count($announcements) > 0)
                            @for($i = 0; $i < count($announcements); $i++)
                                <tr class="forum_content">
                                    <td style="vertical-align: middle;"><a href="/student/project/{{$project->idProject}}/post/{{$announcements[$i]->idAnnouncement}}">{{$announcements[$i]->title}}</a></td>
                                    <td style="vertical-align: middle;">
                                        <a href="/profile/{{$userPoster[$i]->id }}"><img id="img_forum" class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$userPoster[$i]->photo)}}"><span style="vertical-align: middle;"> {{$userPoster[$i]->name}}</span></a>
                                    </td>
                                    <td style="vertical-align: middle;">{{$numberComments[$i]}}</td>
                                    <td style="vertical-align: middle;">{{$announcements[$i]->date}}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td colspan="4"><h5>{{__('gx.no posts found')}}</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if(count($announcements) > 0)
                        <div class="d-flex justify-content-between">
                            <span>Showing {{$a->firstItem()}} to {{$a->lastItem()}} of {{$a->total()}} posts</span>
                            {{$a->links()}}
                        </div>
                    @endif
                </div>

                {{--Modal Create Post--}}
                <div class="modal fade" id="modalCreatePost" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="staticBackdropLabel">New Post</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['action' => ['PostController@store', $project -> idProject], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('title', trans('gx.title'))}}
                                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('body', trans('gx.body'))}}
                                    {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body'])}}
                                </div>
                                {{ Form::hidden('project', $project->idProject) }}

                                {{Form::submit('Submit', ['class'=>'btn btn-success'])}}

                                {!! Form::close() !!}
                            </div>
                            <script>ClassicEditor
                                    .create( document.querySelector( '#body' ), {
                                        toolbar: {
                                            items: [
                                                'heading',
                                                '|',
                                                'fontSize',
                                                'fontFamily',
                                                'fontColor',
                                                'fontBackgroundColor',
                                                'highlight',
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strikethrough',
                                                'link',,
                                                '|',
                                                'undo',
                                                'redo',
                                                '|',
                                                'indent',
                                                'outdent',
                                                '|',
                                                'bulletedList',
                                                'numberedList',
                                                '|',
                                                'blockQuote',
                                                'code',
                                                'codeBlock'
                                            ]
                                        },
                                        language: 'en',
                                        licenseKey: '',
                                    } )
                                    .then( editor => {
                                        window.editor = editor;
                                    } )
                                    .catch( error => {
                                        console.error( 'Oops, something gone wrong!' );
                                        console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
                                        console.warn( 'Build id: ce7zysryrfsm-xck2pu5o5swz' );
                                        console.error( error );
                                    } );
                            </script>
                            <style>
                                .ck-editor__editable_inline {
                                    min-height: 40vh;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fade tab-pane  ml-0 mr-0" id="submission" role="tabpanel" aria-labelledby="submission-tab">
            <div class="row">
                <div class="col">
                    <div class="container rounded pb-3 pt-3">
                        <h5>Submission</h5>
                        <div>Group: {{$idGroup}}</div>
                        <div>Deadline: {{\App\Project::find($project->idProject)->dueDate}}</div>
                        <?php
                            $last = \Carbon\Carbon::create(0, 0, 0, 0, 0, 0);
                            foreach($submittedFiles as $file){
                                if($file->submissionTime > $last){
                                    $last = $file->submissionTime;

                                }
                            }
                        ?>
                        <div>Submission time: {{$last}}</div>
                        <div>Files submitted:</div>
                        <div class="container-fluid mt-3 pr-0 pl-3" id="submittedFiles">
                            @foreach($submittedFiles as $file)
                                <div class="text-center" id= '{{$file->idFile}}' style="margin-right: 15px; position:relative; display: inline-block; width: 100px;">
                                    <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="position:absolute; top:-10px; right:17px;" id= '{{$file->idFile}}' class="close downloadFile" download>
                                        <span class="dot" id="download" style="position:relative; display:inline-block">
                                            <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                        </span>
                                    </a>
                                    <button style="position:absolute; top:-10px; right:-10px;" id= '{{$file->idFile}}' type="button" class="close removeFile">
                                        <span class="dot" id="delete" style="position:relative; display:inline-block">
                                            <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                        </span>
                                    </button>
                                    <figure>
                                        <i class="fas fa-folder fa-4x px-2" style="color: #ffce52;"></i>
                                        <figcaption>{{$file->pathFile}}</figcaption>
                                    </figure>
                                </div>
                                {{-- Modal Remove file --}}
                                <div class="modal fade" id="modalRemoveFile" aria-labelledby="modalRemoveFile" aria-hidden="true" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Remove file</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to remove this file?</h5>
                                                {!!Form::open(['action' => ['StudentProjectsController@update', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                {{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
                                                {{ Form::hidden('group', $idGroup) }}
                                                {{Form::hidden('submission','removeFile')}}
                                                {{Form::hidden('idFile','')}}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="container rounded pb-3 pt-3">
                        @foreach($groupUsers as $user)
                            <div id="{{$user->id}}">
                                {!! Form::open(['action' => ['StudentProjectsController@store', $project -> idProject], 'method' => 'POST']) !!}
                                    <img class="profilePhoto pr-2" style="border-radius: 100%; width: 13%; height: 13%; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}">
                                    <a href="/profile/{{$user->id}}">{{$user->name}} - {{$user->uniNumber}}</a>
                                    <div class="form-group">
                                        {{Form::label('grade', trans('gx.grade'))}}
                                        {{Form::text('grade', '', ['class' => 'form-control', 'placeholder' => 'Grade'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('commentary', trans('gx.commentary'))}}
                                        {{Form::text('commentary', '', ['class' => 'form-control', 'placeholder' => 'Comments'])}}
                                    </div>
                                {{ Form::hidden('project', $project->idProject) }}
                                {{ Form::hidden('submission', 'studentsEvaluation')}}
                                {{ Form::hidden('group', $idGroup) }}
                                {{Form::hidden('idStudent', $user->id)}}
                                {{Form::submit('Submit', ['class'=>'btn btn-success float-right'])}}

                                {!! Form::close() !!}
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    #btn_leave{
        width: 11em
    }
    @media screen and (max-width: 750px){
        .name_project{
            text-align: center;
            font-size: 4vh;
        }
        .breadcrumb breadcrumb-item{
            text-align: center;
        }
        .nav-tabs {
            font-size: 1.5vh;
        }
        #btn_leave {
            width: 3em;
            font-size: 1.25vh;
            padding-right: 6.5vh;
            padding-left: 4vh;
        }
    }

    #textArea{
        width: 100%;
        height: 100%;
        resize: none;
        background-color: #ffe680;
        border: none;
    }
    #textArea:focus{
        outline: 0;
        box-shadow: none;

    }

    .border {
        display: inline-block;
        width: 10px;
        height: 10px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto auto auto auto auto;
        padding: 10px;
    }

    .grid-container > div {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        font-size: 1vh;
    }
     .nav-tabs .nav-link.active{
         background-color: #ededed;
         border-color:#ededed;
     }
    .nav-tabs .nav-link{
        color: #2c3fb1;
    }
    .table{
        table-layout: fixed;
        width:100%;
    }

    .select{
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        padding-left: 2px;
    }
    .close{
        opacity: 1;
    }
    #delete {
        height: 25px;
        width: 25px;
        background-color: red;
        border-radius: 50%;
        display:none;
        color:white;
    }
    #download {
        height: 25px;
        width: 25px;
        background-color: white;
        border-radius: 50%;
        display:none;
        color: green;
    }
    form#dropzone.dropzone.dz-clickable {
        padding-bottom: 0px;
        padding-left: 0px;
        padding-top: 10px;
        padding-right: 0px;
        border-top-width: 0px;
        border-left-width: 0px;
        border-bottom-width: 0px;
        border-right-width: 0px;
        width: 100px;
        height: 100px;
        min-height: 120px;
        background-color: transparent;
        border: 3px dotted black;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        opacity:0.5;
        z-index:2;
    }


</style>
<script>
    $('#myTab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    if(hash === ''){
        hash = '#content';
    }

    $('#myTab a[href="' + hash + '"]').tab('show');

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });



    $(".editTask").click(function () {
        var id = $(this).closest("tr").attr("id").split("-");
        if ($("#" + id[0] + "-edit").hasClass("d-none") && id[1] == 'show'){
            $("#" + id[0] + "-show").addClass("d-none");
            $("#" + id[0] + "-edit").removeClass("d-none");
        } else {
            $("#" + id[0] + "-edit").addClass("d-none");
            $("#" + id[0] + "-show").removeClass("d-none");
        }
    });

    $(".pagination").addClass("justify-content-right");

    $(".open_modal").click(function(){
        $('input[name="group"]').val($(this).attr("id"));
        $('#modalCreateTask').modal('show');
    });

    $('#textArea').change( function() {
        datastring = {'notes':$('#textArea').val(), 'group': $('input[name=group]').val(), 'submission': $('input[name=submission]').val(), '_token': $('input[name=_token]').val()}
        $.ajax({
            type: "post",
            data: datastring,
            dataType: 'JSON',
            url: "/student/project/"
        });
    });

    var colors = ['red', 'green', 'lightblue', 'orange', 'yellow', 'black', ' pink', 'purple', 'brown', 'darkblue'];
    @foreach($groupUsers as $user)
        var uc = [Math.floor(Math.random() * colors.length)];
        @if(is_null(\App\Availability::find(\App\Availability::where("idGroup", $idGroup)->where("member", $user->id)->pluck("id")->first())))
            datastring = {
            'group': $('input[name=group]').val(),
            'submission': $('#scheduleform input[name=submission]').val(),
            '_token': $('input[name=_token]').val(),
            'idStudent': {{$user->id}},
            'color': colors[uc]
            }
            $.ajax({
                type: "post",
                data: datastring,
                dataType: 'JSON',
                url: "/student/project/"
            });
            $('#{{$user->id}}.Mastercolor').css('background-color', colors[uc]);
            colors.splice(uc,1);
        @else
            $('#{{$user->id}}.Mastercolor').css('background-color', '{{\App\Availability::find(\App\Availability::where("idGroup", $idGroup)->where("member", $user->id)->pluck("id")->first())->color}}');

        @endif

    @endforeach

    @foreach($schedule as $sc)
        var cells= {!! $sc->periods  !!};
        for(i = 0; i < cells.length; i++){
            var add = document.createElement("div");
            add.setAttribute("class", "border align-middle usercolor");
            add.setAttribute("id", '{{$sc->member}}');
            $('#' + cells[i] + '.cell').append(add);
            $('#{{$sc->member}}.usercolor').css('background-color', '{{\App\Availability::find(\App\Availability::where("idGroup", $idGroup)->where("member", $sc->member)->pluck("id")->first())->color}}');
            };
    @endforeach

    $('.cell').on('click', function () {
        if($(this).find('div#{{Auth::user()->id}}').length == 1) {
            $(this).find('div#{{Auth::user()->id}}').remove();
            datastring = {
                'cell': this.id,
                'group': $('input[name=group]').val(),
                'submission': $('#scheduleform input[name=submission]').val(),
                '_token': $('input[name=_token]').val(),
                'idStudent': {{Auth::user()->id}},
                'option': 'delete'
            }
        }else {
            var add = document.createElement("div");
            add.setAttribute("class", "border align-middle usercolor");
            add.setAttribute("id", '{{Auth::user()->id}}');
            this.appendChild(add);
            $('div#{{Auth::user()->id}}.usercolor').css('background-color', $('div#{{Auth::user()->id}}.Mastercolor').css('background-color'));
            datastring = {
                'cell': this.id,
                'group': $('input[name=group]').val(),
                'submission': $('#scheduleform input[name=submission]').val(),
                '_token': $('input[name=_token]').val(),
                'idStudent': {{Auth::user()->id}},
                'option': 'add'
            }
        }
        $.ajax({
            type: "post",
            data: datastring,
            dataType: 'JSON',
            url: "/student/project/"
        });

    });

    $('.file').on('click', function () {
        if($(this).hasClass('select')){
            $(this).removeClass('select');
            $(this).find("#download").css("display","none");
            $(this).find("#delete").css("display","none");
        }else{
            $(this).addClass('select');
            $(this).find('#download').css("display","inline-block");
            $(this).find('#delete').css("display","inline-block");
            $('#submitFile').removeAttr('disabled');
            }
        if($('.select').length == 0){
            $('#submitFile').attr('disabled','disabled');
        }
        });

    $(".file").hover(function() {
        $(this).find('#download').css("display","inline-block");
        $(this).find('#delete').css("display","inline-block");
    }, function() {
        if($(this).hasClass('select')){
            $(this).find('#download').css("display","inline-block");
            $(this).find('#delete').css("display","inline-block");
        }
        else{
            $(this).find("#download").css("display","none");
            $(this).find("#delete").css("display","none");
        }
    });

    $('.deleteFile').click(function(){
        $('input[name="idFile"]').val($(this).attr("id"));
        $('#modalDeleteFile').modal('show');
    });

    $('.removeFile').click(function() {
        $('input[name="idFile"]').val($(this).attr("id"));
        $('#modalRemoveFile').modal('show');
    });

    $('#modalSubmitFile').on('show.bs.modal', function (event) {
        var f = new Array;
        $('.select').each( function () {
            f.push($(this).attr("id"));
            var x = $(this).find('figure').css('display','inline-block').css('padding','5px').attr('class', 'text-center').clone().wrap('<p/>').parent().html();
            $('#modalSubmitFile .filesSelected').append(x);
        });
        $('input[name="filesSubmit"]').val(f);
    });

    $("#modalSubmitFile").on("hidden.bs.modal", function () {
        $('#modalSubmitFile .filesSelected').empty();
    });



</script>
@endsection
