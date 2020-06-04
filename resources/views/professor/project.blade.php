@extends('layouts.app')
@section('content')
<head>
    <title>Project</title>
</head>
<div class="container-xl-fluid mt-2 pl-5 pr-5 pb-2">
    @include('layouts.messages')
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
            <li class="breadcrumb-item " aria-current="page" >{{$subject->subjectName}} - {{$project->name}}</li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="characteristics-tab" data-toggle="tab" href="#characteristics" role="tab" aria-controls="characteristics" aria-selected="false">{{__('gx.characteristics')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="groups-tab" data-toggle="tab" href="#groups" role="tab" aria-controls="groups" aria-selected="true">{{__('gx.groups')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">{{__('gx.forum')}}</a>
        </li>
        <li class="rightbutton ml-auto">
            <button type="submit" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#modalDelete-{{$project->idProject}}" style="width: 20vh;color: white;">{{__('gx.deleteproject')}}</button>
        </li>
    </ul>

    <div class="modal fade" id="modalDelete-{{$project->idProject}}" aria-labelledby="modalDelete-{{$project->idProject}}" aria-hidden="true" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.delete project')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>{{__('gx.want to delete project?')}}</h5>
                    {!!Form::open(['action' => ['ProfessorProjectsController@destroy', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit(trans('gx.delete'), ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="myTabContent" style="min-height: 75vh; background-color: #ededed;">
        <div class="container tab-pane fade" id="characteristics" role="tabpanel" aria-labelledby="characteristics-tab">
            <div class="row h-100 p-3">
                <div class=" col-8 rounded bg-white w-100 p-3 h-100 mr-3" style="position: relative; width: 500px;">

                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalEdit-{{$project->idProject}}">{{__('gx.edit project')}}</button>
                    <h4>{{__('gx.characteristics')}}</h4>
                    @if($subject->idSubject == $project->idSubject)
                        <div class="modal fade" id="modalEdit-{{$project->idProject}}" aria-labelledby="modalEdit-{{$project->idProject}}" aria-hidden="true" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.edit project')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['action' => ['ProfessorProjectsController@update', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'formEdit']) !!}
                                        <div class="form-group">
                                            {{Form::label('title', trans('gx.name'))}}
                                            {{Form::text('title', $project->name, ['class' => 'form-control', 'placeholder' => trans('gx.project name')])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('deadline', trans('gx.group formation deadline'))}}
                                            {{Form::text('group formation deadline', $project->groupCreationDueDate, ['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker1-'.$project->idProject, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker1-'.$project->idProject, (\Carbon\Carbon::now()->floatDiffInHours($project->groupCreationDueDate, false) > 0 ? :'disabled')])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('deadline', trans('gx.deadline'))}}
                                            {{Form::text('deadline', $project->dueDate, ['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker2-'.$project->idProject, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker2-'.$project->idProject, (\Carbon\Carbon::now()->floatDiffInHours($project->dueDate, false) > 0 ? :'disabled')])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('minNumber', trans('gx.minimum no. of members'))}}
                                            {{Form::selectRange('minNumber', 1, 10, $project->minElements)}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('maxNumber', trans('gx.maximum no. of members'))}}
                                            {{Form::selectRange('maxNumber', 1, 10, $project->maxElements)}}
                                        </div>
                                        {{ Form::hidden('subject', $subject->idSubject) }}
                                        {{Form::hidden('option', 'project')}}

                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success'])}}
                                        {!! Form::close() !!}
                                    </div>
                                    <script>
                                        $(function() {$( "#datetimepicker1-{{$project->idProject}}" ).datetimepicker({
                                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                                            date: moment('{{$project->groupCreationDueDate}}').format('YYYY-MM-DD HH:mm'),
                                            locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                                        });});
                                        $(function() {$( "#datetimepicker2-{{$project->idProject}}" ).datetimepicker({
                                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                                            date: moment('{{$project->dueDate}}').format('YYYY-MM-DD HH:mm'),
                                            locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                                        });});
                                    </script>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="pt-3">
                        <table class="table ">
                            <tr>
                                <th class="info-th" scope="row">{{__('gx.group creation deadline')}}</th>
                                <td class="info-td" >{{$project->groupCreationDueDate}}</td>
                                <td class="info-td" >
                                    <div id="timer2"></div>
                                    <style>
                                        #timer2 {
                                            font-size: 1.30em;
                                            font-weight: 100;
                                            color: navy;
                                        }

                                        #timer2 div {
                                            display: inline-block;
                                            min-width: 45px;
                                        }

                                        #timer2 div span {
                                            color: black;
                                            display: block;
                                            font-size: .50em;
                                            font-weight: 400;
                                        }
                                    </style>
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

                                            if (d<0){
                                                document.getElementById("timer2")
                                                    .innerHTML = '<p>{{__('gx.finished')}}<p>';
                                            }else if (d==0 && h==0 && m==0){
                                                document.getElementById("timer2")
                                                    .innerHTML = '<div>' + s + '<span>{{__('gx.seconds')}}</span></div>';
                                            } else if (d==0 && h==0 && m==0 && s==0){
                                                document.getElementById("timer2")
                                                    .innerHTML = '<p>{{__('gx.finished')}}<p>';
                                            }else if (d==0){
                                                document.getElementById("timer2")
                                                    .innerHTML =
                                                    '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                                                    '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>' +
                                                    '<div>' + s + '<span>{{__('gx.seconds')}}</span></div>';
                                            }
                                            else{
                                                document.getElementById("timer2")
                                                    .innerHTML =
                                                    '<div>' + d + '<span>{{__('gx.days')}}</span></div>' +
                                                    '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                                                    '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>';
                                            }
                                        }
                                        updateTimer2();
                                        //setInterval('updateTimer2()', 1000);
                                    </script>

                                </td>
                            </tr>
                            <tr>
                                <th class="info-th" scope="row">{{__('gx.delivery time')}}</th>
                                <td class="info-td" >{{$project->dueDate}}</td>
                                <td class="info-td" style="width: 30%;">
                                    <div id="timer"></div>
                                    <style>
                                        #timer {
                                            font-size: 1.30em;
                                            font-weight: 100;
                                            color: navy;
                                        }

                                        #timer div {
                                            display: inline-block;
                                            min-width: 45px;
                                        }

                                        #timer div span {
                                            color: black;
                                            display: block;
                                            font-size: .50em;
                                            font-weight: 400;
                                        }
                                    </style>
                                    <script>
                                        function updateTimer() {
                                            future = Date.parse("{{$project->dueDate}}");
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

                                            if (d<0 || (d==0 && h==0 && m==0 && s==0)){
                                                document.getElementById("timer")
                                                    .innerHTML = '<p>{{__('gx.finished')}}<p>';
                                            }else if (d==0 && h==0 && m==0){
                                                document.getElementById("timer")
                                                    .innerHTML = '<div>' + s + '<span>{{__('gx.seconds')}}</span></div>';
                                            }else if (d==0){
                                                document.getElementById("timer")
                                                    .innerHTML =
                                                    '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                                                    '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>' +
                                                    '<div>' + s + '<span>{{__('gx.seconds')}}</span></div>';
                                            }else{
                                                document.getElementById("timer")
                                                    .innerHTML =
                                                    '<div>' + d + '<span>{{__('gx.days')}}</span></div>' +
                                                    '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                                                    '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>';
                                            }
                                        }
                                        updateTimer();
                                        setInterval('updateTimer()', 1000);
                                    </script>
                                </td>
                            </tr>

                            <tr>
                                <th class="info-th" scope="row">{{__('gx.maximum no. of groups')}}</th>
                                <td class="info-td" colspan="2">{{$project->maxGroups}}</td>
                            </tr>
                            <tr>
                                <th class="info-th" scope="row">{{__('gx.minimum no. of groups')}}</th>
                                <td class="info-td" colspan="2">{{$project->minElements}}</td>
                            </tr>
                            <tr>
                                <th class="info-th" scope="row">{{__('gx.maximum no. of elements group')}}</th>
                                <td class="info-td" colspan="2">{{$project->maxElements}}</td>
                            </tr>
                        </table>
                    </div>

                    <hr style="border-top: 4px double #8c8b8b; text-align: center;">
                    <table class="table style1">
                        <tbody>
                        <tr>
                            <th class="info-th" scope="row">{{__('gx.number of groups')}}</th>
                            <td class="info-td" colspan="2" >{{count($groups)}}</td>
                        </tr>
                        <tr>
                            <th class="info-th" scope="row" style="width: 45%;">{{__('gx.groups that dont match requirements')}}</th>
                            <?php $count = 0 ?>
                            @foreach($groups as $group)
                                @if(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup)->count() < $project->minElements)
                                    <?php $count++ ?>
                                @endif
                            @endforeach


                            @if($count >= 1)
                                <td class="info-td" style="width: 53%;"><button type="button" class="btn btn-outline-primary btn-sm m-0 waves-effect" data-toggle="modal" data-target="#modalGroups-{{$project->idProject}}">{{__('gx.show')}}</button></td>
                                <div class="modal fade" id="modalGroups-{{$project->idProject}}" aria-labelledby="modalGroups-{{$project->idProject}}" aria-hidden="true" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Grupos</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($groups as $group)
                                                    @if(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup)->count() < $project->minElements)
                                                        <p><a {{--onclick="window.location.assign ='#groups.pills-{{$group->idGroupProject}}'"--}} {{--href="#groups.pills-{{$group->idGroupProject}}"--}} href="{{url('/professor/project/'.$project->idProject.'#groups.pills-'.$group->idGroupProject)}}">Grupo {{$group->idGroupProject}}</a></p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <td class="info-td">
                                    {{$count}}
                                </td>
                            @endif
                        </tr>
                        </tbody>

                    </table>
                </div>
                <div class=" col rounded bg-white w-100 p-3 " style="position: relative;">
                    <h5>{{__('gx.documentation')}}</h5>
                    <button type="button" class="p-2 btn btn-primary btn-md" data-toggle="modal" data-target="#modalUploadFiles-{{$project->idProject}}" style="position: absolute; bottom: 0; right: 0; margin-bottom: 2%; margin-right: 2%;"  data-toggle="modal">{{__('gx.upload files')}}</button>

                    @foreach($rep1 as $document)
                        <div class="doc text-center" style="margin-right: 10px; position:relative; display: inline-block; width: 100px;">
                            <a href="{{Storage::url('documentation/'.$project->idProject.'/'.$document->pathFile)}}" target="_blank" style="position:absolute; top:-10px; right:17px;"></a>
                            <button style="position:absolute; top:-10px; right:-10px;" id= '{{$document->idDocumentation}}' type="button" class="close deleteFile">
                                    <span class="dot" id="delete" style="position:relative">
                                        <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                    </span>
                            </button>
                            <figure class="my-1">
                                <i class="fas fa-folder fa-4x px-2" style="color: #ffce52;"></i>
                                <figcaption style="overflow:hidden;">{{$document->pathFile}}</figcaption>
                            </figure>
                        </div>
                    @endforeach

                  {{--modal upload file--}}
                    <div class="modal fade" id="modalUploadFiles-{{$project->idProject}}" aria-labelledby="modalUploadFiles-{{$project->idProject}}" aria-hidden="true" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.upload files')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['action' => ['ProfessorProjectsController@store', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                    <div class="form-group">
                                        {{Form::label('documentation', trans('gx.documentation'))}}
                                        {{Form::file('documentation')}}
                                    </div>
                                    {{Form::hidden('option', 'projectFiles')}}
                                    {{ Form::hidden('project', $project->idProject) }}
                                    {{Form::hidden('_method','POST')}}
                                    {{Form::submit( trans('gx.submit'), ['class'=>'btn btn-success'])}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Delete file --}}
                    <div class="modal fade" id="modalDeleteDoc" aria-labelledby="modalDeleteDoc" aria-hidden="true" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.delete file')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>{{__('gx.areyousuredeletedocument')}}</h5>
                                    {!!Form::open(['action' => ['ProfessorProjectsController@destroy', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {{Form::hidden('option','doc')}}
                                    {{Form::hidden('idDoc','')}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid ml-0 mr-0 tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
            <div class="row rounded " style="height: 75vh;">
                <div class="col mt-3 mb-3 ml-3 rounded center" style="background-color: #c6c6c6; position: relative;">
                    <div class="container pt-3 overflow-auto mw-80" >
                        <ul class="nav nav-pills mb-3 flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($groups as $group)
                                 <li class="nav-item mb-1 rounded" style="background-color: #d0e7ff;">
                                     <a class="nav-link " style="display:flex; align-items: center;vertical-align: middle;" id="pills-{{$group->idGroupProject}}-tab" data-toggle="pill" href="#pills-{{$group->idGroupProject}}" role="tab" aria-controls="pills-{{$group->idGroupProject}}" aria-selected="true">
                                         <h3 class="float-left mb-0 mr-2" style="vertical-align: middle;">{{__('gx.group')}} {{$group->idGroupProject}} </h3>
                                     </a>
                                 </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-9 mt-3 mb-3 rounded" style="width: 100%;">
                    <div class="container-fluid rounded h-100 p-3" style="background-color: #c6c6c6;">
                        <div class="tab-content h-100" id="pills-tabContent">
                            @foreach($groups as $group)
                                <div class="container tab-pane fade h-100" id="pills-{{$group->idGroupProject}}" role="tabpanel" aria-labelledby="pills-{{$group->idGroupProject}}-tab">
                                        <div class="row h-100" style="position: relative; background-color: #c6c6c6;">
                                            <div class="col mr-2 ">
                                                    <div class="row pb-2 " style="height: 40%;">
                                                        <div class="bg-light p-2 w-100 rounded">
                                                            <h5>{{__('gx.files')}}</h5>
                                                            @foreach($rep2 as $docSub)
                                                                @if($docSub->idGroup == $group->idGroup)
                                                                    <div class="doc text-center" style="margin-right: 10px; position:relative; display: inline-block; width: 100px;">
                                                                        <a href="{{Storage::url('studentRepository/'.$group->idGroup.'/'.$docSub->pathFile)}}" target="_blank" style="position:absolute; top:-10px; right:17px;" class="close downloadFile" download>
                                                                            <span class="dot" id="download" style="position:relative">
                                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                                            </span>
                                                                        </a>
                                                                        <figure class="my-1">
                                                                            <i class="fas fa-folder fa-4x px-2" style="color: #ffce52;"></i>
                                                                            <figcaption style="overflow:hidden;">{{$docSub->pathFile}}</figcaption>
                                                                        </figure>
                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                    <div class="row pb-2 " style="height: 30%;"><div class="bg-light p-2 w-100 rounded"><h5>{{__('gx.students assessments')}}</h5></div></div>
                                                    <div class="row " style="height: 30%;">
                                                        <div class=" bg-light p-2 w-100 rounded">
                                                        <h5>{{__('gx.final group evaluation')}}</h5>
                                                        @if ($group->grade == NULL)
                                                            <p class="mb-0">{{__('gx.group not evaluated')}}</p>
                                                            <button type="button" class="p-2 btn btn-primary btn-md" style="position: absolute; bottom: 0; right: 0; margin-bottom: 1%; margin-right: 1%;"  data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}">{{__('gx.evaluate group')}}</button>
                                                            <div class="modal fade" id="modalAvaliate-{{$group->idGroup}}" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.evaluation')}}</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {!! Form::open(['action' => 'ProfessorProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                                            <div class="form-group">
                                                                                {{Form::label('grade', trans('gx.project grade'))}}
                                                                                {{Form::text('grade', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            <div class="form-group">
                                                                                {{Form::label('gradeComment', trans('gx.comment(opcional)'))}}
                                                                                {{Form::text('gradeComment', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            {{Form::hidden('group', $group->idGroup)}}
                                                                            {{Form::hidden('option', 'grade')}}
                                                                            {{Form::hidden('project', $project->idProject)}}
                                                                            {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success'])}}

                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else

                                                            <p class="mb-0">{{__('gx.grade')}}: {{$group->grade}}</p>
                                                            @if($group->gradeComment == NULL)
                                                                <p class="m-0">{{__('gx.no comments')}}</p>
                                                            @else
                                                                <p class="mb-0" >: {{$group->gradeComment}}</p>
                                                            @endif
                                                            <button type="button" class="p-2 btn btn-primary btn-md float-right" style="position: absolute; bottom: 0; right: 0; margin-bottom: 1%; margin-right: 1%;" data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}" >{{__('gx.change grade')}}</button>
                                                            <div class="modal fade" id="modalAvaliate-{{$group->idGroup}}" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.evaluation')}}</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {!! Form::open(['action' => ['ProfessorProjectsController@update', $project->idProject], 'method' => 'PUT']) !!}
                                                                            <div class="form-group">
                                                                                {{Form::label('grade', trans('gx.project grade'))}}
                                                                                {{Form::text('grade', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            <div class="form-group">
                                                                                {{Form::label('gradeComment', trans('gx.comment(opcional)'))}}
                                                                                {{Form::text('gradeComment', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            {{Form::hidden('group', $group->idGroup)}}
                                                                            {{Form::hidden('_method','PUT')}}
                                                                            {{Form::hidden('option', 'grade')}}
                                                                            {{Form::submit( trans('gx.submit'), ['class'=>'btn btn-success'])}}
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 bg-light p-3 rounded">
                                                <h5>{{__('gx.elements')}}</h5>
                                                @foreach(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup) as $sg)
                                                    <div class="mb-2"><a href="/profile/{{$sg->idStudent}}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.\App\User::find($sg->idStudent)->photo)}}"><span style="vertical-align: middle;"> {{\App\User::find($sg->idStudent)->name}}</span></a></div>
                                                @endforeach
                                            </div>

                                        </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <button type="button" class="p-2 mt-3 mr-3 btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCreatePost" style="background-color: #2c3fb1; border-color: #2c3fb1;">{{__('gx.create post')}}</button>

            <div class="container rounded pb-3 pt-3">
                <div class="table-responsive-xl">
                    <table class="table bg-white rounded" style="text-align:center;">
                        <thead>
                        <tr>
                            <th>{{__('gx.subject')}}</th>
                            <th>{{__('gx.author')}}</th>
                            <th>{{__('gx.responses')}}</th>
                            <th>{{__('gx.created')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($announcements) > 0)
                            @for($i = 0; $i < count($announcements); $i++)
                                <tr>
                                    <td style="vertical-align: middle;"><a href="/professor/project/{{$project->idProject}}/post/{{$announcements[$i]->idAnnouncement}}">{{$announcements[$i]->title}}</a></td>
                                    <td style="vertical-align: middle;">
                                        <a href="/profile/{{$userPoster[$i]->id }}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$userPoster[$i]->photo)}}"><span style="vertical-align: middle;"> {{$userPoster[$i]->name}}</span></a>
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
                            <span>{{__('gx.showing')}} {{$a->firstItem()}} to {{$a->lastItem()}} of {{$a->total()}} {{__('gx.posts')}}</span>
                            {{$a->links()}}
                        </div>
                    @endif
                </div>

                {{--Modal Create Post--}}
                <div class="modal fade" id="modalCreatePost" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.new post')}}</h4>
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

                                {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success'])}}

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
    </div>
</div>
<style>
    .style1 > tbody > tr:first-child > td {
        border: none;
    }
    .style1 > tbody > tr:first-child > th {
        border: none;
    }
    .info-th{
        width: 46%;
    }
    .info-td {
        text-align: center;
    }
    .nav-tabs .nav-link.active{
        background-color: #ededed;
        border-color:#ededed;
    }

    .table td, .table th{
        vertical-align: middle;
    }
    #delete {
        height: 25px;
        width: 25px;
        background-color: red;
        border-radius: 50%;
        display: inline-block;
        color:white;
    }
    #download {
        height: 25px;
        width: 25px;
        background-color: white;
        border-radius: 50%;
        display: inline-block;
        color: green;
    }
</style>
<script>
    $('#myTab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#pills-tab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    var pills;
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        if(id == "groups"){
            if(pills !== undefined) {
                window.location.hash = id + "." + pills;
                $('#pills-tab a[href="#' + pills + '"]').tab('show');
            }else{
                window.location.hash = id + "." + "pills-1";
                $('#pills-tab a[href="#pills-1"]').tab('show');
            }
        }else{
            window.location.hash = id;
        }
    });

    $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        pills = id;
        window.location.hash = window.location.hash.split(".")[0] + "." + id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    if(hash === ''){
        hash = '#characteristics';
    }

    if(hash.split(".")[0] == '#groups'){
        pills = hash.split(".")[1];
        $('#myTab a[href="' + hash.split(".")[0] + '"]').tab('show');
    }else{
        $('#myTab a[href="' + hash + '"]').tab('show');
    }


    $('.deleteFile').click(function(){
        $('input[name="idDoc"]').val($(this).attr("id"));
        $('#modalDeleteDoc').modal('show');
    });

</script>
@endsection
