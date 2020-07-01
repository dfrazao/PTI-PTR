@extends('layouts.app')
@section('content')
<head>
    <title>{{__('gx.project')}}</title>
</head>
<div class="container-fluid pl-4 pr-4 pb-2 mt-3">
    <?php
    $first1 = Carbon\Carbon::today()->subYears(1)->month(8)->day(1);
    $second1 = Carbon\Carbon::today()->month(7)->day(31)->hour(23)->minute(59)->second(59);
    $first2 = Carbon\Carbon::today()->month(8)->day(1);
    $second2 = Carbon\Carbon::today()->addYears(1)->month(7)->day(31);
    if (Carbon\Carbon::today()->between($first1, $second1)) {
        $currentYear = $first1->year . '/' . $second1->year;
    } else if (Carbon\Carbon::today()->between($first2, $second2)) {
        $currentYear = $first2->year . '/' . $second2->year;
    }
    ?>
    @include('layouts.messages')
    <nav id="breadcrumb" aria-label="breadcrumb" >
        <ol id="breadcrumb" class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
            <li id="bc1" class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
            <li id="bc2" class="breadcrumb-item " aria-current="page" >{{$subject->subjectName}} - {{$project->name}}</li>
        </ol>
    </nav>
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

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="characteristics-tab" data-toggle="tab" href="#characteristics" role="tab" aria-controls="characteristics" aria-selected="false">{{__('gx.characteristics')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="gr-tab" data-toggle="tab" href="#gr" role="tab" aria-controls="groups" aria-selected="true">{{__('gx.groups')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">{{__('gx.forum')}}</a>
        </li>
        <li class="rightbutton ml-auto">
            <button type="submit" class="btn btn-md bg-danger" data-toggle="modal" data-target="#modalDelete-{{$project->idProject}}" style="width:22vh; color: white;"><i class="fal fa-trash mr-2"></i>{{__('gx.deleteproject')}}</button>
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
                    {{ Form::button('<i class="fas fa-trash mr-2"></i>'.trans('gx.delete'), ['type' => 'submit', 'class' => 'btn btn-danger float-right mt-2'] )  }}
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="myTabContent" style="min-height: 75vh; background-color: #ededed;">
        <div class="container tab-pane fade " id="characteristics" role="tabpanel" aria-labelledby="characteristics-tab">
            <div class="row  p-3">
                <div class=" col-lg-8 rounded bg-white w-100 p-3 mr-2" style="position: relative;">

                    <button type="button" class="btn btn-success btn-md float-right stopYear" data-toggle="modal" data-target="#modalEdit-{{$project->idProject}}"><i class="fas fa-edit mr-2"></i>{{__('gx.edit project')}}</button>
                    <h4>{{__('gx.characteristics')}}</h4>
                    @if($subject->idSubject == $project->idSubject or $subject->academicYear == $currentYear)
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
                                            {{Form::label('title', trans('gx.project name'))}}
                                            {{Form::text('title', $project->name, ['class' => 'form-control', 'placeholder' => trans('gx.project name'), 'maxlength' => 50])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('deadline', trans('gx.group formation deadline'))}}
                                            {{Form::text('group formation deadline', $project->groupCreationDueDate, ['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker1-'.$project->idProject, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker1-'.$project->idProject])}}
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
                                        <div class="form-group">
                                            {{Form::label('maxGrade', trans('gx.project maxGrade'))}}
                                            {{Form::number('maxGrade', $project->maxGrade , ['class' => 'form-control', 'step'=>'any','min'=>0])}}
                                        </div>
                                        {{ Form::hidden('subject', $subject->idSubject) }}
                                        {{Form::hidden('option', 'project')}}

                                        {{Form::hidden('_method','PUT')}}
                                        {{ Form::button('<i class="fas fa-check mr-2"></i>'.trans('gx.submit'), ['type' => 'submit', 'class' => 'btn btn-success float-right'] )  }}
                                        {!! Form::close() !!}
                                    </div>
                                    <script>
                                        $(function() {$( "#datetimepicker1-{{$project->idProject}}" ).datetimepicker({
                                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                                            date: moment('{{$project->groupCreationDueDate}}').format('YYYY-MM-DD HH:mm'),
                                            locale: "en",
                                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                                        });});
                                        $(function() {$( "#datetimepicker2-{{$project->idProject}}" ).datetimepicker({
                                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                                            date: moment('{{$project->dueDate}}').format('YYYY-MM-DD HH:mm'),
                                            locale: "en",
                                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                                        });});
                                        $("#datetimepicker1-{{$project->idProject}}").on("change.datetimepicker", function (e) {
                                            $('#datetimepicker2-{{$project->idProject}}').datetimepicker('minDate', e.date);
                                        });
                                        $("#datetimepicker2-{{$project->idProject}}").on("change.datetimepicker", function (e) {
                                            $('#datetimepicker1-{{$project->idProject}}').datetimepicker('maxDate', e.date);
                                        });
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

                                            if (d<0 || (d==0 && h==0 && m==0 && s==0)){
                                                document.getElementById("timer2")
                                                    .innerHTML = '<p>{{__('gx.finished')}}<p>';
                                            }else{
                                                document.getElementById("timer2")
                                                    .innerHTML =
                                                    '<div>' + d + '<span>{{__('gx.days')}}</span></div>' +
                                                    '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                                                    '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>';
                                            }
                                        }
                                        updateTimer2();
                                        setInterval('updateTimer2()', 1000);

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
                                <th class="info-th" scope="row">{{__('gx.minimum no. of elements group')}}</th>
                                <td class="info-td" colspan="2">{{$project->minElements}}</td>
                            </tr>
                            <tr>
                                <th class="info-th" scope="row">{{__('gx.maximum no. of elements group')}}</th>
                                <td class="info-td" colspan="2">{{$project->maxElements}}</td>
                            </tr>
                            <tr>
                                <th class="info-th" scope="row">{{__('gx.project maxGrade')}}</th>
                                <td class="info-td" colspan="2">{{$project->maxGrade}}</td>
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
                            <th class="info-th" scope="row">{{__('gx.numSubmissions')}}</th>
                            <td class="info-td" colspan="2" >{{count($rep2->whereIn('idGroup', $groups->pluck('idGroup'))->groupBy('idGroup'))}}</td>
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
                                <td class="info-td" style="width: 53%;">
                                    <button type="button" class="btn btn-outline-primary btn-md m-0 waves-effect" data-toggle="modal" data-target="#modalGroups-{{$project->idProject}}"><i class="fas fa-eye mr-2"></i>{{__('gx.show')}}</button>
                                </td>
                                <div class="modal fade" id="modalGroups-{{$project->idProject}}" aria-labelledby="modalGroups-{{$project->idProject}}" aria-hidden="true" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.groups')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($groups as $group)
                                                    @if(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup)->count() < $project->minElements)
                                                        <p><a id="showGroups" onclick="reloadPage('{{url('/professor/project/'.$project->idProject.'#gr.pills-'.$group->idGroupProject)}}')">{{__('gx.group')}} {{$group->idGroupProject}}</a></p>

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
                <div id="row_docs_prof" class=" col rounded bg-white w-100 p-3 " style="position: relative;">
                    <h5>{{__('gx.documentation')}}</h5>
                    @if($rep1 == '[]')
                        {{__('gx.noDocumentation')}}
                    @endif
                    <button type="button" class=" btn btn-primary btn-md stopYear" data-toggle="modal" data-target="#modalUploadFiles-{{$project->idProject}}" style="position: absolute; bottom: 0; right: 0; margin-bottom: 2%; margin-right: 2%;"  data-toggle="modal"><i class="fas fa-upload mr-2"></i>{{__('gx.upload doc')}}</button>
                    <div id="files_documentation" class="table-wrapper-scroll-y my-custom-scrollbar">
                        <style>
                            #files_documentation{
                                height: 65vh;
                                overflow: auto;
                                margin-bottom: 10%;
                            }
                            @media screen and (max-width: 1185px){
                                #row_docs_prof {
                                    margin-top: 10px;
                                }
                            @media screen and (max-width: 991px){
                                #row_docs_prof {
                                    height: 300px;
                                    margin-top: 10px;
                                }
                                #files_documentation{
                                    display: block;
                                    right: 2%;
                                    left: 2%;
                                    top:20%;
                                    overflow: auto;
                                    height: 76%;
                                }
                            }
                        </style>
                        <table class="table table-sm fixed_header">

                            <tbody>


                                @foreach($rep1 as $document)
                                    <tr>
                                    @if((pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "txt")
                                        <td style="width: 5%;"><i class="fad fa-file-alt fa-2x pr-2"  id= '{{$document->idDocumentation}}'></i></td>
                                    @elseif((pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "jpg" or (pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "jpeg" or (pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "png")
                                        <td style="width: 5%;"><i class="fad fa-file-image  fa-2x pr-2"  id= '{{$document->idDocumentation}}'></i></td>
                                    @elseif((pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "pdf" )
                                        <td style="width: 5%;"><i class="fad fa-file-pdf fa-2x pr-2"  id= '{{$document->idDocumentation}}'></i></td>
                                    @elseif((pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "docx" )
                                        <td style="width: 5%;"><i class="fad fa-file-word fa-2x pr-2" id= '{{$document->idDocumentation}}'></i></td>
                                    @elseif((pathinfo($document->pathFile, PATHINFO_EXTENSION)) == "zip" )
                                        <td style="width: 5%;"><i class="fad fa-file-archive fa-2x pr-2" id= '{{$document->idDocumentation}}'></i></td>
                                    @else
                                        <td style="width: 5%;"><i class="fad fa-file-code fa-2x pr-2" id= '{{$document->idDocumentation}}'></i></td>
                                    @endif
                                        <td><a href="{{Storage::url('documentation/'.$project->idProject.'/'.$document->pathFile)}}" target="_blank" class="downloadFile" download>{{$document->pathFile}}</a></td>
                                        <td>
                                            <a href="{{Storage::url('documentation/'.$project->idProject.'/'.$document->pathFile)}}" target="_blank" style="position:absolute; top:-10px; right:17px;"></a>
                                            <button  id= '{{$document->idDocumentation}}' type="button" class="close deleteFile">
                                                        <span class="dot" id="delete" style="position:relative">
                                                            <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                        </span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($subject->academicYear == $currentYear)
                        {{--modal upload file--}}
                        <div class="modal fade" id="modalUploadFiles-{{$project->idProject}}" aria-labelledby="modalUploadFiles-{{$project->idProject}}" aria-hidden="true" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.upload doc')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['action' => ['ProfessorProjectsController@store', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                        <div class="form-group">

                                            {{Form::file('documentation[]' , ['multiple' => 'multiple'] )}}
                                        </div>
                                        {{Form::hidden('option', 'projectFiles')}}
                                        {{ Form::hidden('project', $project->idProject) }}
                                        {{Form::hidden('_method','POST')}}
                                        {{ Form::button('<i class="fas fa-check mr-2"></i>'.trans('gx.submit'), ['type' => 'submit', 'class' => 'btn btn-success btn-sm float-right'] )  }}
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
                                        {{Form::button('<i class="fas fa-trash mr-2"></i>'.trans('gx.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm float-right mt-2'])}}
                                        {{Form::hidden('option','doc')}}
                                        {{Form::hidden('idDoc','')}}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container-fluid ml-0 mr-0 tab-pane fade" id="gr" role="tabpanel" aria-labelledby="groups-tab">
            <div id="altura_col_groups_prof" class="row rounded">
                <div id="col_groups_prof"class="col-lg-3 mt-3 mb-3 px-3 rounded center" style="position: relative; height: 94%;">
                    <style>
                        #altura_col_groups_prof{
                            height: 75vh;
                        }
                        @media screen and (max-width: 991px){
                            #col_groups_prof {
                            }
                            #altura_col_groups_prof{
                                height: 100%;
                            }
                        }
                    </style>
                    <div class="container rounded pt-3 overflow-auto mw-80 h-100" style="background-color: #c6c6c6;">
                        @if($groups == '[]')
                            <p>{{__('gx.noGroupsFormed')}}</p>
                        @else
                            <ul class="nav nav-pills mb-3 flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($groups as $group)
                                    <li class="nav-item mb-1 rounded" style="background-color: #d0e7ff;">
                                        <a class="nav-link " style="display:flex; align-items: center;vertical-align: middle; justify-content: space-between;" id="pills-{{$group->idGroupProject}}-tab" data-toggle="pill" href="#pills-{{$group->idGroupProject}}" role="tab" aria-controls="pills-{{$group->idGroupProject}}" aria-selected="true">
                                            <h3 class="float-left mb-0 mr-2" style="vertical-align: middle;">{{__('gx.group')}} {{$group->idGroupProject}} </h3><i class="fas fa-check-circle" id="pills-{{$group->idGroupProject}}-tab-image" style="display: none"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div id="container_grupos" class="col-lg-9 mt-3 mb-3 rounded pr-3" style="width: 100%;">
                    <style>
                        #container_grupos{
                            padding-left: 0px;
                        }
                        @media screen and (max-width: 991px) {
                            #container_grupos {
                                padding-left: 15px;
                            }
                        }
                    </style>
                    <div class="container-fluid rounded h-100 p-3" style="background-color: #c6c6c6;">
                        <div class="tab-content h-100" id="pills-tabContent">
                            @if($groups == '[]')
                                <p> {{__('gx.noInfoGroups')}}</p>
                            @else
                                @foreach($groups as $group)
                                    <div class="container-fluid tab-pane fade h-100" id="pills-{{$group->idGroupProject}}" role="tabpanel" aria-labelledby="pills-{{$group->idGroupProject}}-tab">
                                            <div class="row h-100" style="position: relative; background-color: #c6c6c6;">
                                                <div class="col-lg-6">

                                                <div id="assessments_row" class="row h-100">
                                                    <div class="bg-light p-2 w-100 rounded" style="margin-right: 10px">
                                                        <h5 class="mb-3">{{__('gx.tWorkEval')}}</h5>
                                                        @if(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup) == '[]')
                                                            <p>{{__('gx.noStudsInGroup')}}</p>
                                                        @else
                                                            <div style="overflow: auto; max-height: 59vh;">
                                                            <table id="tabela_aval"  class="table table-sm " style="text-align: center; vertical-align: middle;">
                                                                <thead>
                                                                <tr id="font_tabela_aval">
                                                                    <th scope="col">{{__('gx.elements')}}</th>
                                                                    <th scope="col"></th>
                                                                    <th scope="col" >{{__('gx.selfEval')}}</th>
                                                                    <th scope="col" >{{__('gx.groupEval')}}</th>
                                                                </tr>
                                                                </thead>
                                                                <style>
                                                                    @media screen and (max-width: 500px) {
                                                                        #font_tabela_aval {
                                                                            font-size: 1.5vh;
                                                                        }
                                                                        #avatar2{
                                                                            display: none;
                                                                        }
                                                                        #nome_aval{
                                                                            font-size: 1.5vh;
                                                                        }
                                                                    }
                                                                    @media screen and (max-width: 991px) {
                                                                        #assessments_row{
                                                                            padding-bottom: 20px;
                                                                        }
                                                                    }
                                                                </style>
                                                                <tbody>
                                                                @foreach(DB::table('studentGroups')->join('users', 'studentGroups.idStudent', '=', 'users.id')->select('studentGroups.*')->where('idGroup', $group->idGroup)->orderBy('users.name', 'ASC')->get() as $sg)
                                                                    <tr>
                                                                        <td style="text-align: left;"><a href="/profile/{{$sg->idStudent}}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.\App\User::find($sg->idStudent)->photo)}}"><span id="nome_aval" style="vertical-align: middle;"> {{\App\User::find($sg->idStudent)->name}}</span></a></td>
                                                                        <td style="text-align: left;"><i onclick='chat({{$sg->idStudent}})' class="far fa-envelope"></i></td>
                                                                        <td>
                                                                            @if(is_null(\App\Evaluation::where('receiver', $sg->idStudent)->where('sender', $sg->idStudent)->where('idGroup', $group->idGroup)->value('grade')))
                                                                                –
                                                                            @else
                                                                                <i class="fas fa-star" style="color: #ffd63f;"></i> {{\App\Evaluation::where('receiver', $sg->idStudent)->where('sender', $sg->idStudent)->where('idGroup', $group->idGroup)->value('grade')}}/5
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(\App\Evaluation::find(\App\Evaluation::where('receiver', $sg->idStudent)->where('sender', "!=", $sg->idStudent)->where('idGroup', $group->idGroup)->pluck('idEval'))->pluck('grade')->avg() == 0)
                                                                                –
                                                                            @else
                                                                                <i class="fas fa-star" style="color: #ffd63f;"></i> {{round(\App\Evaluation::find(\App\Evaluation::where('receiver', $sg->idStudent)->where('sender', "!=", $sg->idStudent)->where('idGroup', $group->idGroup)->pluck('idEval'))->pluck('grade')->avg() , 2)}}/5
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>

                                        </div>
                                        <div  class="col-lg-6 ">
                                            <div id="files_row" class="row">
                                                <style>
                                                    #files_row{
                                                        height: 50%;
                                                    }
                                                    @media screen and (max-width: 991px){
                                                        #files_row {
                                                            padding-bottom: 10px;
                                                            height: unset;
                                                        }
                                                    }
                                                </style>
                                                <div class="bg-light p-2 w-100 rounded h-100" >
                                                    <h5 id="titleFiles" style="margin-bottom: 3%;">{{__('gx.files submited')}}</h5>
                                                    <script>
                                                        function bytesToHuman(bytes)
                                                        {
                                                            units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

                                                                for (i = 0; bytes > 1024; i++) {
                                                                    bytes /= 1024;
                                                                }

                                                                return (Math.round((bytes + Number.EPSILON) * 100) / 100 )+ ' ' + units[i];
                                                            }
                                                        </script>
                                                        <div style="overflow: auto; max-height: 25vh; margin-top: 4%; ">
                                                            <table class="table table-sm">
                                                                <tbody>
                                                                @if(count($rep2->whereIn('idGroup', $group->idGroup))>0)

                                                                    <div id="box1" style="position: absolute; right: 1%; top: 1%; border: 1px solid darkgrey; border-radius: 15px; width: 66%;  vertical-align: middle;">
                                                                        <img id="img_delay" src="/images/deathlineSub.png" style="width: 30px; height: 30px; float: left; margin:1%;">
                                                                        <div id="timer3"></div>
                                                                    </div>

                                                                    <style>
                                                                        #titleFiles{
                                                                            text-align: left;
                                                                        }


                                                                        #timer3 {
                                                                            font-size: 1.0em;
                                                                            color: black;
                                                                            vertical-align: middle;
                                                                            text-align: center;
                                                                        }

                                                                        #timer3 div {
                                                                            display: inline-block;
                                                                            min-width: 35px;

                                                                        }

                                                                        #timer3 p {
                                                                            margin: 2%;
                                                                        }

                                                                        #timer3 div span {
                                                                            color: black;
                                                                            display: block;
                                                                            font-size: .60em;
                                                                            font-weight: 400;
                                                                        }
                                                                        @media screen and (max-width: 1350px) {
                                                                            #timer3 {
                                                                                font-size: 0.7em;
                                                                            }
                                                                            #img_delay{
                                                                                display: none;
                                                                            }
                                                                        }
                                                                        @media screen and (max-width: 748px) {
                                                                            #box1{
                                                                            display: none
                                                                            }
                                                                        }
                                                                    </style>
                                                                    <script>

                                                                        function updateTimer3() {
                                                                            future = Date.parse("{{$project->dueDate}}");
                                                                            now = Date.parse("{{$rep2->whereIn('idGroup', $group->idGroup)->first()->submissionTime}}");
                                                                            diff = Math.abs(future - now);

                                                                            days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                                                            hours = Math.floor(diff / (1000 * 60 * 60));
                                                                            mins = Math.floor(diff / (1000 * 60));
                                                                            secs = Math.floor(diff / 1000);

                                                                            d = days;
                                                                            h = hours - days * 24;
                                                                            m = mins - hours * 60;
                                                                            s = secs - mins * 60;

                                                                            if (now>future){
                                                                                $('#box1').css('border', '1.5px solid red');
                                                                                $('#box1').css('background-color', '#ff000042');
                                                                                $('#box1').css('width', '66%');

                                                                                document.getElementById("timer3")
                                                                                    .innerHTML = '<p style="float: left;">{{__('gx.submWithDelay')}}</p>'+
                                                                                    '<div>' + d + '<span>{{__('gx.days')}}</span></div>' +
                                                                                    '<div>' + h + '<span>{{__('gx.hours')}}</span></div>' +
                                                                                    '<div>' + m + '<span>{{__('gx.minutes')}}</span></div>';


                                                                            }else{

                                                                                $('#box1').css('border', '1.5px solid #61af61');
                                                                                $('#box1').css('background-color', '#bbf5bb');
                                                                                $('#box1').css('width', '44%');
                                                                                document.getElementById("timer3")
                                                                                    .innerHTML =
                                                                                    '<p>{{__('gx.submWithSucc')}}</p>';

                                                                            }
                                                                        }
                                                                        updateTimer3();
                                                                    </script>
                                                                    @foreach($rep2->whereIn('idGroup', $group->idGroup) as $docSub)
                                                                        <tr>
                                                                            @if((pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "txt")
                                                                                <td style="width: 5%;"><i class="fad fa-file-alt fa-2x pr-2"  id= '{{$docSub->idFile}}'></i></td>
                                                                            @elseif((pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "jpg" or (pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "jpeg" or (pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "png")
                                                                                <td style="width: 5%;"><i class="fad fa-file-image fa-2x pr-2"  id= '{{$docSub->idFile}}'></i></td>
                                                                            @elseif((pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "pdf" )
                                                                                <td style="width: 5%;"><i class="fad fa-file-pdf fa-2x pr-2"  id= '{{$docSub->idFile}}'></i></td>
                                                                            @elseif((pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "docx" )
                                                                                <td style="width: 5%;"><i class="fad fa-file-word fa-2x pr-2"  id= '{{$docSub->idFile}}'></i></td>
                                                                            @elseif((pathinfo($docSub->pathFile, PATHINFO_EXTENSION)) == "zip" )
                                                                                <td style="width: 5%;"><i class="fad fa-file-archive fa-2x pr-2"  id= '{{$docSub->idFile}}'></i></td>
                                                                            @else
                                                                                <td style="width: 5%;"><i class="fad fa-file-code fa-2x pr-2"  id= '{{$docSub->idFile}}'></i></td>
                                                                            @endif
                                                                            <td><a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$docSub->pathFile)}}" target="_blank" class="downloadFile" download>{{$docSub->pathFile}}</a></td>
                                                                            <td>{{$docSub->submissionTime}}</td>
                                                                            <td id="{{$docSub->pathFile}}-size">
                                                                            </td>
                                                                                <script>
                                                                                    document.getElementById('{{$docSub->pathFile}}-size').innerHTML = bytesToHuman({{Storage::size('studentRepository/'.$group->idGroup.'/'.$docSub->pathFile)}}) ;
                                                                                </script>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <p>{{__('gx.noFilesSub')}}</p>

                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="final_row" class="row pt-2 rounded h-50" >
                                                    <style>
                                                        #final_row{

                                                        }

                                                    @media screen and (max-width: 991px){
                                                        #final_row {
                                                            padding-bottom: 5%;
                                                        }
                                                    }
                                                    @media screen and (max-width: 628px){
                                                        #final_row {
                                                            padding-bottom: 0%;
                                                        }
                                                    }
                                                </style>
                                                <div class=" bg-light p-2 w-100 rounded " style="height: 33vh">
                                                    <h5>{{__('gx.final group evaluation')}}</h5>
                                                    @if($group->grade != null)
                                                        <script>
                                                            $('#pills-{{$group->idGroupProject}}-tab-image').css('display','block');
                                                        </script>
                                                    @endif
                                                    @if ($group->grade == NULL and $project->dueDate <= date("Y-m-d H:i:s"))
                                                        <p class="mb-0">{{__('gx.group not evaluated')}}</p>
                                                        <style>
                                                            #par_eval{
                                                                padding-bottom: 100%;!important;
                                                            }
                                                        </style>
                                                        <button type="button" class="btn btn-md btn-primary stopYear" style=" position: absolute; bottom: 0; right: 0; margin-right: 2%; margin-bottom: 2%;"  data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}"><i class="far fa-medal mr-2"></i>{{__('gx.evaluate group')}}</button>

                                                            @if($subject->academicYear == $currentYear)
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
                                                                                    {{Form::number('grade', '', ['class' => 'form-control', 'step'=>'any', 'min'=>0,'max'=>$project->maxGrade])}}
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    {{Form::label('gradeComment', trans('gx.comment(opcional)'))}}
                                                                                    {{Form::textArea('gradeComment', '', ['class' => 'form-control', 'maxlength' => 500, 'rows' =>4 ])}}
                                                                                </div>
                                                                                {{Form::hidden('group', $group->idGroup)}}
                                                                                {{Form::hidden('option', 'grade')}}
                                                                                {{Form::hidden('project', $project->idProject)}}
                                                                                {{Form::button('<i class="fas fa-check mr-2"></i>'.trans('gx.submit'), ['type' => 'submit', 'class' => 'btn btn-success btn-sm float-right'])}}


                                                                                {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @elseif($group->grade != NULL and $project->dueDate <= date("Y-m-d H:i:s"))
                                                        <p class="mb-0">{{__('gx.grade')}}: {{$group->grade}}/{{$project->maxGrade}}</p>
                                                        @if($group->gradeComment == NULL)
                                                            <p class="m-0">{{__('gx.no comments')}}</p>
                                                        @else
                                                            <p class="mb-0 p-1 rounded" style=" overflow: auto; height: 43%; background-color: #d0e7ff; margin-top: 2%;" >{{$group->gradeComment}}</p>
                                                        @endif
                                                        <button id="changegrade" type="button" class=" btn btn-primary btn-md float-right stopYear" data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}" ><i class="far fa-medal mr-2"></i>{{__('gx.change grade')}}</button>
                                                        <style>
                                                            #changegrade{
                                                                position: absolute;
                                                                bottom: 0;
                                                                right: 0;
                                                                margin-right: 2%;
                                                                margin-bottom: 2%;
                                                            }
                                                            @media screen and (max-width: 991px){
                                                                #changegrade {
                                                                    bottom: 7%;
                                                                }
                                                            }
                                                            @media screen and (max-width: 500px){
                                                                #changegrade {
                                                                    right: 2%;
                                                                }
                                                            }
                                                        </style>

                                                            @if($subject->academicYear == $currentYear)
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
                                                                                    {{Form::number('grade', $group->grade, ['class' => 'form-control', 'step'=>'any', 'min'=>0,'max'=>$project->maxGrade])}}
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    {{Form::label('gradeComment', trans('gx.comment(opcional)'))}}
                                                                                    {{Form::textArea('gradeComment', $group->gradeComment , ['class' => 'form-control', 'maxlength' => 500, 'rows' =>4])}}
                                                                                </div>
                                                                                {{Form::hidden('group', $group->idGroup)}}
                                                                                {{Form::hidden('_method','PUT')}}
                                                                                {{Form::hidden('option', 'grade')}}
                                                                                {{Form::button('<i class="fas fa-check mr-2"></i>'.trans('gx.submit'), ['type' => 'submit', 'class' => 'btn btn-success btn-sm float-right'])}}

                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        @else
                                                            <p class="mb-0">{{__('gx.group cant evaluate')}}</p>
                                                            <button type="button" disabled class=" btn btn-md btn-primary stopYear" style="position: absolute;  bottom: 0; right: 0;  margin-right: 2%; margin-bottom: 2%;"  data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}">{{__('gx.evaluate group')}}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                    @media screen and (max-width: 500px){
                                                        #col3_groups {
                                                        }
                                                        #altura_col_groups_prof{
                                                        }
                                                    }
                                                </style>

                                            </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <button type="button" class=" mt-3 mr-3 btn btn-md btn-primary float-right stopYear" data-toggle="modal" data-target="#modalCreatePost"><i class="fas fa-plus mr-2"></i>{{__('gx.create post')}}</button>

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
                                    <td style="vertical-align: middle;"><a href="/professor/project/{{$project->idProject}}/post/{{$announcements[$i]->idAnnouncement}}">{{$announcements[$i]->title}}</a></td>
                                    <td style="vertical-align: middle;">
                                        <a href="/profile/{{$userPoster[$i]->id }}"><img id="img_forum" class="editable img-responsive" style="border-radius: 100%; height: 35px; width: 35px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$userPoster[$i]->photo)}}"><span style="vertical-align: middle;"> {{$userPoster[$i]->name}}</span></a>
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
                            <span>{{__('gx.showing')}} {{$a->firstItem()}} {{__('gx.to')}} {{$a->lastItem()}} {{__('gx.of')}} {{$a->total()}} {{__('gx.posts')}}</span>
                            {{$a->links()}}
                        </div>
                    @endif
                </div>

                @if($subject->academicYear == $currentYear)
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
                                <div class="modal-body modal-body-post">
                                    {!! Form::open(['action' => ['PostController@store', $project -> idProject], 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {{Form::label('title', trans('gx.title'))}}
                                        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('body', trans('gx.body'))}}
                                        {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body'])}}
                                    </div>

                                    <div class="demo-update__controls">
                                        <span class="demo-update__words"></span>
                                        <svg class="demo-update__chart" viewbox="0 0 40 40" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                                            <circle stroke="hsl(0, 0%, 93%)" stroke-width="3" fill="none" cx="20" cy="20" r="17" />
                                            <circle class="demo-update__chart__circle" stroke="hsl(202, 92%, 59%)" stroke-width="3" stroke-dasharray="134,534" stroke-linecap="round" fill="none" cx="20" cy="20" r="17" />
                                            <text class="demo-update__chart__characters" x="50%" y="50%" dominant-baseline="central" text-anchor="middle"></text>
                                        </svg>
                                    </div>
                                    {{ Form::hidden('project', $project->idProject) }}
                                    {{Form::button('<i class="fas fa-check mr-2"></i>'.trans('gx.submit'), ['type' => 'submit', 'class' => 'btn btn-success btn-sm mt-2 float-right update__send'])}}
                                    {!! Form::close() !!}
                                </div>
                                <script>
                                    const maxCharacters = 800;
                                    const container = document.querySelector( '.modal-body-post' );
                                    const progressCircle = document.querySelector( '.demo-update__chart__circle' );
                                    const charactersBox = document.querySelector( '.demo-update__chart__characters' );
                                    const wordsBox = document.querySelector( '.demo-update__words' );
                                    const circleCircumference = Math.floor( 2 * Math.PI * progressCircle.getAttribute( 'r' ) );
                                    const sendButton = document.querySelector( '.update__send' );

                                    ClassicEditor
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
                                                    'link',
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
                                            wordCount: {
                                                onUpdate: stats => {
                                                    // Prints the current content statistics.
                                                    //console.log( `Characters: ${ stats.characters }\nWords: ${ stats.words }` );

                                                    const charactersProgress = stats.characters / maxCharacters * circleCircumference;
                                                    const isLimitExceeded = stats.characters > maxCharacters;
                                                    const isCloseToLimit = !isLimitExceeded && stats.characters > maxCharacters * .8;
                                                    const circleDashArray = Math.min( charactersProgress, circleCircumference );

                                                    // Set the stroke of the circle to show how many characters were typed.
                                                    progressCircle.setAttribute( 'stroke-dasharray', `${ circleDashArray },${ circleCircumference }` );

                                                    // Display the number of characters in the progress chart. When the limit is exceeded,
                                                    // display how many characters should be removed.
                                                    if ( isLimitExceeded ) {
                                                        charactersBox.textContent = `-${ stats.characters - maxCharacters }`;
                                                    } else {
                                                        charactersBox.textContent = stats.characters;
                                                    }

                                                    wordsBox.textContent = `{{__('gx.words in the post')}}: ${ stats.words }`;

                                                    // If the content length is close to the character limit, add a CSS class to warn the user.
                                                    container.classList.toggle( 'demo-update__limit-close', isCloseToLimit );

                                                    // If the character limit is exceeded, add a CSS class that makes the content's background red.
                                                    container.classList.toggle( 'demo-update__limit-exceeded', isLimitExceeded );

                                                    // If the character limit is exceeded, disable the send button.
                                                    sendButton.toggleAttribute( 'disabled', isLimitExceeded );

                                                }
                                            }
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
                @endif
            </div>
        </div>
    </div>
</div>
<style>
    h5{
        text-align: center;
    }


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
    .nav-tabs .nav-link{
        color: #2c3fb1;
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

    .demo-update__controls {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .demo-update__chart {
        margin-right: 1em;
    }

    .demo-update__chart__circle {
        transform: rotate(-90deg);
        transform-origin: center;
    }

    .demo-update__chart__characters {
        font-size: 13px;
        font-weight: bold;
    }

    .demo-update__words {
        flex-grow: 1;
        opacity: .5;
    }

    .demo-update__limit-close .demo-update__chart__circle {
        stroke: hsl( 30, 100%, 52% );
    }

    .demo-update__limit-exceeded .ck.ck-editor__editable_inline {
        background: hsl( 0, 100%, 97% );
    }

    .demo-update__limit-exceeded .demo-update__chart__circle {
        stroke: hsl( 0, 100%, 52% );
    }

    .demo-update__limit-exceeded .demo-update__chart__characters {
        fill: hsl( 0, 100%, 52% );
    }

    #showGroups{
        color: #007bff;
    }

    #showGroups:hover{
        text-decoration: underline;
        cursor: default;
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
        if(id == "gr"){
            if(pills !== undefined) {
                sessionStorage.setItem("professorProject", "#"+id + "." + pills);
                $('#pills-tab a[href="#' + pills + '"]').tab('show');

            }else{
                sessionStorage.setItem("professorProject", "#"+id + "." + "pills-1");
                $('#pills-tab a[href="#pills-1"]').tab('show');
            }
        }else{
            sessionStorage.setItem("professorProject", "#"+id);
        }
        setTimeout(function() {
            window.scrollTo(0, 0);
        }, 1);
    });

    $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        pills = id;
        sessionStorage.setItem("professorProject", "#gr."+pills);
        setTimeout(function() {
            window.scrollTo(0, 0);
        }, 1);
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    if(hash === '' && sessionStorage.getItem("professorProject") === null){
        hash = '#characteristics';
        sessionStorage.setItem("professorProject", '#characteristics');
    } else if (hash !== '' && sessionStorage.getItem("professorProject") === null){
        sessionStorage.setItem("studentProject", hash);
    } else if (hash === '' && sessionStorage.getItem("professorProject") !== null){
        hash = sessionStorage.getItem("professorProject");
    }

    if(hash.split(".")[0] == '#gr'){
        pills = hash.split(".")[1];
        $('#myTab a[href="' + hash.split(".")[0] + '"]').tab('show');
    }else{
        $('#myTab a[href="' + hash + '"]').tab('show');
    }
    window.location.hash = "";
    setTimeout(function() {
        window.scrollTo(0, 0);
    }, 1);


    $('.deleteFile').click(function(){
        $('input[name="idDoc"]').val($(this).attr("id"));
        $('#modalDeleteDoc').modal('show');
    });

    function reloadPage(link) {
        window.location.assign(link);
        window.location.reload();
    };

    subjectYear = '{{$subject->academicYear}}';
    currentYear = sessionStorage.getItem("currentYear").replace("\\","");

    if(subjectYear != currentYear){
        console.log(subjectYear);
        console.log(currentYear);
        $(".stopYear").prop('disabled', true);
    }

    $("#minNumber").change(function () {
        var minNumber = parseInt(this.value);
        var maxSelected = parseInt($('#maxNumber').val());
        var options='';
        for(i = minNumber; i <= 10; i++){
            options+='<option value="'+i+'">'+i+'</option>';
        }
        $("#maxNumber").empty().append(options);
        if (minNumber <= maxSelected) {
            $("#maxNumber").val(maxSelected);
        }
    });

    $("#maxNumber").change(function () {
        var maxNumber = parseInt(this.value);
        var minSelected = parseInt($('#minNumber').val());
        var options='';
        for(i = 1; i <= maxNumber; i++){
            options+='<option value="'+i+'">'+i+'</option>';
        }
        $("#minNumber").empty().append(options);
        if (minSelected <= maxNumber) {
            $("#minNumber").val(minSelected);
        }
    });
</script>
@endsection
