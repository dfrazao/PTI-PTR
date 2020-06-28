@extends('layouts.app')
@section('content')
<head>
    <title>Project</title>
</head>
<div class="container-fluid pl-4 pr-4 pb-2 mt-3">
    @include('layouts.messages')
    <nav id="breadcrumb" aria-label="breadcrumb" >
        <ol id="breadcrumb" class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
            <li id="bc1" class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
            <li id="bc2" class="breadcrumb-item " aria-current="page" >{{$subject->subjectName}} - {{$project->name}} - Group {{$idGroup}}</li>
            <div style="display:flex;text-align: center;align-items: center;margin-bottom:0; right:0;" class="h5 ml-auto">
                <div id="timer2-{{$project->idProject}}" class="timer"></div>
                <i class="fal fa-lg fa-flag-checkered float-left pl-2"></i>
            </div>
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
            <div id="modalLeaveGroup" class="modal" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="display: inline" >
                            <h5>{{__('gx.surelvgroup')}}</h5>
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

    <div class="tab-content pb-3 ml-0 mr-0" id="myTabContent" style="min-height: 75vh; background-color: #ededed;">
        <div class="container-fluid fade tab-pane " id="content" role="tabpanel" aria-labelledby="content-tab">
            <div id="row1" class="row rounded">
                <style>
                    #row1{
                        height: 80vh;
                    }
                    @media screen and (max-width: 1300px) {
                        #row1 {
                            height: 100%;
                        }
                    }
                        @media screen and (max-width: 700px) {
                            #row1 {
                                height: 100%;
                            }
                        }
                        @media screen and (max-width: 500px) {
                            #row1 {
                                height: 100%;
                            }
                        }

                </style>
                <div id="1col" class="col-lg-5 mt-3">
                    <div class="container-fluid rounded h-100 pt-2" style="background-color: #c6c6c6;padding-bottom: 20%;">
                        <h5 class="text-center">{{__('gx.repo')}}</h5>
                        <div>
                            <table class="table table-sm fixed_header">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">{{__('gx.fileName')}}</th>
                                    <th scope="col">{{__('gx.user')}}</th>
                                    <th scope="col">{{__('gx.date')}}</th>
                                    <th scope="col"></th>
                                </tr>

                                </thead>
                                <tbody>
                                    @if(count($rep)>0)
                                        @foreach($rep as $file)
                                            @if((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "txt")
                                                <tr class="file" id="{{$file->idFile}}">
                                                    <td id="filename" style="overflow-wrap: break-word"><i class="fad fa-file-alt pr-2" id= '{{$file->idFile}}'></i>{{$file->pathFile}}</td>
                                                    <td>{{$file->userUpload}}</td>
                                                    <td>{{$file->uploadTime}}</td>
                                                    <td>
                                                        <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="" id= '{{$file->idFile}}' class="close downloadFile" download>
                                                            <span class="dot" id="download" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                            </span>
                                                        </a>
                                                        <button style="" id= '{{$file->idFile}}' type="button" class="close deleteFile">
                                                            <span class="dot" id="delete" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "jpg" or (pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "jpeg" or (pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "png")
                                                <tr class="file" id="{{$file->idFile}}">
                                                    <td id="filename" style="overflow-wrap: break-word"><i class="fas fa-image pr-2"  id= '{{$file->idFile}}'></i>{{$file->pathFile}}</td>
                                                    <td >{{$file->userUpload}}</td>
                                                    <td>{{$file->uploadTime}}</td>
                                                    <td>
                                                        <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="" id= '{{$file->idFile}}' class="close downloadFile" download>
                                                            <span class="dot" id="download" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                            </span>
                                                        </a>
                                                        <button style="" id= '{{$file->idFile}}' type="button" class="close deleteFile ">
                                                            <span class="dot" id="delete" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "pdf" )
                                                <tr class="file" id="{{$file->idFile}}">
                                                    <td id="filename" style="overflow-wrap: break-word"><i class="fal fa-file-pdf pr-2"  id= '{{$file->idFile}}'></i>{{$file->pathFile}}</td>
                                                    <td>{{$file->userUpload}}</td>
                                                    <td>{{$file->uploadTime}}</td>
                                                    <td>
                                                        <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="" id= '{{$file->idFile}}' class="close downloadFile" download>
                                                            <span class="dot" id="download" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                            </span>
                                                        </a>
                                                        <button style="" id= '{{$file->idFile}}' type="button" class="close deleteFile">
                                                            <span class="dot" id="delete" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "docx" )
                                                <tr class="file" id="{{$file->idFile}}">
                                                    <td id="filename" style="overflow-wrap: break-word"><i class="fal fa-file-word pr-2"  id= '{{$file->idFile}}'></i>{{$file->pathFile}}</td>
                                                    <td>{{$file->userUpload}}</td>
                                                    <td>{{$file->uploadTime}}</td>
                                                    <td>
                                                        <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="" id= '{{$file->idFile}}' class="close downloadFile" download>
                                                            <span class="dot" id="download" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                            </span>
                                                        </a>
                                                        <button style="" id= '{{$file->idFile}}' type="button" class="close deleteFile">
                                                            <span class="dot" id="delete" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "zip" )
                                                <tr class="file" id="{{$file->idFile}}">
                                                    <td id="filename" style="overflow-wrap: break-word"><i class="fal fa-file-archive pr-2" id= '{{$file->idFile}}'></i>{{$file->pathFile}}</td>
                                                    <td >{{$file->userUpload}}</td>
                                                    <td>{{$file->uploadTime}}</td>
                                                    <td>
                                                        <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="" id= '{{$file->idFile}}' class="close downloadFile" download>
                                                            <span class="dot" id="download" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                            </span>
                                                        </a>
                                                        <button style="" id= '{{$file->idFile}}' type="button" class="close deleteFile">
                                                            <span class="dot" id="delete" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @else
                                                <tr class="file" id="{{$file->idFile}}">
                                                    <td id="filename" style="overflow-wrap: break-word"><i class="fal fa-file-code pr-2"  id= '{{$file->idFile}}'></i>{{$file->pathFile}}</td>
                                                    <td >{{$file->userUpload}}</td>
                                                    <td>{{$file->uploadTime}}</td>
                                                    <td>
                                                        <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style="" id= '{{$file->idFile}}' class="close downloadFile" download>
                                                            <span class="dot" id="download" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                                            </span>
                                                        </a>
                                                        <button style="" id= '{{$file->idFile}}' type="button" class="close deleteFile ">
                                                            <span class="dot" id="delete" style="position:relative">
                                                                <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No files uploaded!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{--<div class="container text-center">
                            {!!Form::open(['action' => ['StudentProjectsController@store', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data','files' => true, 'class' => "dropzone dz-clickable p-0", 'id'=>"dropzone" , 'style'=>"min-height: 0 !important; height:15vh; border: 3px dotted black;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius: 5px;opacity:0.5;"])!!}
                            @csrf
                            <div class="dz-message m-0 pt-2">
                                <i class="fal fa-file-plus fa-3x px-2"><p style="font-size: medium;"> {{__('gx.dropclickdownload')}}</p></i>
                            </div>
                            <script type="text/javascript">
                                Dropzone.options.dropzone = {
                                    init: function () {
                                        // Set up any event handlers
                                        this.on('complete', function () {
                                            location.reload();

                                        });
                                        this.on("error", function(file, message, xhr) {
                                            var header = xhr.status+": "+xhr.statusText;
                                            $(file.previewElement).find('.dz-error-message').text(header);
                                        });
                                    },
                                    maxFilesize: 25,
                                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.zip,.docx,.txt,.py,.html,.css,.js",
                                };
                            </script>
                            {{ Form::hidden('group', $idGroup) }}
                            {{ Form::hidden('project', $project->idProject) }}
                            {{ Form::hidden('subject', $subject->subjectName) }}
                            {{Form::hidden('submission','newFile')}}

                            {!!Form::close()!!}
                        </div>--}}
                        {{--@foreach($rep as $file)
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
                                @if((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "txt")
                                    <figure>
                                        <i class="fad fa-file-alt fa-4x p-2" style= "border:transparent;" id= '{{$file->idFile}}'></i>
                                        <figcaption style="overflow-wrap: break-word; ">{{$file->pathFile}}</figcaption>
                                    </figure>
                                @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "jpg" or (pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "jpeg" or (pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "png")
                                    <figure>
                                        <i class="fas fa-image fa-4x p-2" style= "border: 1px solid transparent;" id= '{{$file->idFile}}'></i>
                                        <figcaption style="overflow-wrap: break-word; ">{{$file->pathFile}}</figcaption>
                                    </figure>
                                @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "pdf" )
                                    <figure>
                                        <i class="fal fa-file-pdf fa-4x p-2" style= "border:transparent;" id= '{{$file->idFile}}'></i>
                                        <figcaption style="overflow-wrap: break-word; ">{{$file->pathFile}}</figcaption>
                                    </figure>
                                @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "docx" )
                                    <figure>
                                        <i class="fal fa-file-word fa-4x p-2" style= "border:1px solid transparent;" id= '{{$file->idFile}}'></i>
                                        <figcaption style="overflow-wrap: break-word; ">{{$file->pathFile}}</figcaption>
                                    </figure>
                                @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "zip" )
                                    <figure>
                                        <i class="fal fa-file-archive fa-4x p-2" id= '{{$file->idFile}}'></i>
                                        <figcaption style="overflow-wrap: break-word;">{{$file->pathFile}}</figcaption>
                                    </figure>
                                @else
                                    <figure>
                                        <i class="fal fa-file-code fa-4x p-2" id= '{{$file->idFile}}'></i>
                                        <figcaption style="overflow-wrap: break-word;">{{$file->pathFile}}</figcaption>
                                    </figure>


                                @endif


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
                                        init: function () {
                                            // Set up any event handlers
                                            this.on('complete', function () {
                                                location.reload();

                                            });
                                        },
                                        maxFilesize: 12,
                                        acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.zip,.docx,.txt,.py,.html,.css,.js",
                                    };
                                </script>
                                {{ Form::hidden('group', $idGroup) }}
                                {{ Form::hidden('project', $project->idProject) }}
                                {{ Form::hidden('subject', $subject->subjectName) }}
                                {{Form::hidden('submission','newFile')}}

                                {!!Form::close()!!}
                            </div>--}}
                        <button type="submit" disabled class="btn btn-sm" id='submitFile' data-toggle="modal" data-target="#modalSubmitFile" style="width:20vh;background: #2c3fb1; color: white; position: absolute; bottom: 7px; right: 22px;">{{__('gx.submit')}}</button>
                        <button type="button" class="p-2 btn btn-primary btn-sm stopYear" data-toggle="modal" data-target="#modalAddFile" style="position: absolute; bottom: 0; right: 22vh;" data-toggle="modal">{{__('gx.upload files')}}</button>

                        {{-- Modal Submit File --}}
                        <div class="modal fade" id="modalSubmitFile" aria-labelledby="modalSubmitFile" aria-hidden="true" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.subFileEval')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>{{__('gx.sureSubFile')}}</h5>
                                        {!!Form::open(['action' => ['StudentProjectsController@update', $project->idProject], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])!!}
                                        <div class="filesSelected" style="padding:10px;"></div>
                                        {{ Form::hidden('filesSubmit', 'files') }}
                                        {{ Form::hidden('group', $idGroup) }}
                                        {{ Form::hidden('project', $project->idProject) }}
                                        {{ Form::hidden('subject', $subject->subjectName) }}
                                        {{ Form::hidden('submission','submitFile')}}
                                        {{ Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary'])}}

                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Add File --}}
                        <div class="modal fade" id="modalAddFile" aria-labelledby="modalAddFile" aria-hidden="true" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.addFileRepo')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['action' => 'StudentProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                        {{Form::file('file[]', ['multiple' => 'multiple'])}}



                                        {{ Form::hidden('group', $idGroup) }}
                                        {{ Form::hidden('project', $project->idProject) }}
                                        {{ Form::hidden('subject', $subject->subjectName) }}
                                        {{Form::hidden('submission','newFile')}}

                                    </div>
                                    <div class="modal-footer">
                                        {{Form::submit(trans('gx.uploadFile'), ['class'=>'btn btn-primary'])}}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="2col"  class="col-lg-3 mt-3 rounded pl-0" >
                    <div id="col_groups" class="container-fluid rounded text-center h-100 pt-2" style="background-color: #c6c6c6;">
                        <h5>{{__('gx.group').' '. $idGroup}}</h5>
                        <div style="overflow: auto; max-height: 40vh">
                            <table>
                                @foreach($groupUsers as $user)
                                    <tr>
                                        <td><img class="profilePhoto" style="border-radius: 100%; width: 50px; height: 50px; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}"></td>
                                        <td><a href="/profile/{{$user->id}}">{{$user->name}} - {{$user->uniNumber}}</a></td>
                                        <td><i class="fa fa-envelope float-right"></i></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <h5>Professors</h5>
                        <div style="overflow: auto; max-height: 30vh">
                            <table>
                                @foreach($professores as $prof)
                                    <tr class="pb-1">
                                        <td><img class="profilePhoto" style="border-radius: 100%; width: 50px; height: 50px; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}"></td>
                                        <td><a href="/profile/{{$prof->id}}">{{$prof->name}} - {{$prof->uniNumber}}</a></td>
                                        <td><i class="fa fa-envelope float-right"></i></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <style>
                        #2col{

                        }

                        @media screen and (max-width: 500px) {
                            #2col{
                                margin-left: 15px;
                            }

                        }
                    </style>
                </div>
                <div id="3col" class="col-lg-4 mt-3">
                    <div id="col_notes" class="row rounded h-50 pr-3">
                        <div class="container-fluid rounded notes pt-2" style="background-color: #ffe680; " >
                            <h5 class="text-center">{{__('gx.notes')}}</h5>
                            {!! Form::open(['action' => ['StudentProjectsController@store', $project -> idProject], 'method' => 'POST', 'id'=>'notesForm']) !!}
                            @csrf
                            {{Form::textarea('notes', $notes, ['class' => 'form-control', 'id'=>'textarea-notes', 'rows'=>'8', 'maxlength' => 500])}}
                            {{Form::hidden('group',$idGroup)}}
                            {{Form::hidden('submission','notes')}}
                            {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary d-none', 'id'=>'notesButton'])}}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div id="col_docs" class="row rounded h-50 pt-3 pr-3">
                        <div class="container-fluid rounded text-center pt-2" style="background-color: #c6c6c6; ">
                            <h5>{{__('gx.documentation')}} </h5>
                            @if(count($docs) == 0)
                                <p>The professor hasn't uploaded any file</p>
                            @else
                                <div style="overflow:auto; max-height:30vh;">
                                    <table>
                                    @foreach($docs as $d)
                                        <tr>
                                            @if((pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "txt")
                                                <td><i class="fad fa-file-alt fa-2x"></i></td>
                                            @elseif((pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "jpg" or (pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "jpeg" or (pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "png")
                                                <td><i class="fas fa-image fa-2x"></i></td>
                                            @elseif((pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "pdf" )
                                                <td><i class="fal fa-file-pdf fa-2x"></i></td>
                                            @elseif((pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "docx" )
                                                <td><i class="fal fa-file-word fa-2x"></i></td>
                                            @elseif((pathinfo($d->pathFile, PATHINFO_EXTENSION)) == "zip" )
                                                <td><i class="fal fa-file-archive fa-2x"></i></td>
                                            @else
                                                <td><i class="fal fa-file-code fa-2x"></i></td>
                                            @endif
                                            <td><a rel="noopener noreferrer" target="_blank" href ="{{Storage::url('documentation/'.$project->idProject.'/'.$d->pathFile)}}">{{$d->pathFile}}</a></td>
                                        </tr>
                                    @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <style>

                    /*#col_docs{
                        height: 38vh;
                        overflow: auto;
                    }*/
                    @media screen and (max-width: 1000px) {
                        #col_docs{
                            margin-left: 0.5%;
                            margin-bottom: 5%;
                        }
                        #col_notes{
                            margin-left: 0.8%;
                        }
                    }
                    @media screen and (max-width: 768px) {
                        #col_docs{
                            margin-left: 0.5%;
                            margin-bottom: 8%;
                        }
                        #col_notes{
                            margin-left: 0.8%;
                        }
                    }
                    @media screen and (max-width: 500px) {
                        #col_docs{
                            margin-left: 0.8%;
                            margin-bottom: 10%;
                        }
                        #col_notes{
                            margin-left: 0.8%;
                            margin-bottom: 5%;
                        }
                    }
                </style>
            </div>
            <div id="row2" class="row rounded">
                <div id="container_row2" class="container-fluid rounded mx-3 mt-3 p-2" style=" position: relative;">
                    <div class="form-group mb-0">
                        <div class="table-fixed">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr class="tasks_letra">
                                    <th>
                                        <div>
                                            <span class="full-text_task">{{__('gx.task')}}</span>
                                            <span class="short-text_task">Task</span>
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            <span class="full-text_task">{{__('gx.responsible')}}</span>
                                            <span class="short-text_task">Resp.</span>
                                        </div>
                                    </th>
                                    <th id="task_b">
                                        <div>
                                            <span class="full-text_task">{{__('gx.beginning')}}</span>
                                            <span class="short-text_task">{{__('gx.start')}}</span>
                                        </div>
                                    </th>
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
                                                    {{Form::text(trans('gx.description'), $t->description, ['class' => 'form-control'])}}
                                                </td>
                                                <td class="form-group">
                                                    <select class="form-control " name="responsible" id="responsible">
                                                        @foreach($groupUsers as $gu)
                                                            <option value="{{$gu->name}}">{{$gu->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="form-group" style="position:relative">
                                                    {{ Form::text(trans('gx.beginning'), $t->beginning ,['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker1-'.$t->idTask, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker1-'.$t->idTask])}}
                                                </td>
                                                <td class="form-group" style="position:relative">
                                                    {{ Form::text(trans('gx.end'), $t->end ,['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker2-'.$t->idTask, 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker2-'.$t->idTask])}}
                                                </td>
                                                <td class="form-group"></td>
                                                {{Form::hidden('submission', 'task')}}
                                                {{Form::hidden('task', $t->idTask) }}
                                                {{Form::hidden('group', $t-> idGroup)}}
                                                {{Form::hidden('_method','PUT')}}

                                                <td class="form-group float-right pr-0">{{Form::Submit(trans('gx.save'), ['class'=>'btn btn-sm mr-2 btn-success', 'style'=>"width: 10vh", 'id'=>'Save'])}}<button type="button" class="btn btn-sm btn-danger editTask">{{__('gx.cancel')}}</button></td>
                                            {!! Form::close() !!}
                                            <script>
                                                $(function() {$( "#datetimepicker1-{{$t->idTask}}" ).datetimepicker({
                                                    minDate: moment('{{(\Carbon\Carbon::now())}}').format('YYYY-MM-DD HH:mm:ss'),
                                                    date: moment('{{(\Carbon\Carbon::parse($t->beginning))}}').format('YYYY-MM-DD HH:mm'),
                                                    locale: "en",
                                                    icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"},
                                                    default: moment('{{(\Carbon\Carbon::parse($t->beginning))}}').format('YYYY-MM-DD HH:mm:ss')
                                                });});
                                                $(function() {$( "#datetimepicker2-{{$t->idTask}}" ).datetimepicker({
                                                    minDate: moment('{{(\Carbon\Carbon::parse($t->end))}}').format('YYYY-MM-DD HH:mm'),
                                                    date: moment('{{(\Carbon\Carbon::parse($t->end))}}').format('YYYY-MM-DD HH:mm'),
                                                    locale: "en",
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
                                                        {{Form::submit(trans('gx.delete'), ['class' => 'btn btn-danger'])}}
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
                                    /*#row2{
                                        padding-top: 2%;
                                    }*/
                                    .short-text_task { display: none; }


                                    @media (max-width: 800px) {
                                        .short-text_task { display: inline-block; }
                                        .full-text_task { display: none; }
                                    }
                                    #edit_tasks{
                                        width: 10vh;
                                    }
                                    #container_row2{
                                        background-color: #c6c6c6;
                                    }
                                    @media screen and (max-width: 500px) {
                                        #edit_tasks{
                                            margin-bottom: 5px;
                                        }

                                        .table{
                                            table-layout: auto;
                                        }
                                        #row2{
                                            margin-top: 20px;
                                        }
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
                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.deleteFile')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>{{__('gx.sureDelFile')}}</h5>
                        {!!Form::open(['action' => ['StudentProjectsController@destroy', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit(trans('gx.delete'), ['class' => 'btn btn-danger'])}}
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
                            {{Form::label('description', trans('gx.title'))}}
                            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Task title','maxlength' => 50])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('responsible', trans('gx.responsible'))}}
                            <select class="form-control " name="responsible" id="responsible">
                                @foreach($groupUsers as $gu)
                                    <option value="{{$gu->name}}">{{$gu->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <td class="form-group">
                            {{Form::label('beginning', trans('gx.beginning'))}}
                            {{ Form::text('beginning','',['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker', 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker'])}}
                        </td>
                        {{ Form::hidden('group', $idGroup) }}
                        {{ Form::hidden('project', $project->idProject) }}
                        {{ Form::hidden('subject', $subject->subjectName) }}
                        {{Form::hidden('submission','task')}}

                        {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary mt-2'])}}

                        {!! Form::close() !!}
                    </div>
                    <script>
                        $(function() {$( "#datetimepicker" ).datetimepicker({
                            minDate: moment().format('YYYY-MM-DD HH:mm'),
                            date: moment().format('YYYY-MM-DD HH:mm'),
                            locale: "en",
                            icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                        });});
                    </script>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab" style=" position: relative">
            <h5 id="titulo_groups" class="pt-2 text-center"><i class="fal fa-calendar-alt pr-2"></i>{{__('gx.group elements weekly availability')}}</h5>
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
            {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary d-none'])}}
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
                <div style="display:inline-flex;" class="h5 pt-2">
                    <i class="far fa-user-friends float-left"></i>
                    <div class="pl-2">{{__('gx.meetings')}}</div>
                </div>
                <div class="table-fixed">
                    <table class="table table-hover text-center">
                        <thead>
                        <tr>
                            <th id="meetings_font">{{__('gx.number')}}</th>
                            <th id="meetings_font">{{__('gx.description')}}</th>
                            <th id="meetings_font">{{__('gx.date')}}</th>
                            <th id="meetings_font">{{__('gx.place')}}</th>
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
                #meetings_font{
                    font-size: 1.5vh;
                }
            }

        </style>
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
                            {{Form::text('description', '', ['class' => 'form-control', 'maxlength' => 30])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('place', trans('gx.meeting place'))}}
                            {{Form::text('place', '', ['class' => 'form-control','maxlength' => 30])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('date', trans('gx.meeting date'))}}
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
                                        <a href="/profile/{{$userPoster[$i]->id }}"><img id="img_forum" class="editable img-responsive" style="border-radius: 100%; width: 35px; height: 35px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$userPoster[$i]->photo)}}"><span style="vertical-align: middle;"> {{$userPoster[$i]->name}}</span></a>
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
                            <span>{{__('gx.showing')}} {{$a->firstItem()}} {{__('gx.to')}} {{$a->lastItem()}} {{__('gx.of')}} {{$a->total()}} posts</span>
                            {{$a->links()}}
                        </div>
                    @endif
                </div>

                {{--Modal Create Post--}}
                <div class="modal fade" id="modalCreatePost" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.newPost')}}</h4>
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
                                    {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body', 'maxlength' => 900])}}
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

                                {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success update__send'])}}

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
            </div>
        </div>
        <div class="fade tab-pane  ml-0 mr-0" id="submission" role="tabpanel" aria-labelledby="submission-tab">
            <div class="row">
                <div class="col-lg-6">
                    <div class="container rounded pb-3 pt-3">
                        {{$last = null}}
                        @if($submittedFiles->count() > 0)
                            <div id="box1" style="position: absolute; right: 1%; top: 1%; height: 9%; border: 1px solid darkgrey; border-radius: 15px; width: 66%;  vertical-align: middle;">
                                <img src="/images/deathlineSub.png" style="width: 30px; height: 30px; float: left; margin:1%;">
                                <div id="timer3"></div>
                            </div>

                            <style>
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
                            </style>
                            <script>
                                @foreach($submittedFiles as $file)
                                    $last = {{$file->submissionTime}};
                                    @if($file->submissionTime > $last)
                                        $last = {{$file->submissionTime}};
                                    @endif
                                @endforeach

                                function updateTimer3() {
                                    future = Date.parse("{{$project->dueDate}}");
                                    now = Date.parse("{{$last}}");
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
                                            .innerHTML = '<p style="float: left;">Submetido com atraso de</p>'+
                                            '<div>' + d + '<span>days</span></div>' +
                                            '<div>' + h + '<span>hrs</span></div>' +
                                            '<div>' + m + '<span>mins</span></div>';


                                    }else{

                                        $('#box1').css('border', '1.5px solid #61af61');
                                        $('#box1').css('background-color', '#bbf5bb');
                                        $('#box1').css('width', '44%');
                                        document.getElementById("timer3")
                                            .innerHTML =
                                            '<p>Submetido com sucesso!</p>';

                                    }
                                }
                                updateTimer3();

                            @endif
                        </script>
                        <div style="display:flex;text-align: center;align-items: center;margin-bottom:0; right:0;" class="h5 ml-auto pt-2">
                            <i class='pl-1 far fa-lg fa-file-alt float-left'></i>
                            <div id="deadline" style="display: inline-flex" class="pl-3">{{__('gx.deadline')}}: {{$project->dueDate}}</div>
                        </div>
                        <?php
                            $last = \Carbon\Carbon::create(0, 0, 0, 0, 0, 0);
                            if($submittedFiles->count() > 0){
                                foreach($submittedFiles as $file){
                                    if($file->submissionTime > $last){
                                        $last = $file->submissionTime;

                                    }
                                }
                            }else{
                                $last = trans('gx.noFilesSubm');
                            }
                        ?>
                        <div style="display:flex;text-align: center;align-items: center;margin-bottom:0; right:0;" class="h5 ml-auto pt-4">
                            <i class="far fa-lg fa-clock float-left"></i>
                            <div style="display: inline-flex" class="pl-3"> {{__('gx.submTime')}}: @if($last != null){{$last}}@else trans('gx.noFilesSubm')@endif</div>

                        </div>
                        <div style="display:flex;text-align: center;align-items: center;margin-bottom:0; right:0;" class="h5 ml-auto pt-4">
                            <i class="pl-1 far fa-lg fa-file float-left"></i>
                            <div style="display: inline-flex" class="pl-3"> {__('gx.filesSubm')}}: @if(count($submittedFiles)==0)trans('gx.noFilesSubm') @endif</div>

                        </div>
                        <div class="container-fluid mt-3 pr-0 ml-2" id="submittedFiles" style="background-color: white">
                            @foreach($submittedFiles as $file)
                                <div class="text-center pt-2" id= '{{$file->idFile}}' style="margin-right: 15px; position:relative; display: inline-block; width: 100px;">
                                    <a href="{{Storage::url('studentRepository/'.$idGroup.'/'.$file->pathFile)}}" target="_blank" style=" z-index:2; position:absolute; top:-1px; right:10px;" id= '{{$file->idFile}}' class="close downloadFile" download>
                                        <span class="dot" id="download" style="position:relative; display:inline-block">
                                            <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-download"></i>
                                        </span>
                                    </a>
                                    <button style="position:absolute; top:-1px; right:-15px;" id= '{{$file->idFile}}' type="button" class="close removeFile">
                                        <span class="dot" id="delete" style="position:relative; display:inline-block; ">
                                            <i style="font-size: 15px; position:absolute; transform: translate(-50%, -50%); top:45%; left:50%; display:block;" class="fal fa-trash"></i>
                                        </span>
                                    </button>
                                    <figure>
                                        @if((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "txt")
                                            <i class="fad fa-file-alt fa-4x px-2" ></i>

                                        @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "jpg" or (pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "jpeg" or (pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "png")
                                            <i class="fas fa-image fa-4x px-2" ></i>

                                        @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "pdf" )
                                            <i class="fal fa-file-pdf fa-4x px-2" ></i>

                                        @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "docx" )
                                            <i class="fal fa-file-word fa-4x px-2"></i>

                                        @elseif((pathinfo($file->pathFile, PATHINFO_EXTENSION)) == "zip" )
                                            <i class="fal fa-file-archive fa-4x px-2" ></i>

                                        @else
                                            <i class="fal fa-file-code fa-4x px-2" ></i>
                                        @endif
                                        <figcaption>{{$file->pathFile}}</figcaption>
                                    </figure>
                                </div>
                                {{-- Modal Remove file --}}
                                <div class="modal fade" id="modalRemoveFile" aria-labelledby="modalRemoveFile" aria-hidden="true" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.removeFile')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{__('gx.sureRmvFile')}}</h5>
                                                {!!Form::open(['action' => ['StudentProjectsController@update', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                {{Form::submit(trans('gx.yes'), ['class' => 'btn btn-danger'])}}
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
                        <div style="display:flex;text-align: center;align-items: center;margin-bottom:0; right:0;" class="h5 ml-auto pt-2">
                            <i class="far fa-lg fa-medal float-left"></i>
                            <div style="display: inline-flex" class="pl-3"> Project grade: @if((\App\Group::find($idGroup))->grade != null) {{(\App\Group::find($idGroup))->grade}} valores @else Not graded @endif </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="container rounded pb-3 pt-3">
                        <h3>Group elements evaluation</h3>
                        @if($eval->count() > 0 && $eval->first()->status == 'submitted')
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>{{__('gx.success!')}}</strong> {{__('gx.evaluationSentSucc')}}
                            </div>
                        @else
                            <div class="StudentsEvaluation">
                                @foreach($studentEval as $user)
                                    {!! Form::open(['action' => ['StudentProjectsController@store', $project -> idProject], 'method' => 'POST']) !!}
                                    @if($user->id == Auth::user()->id)
                                    <h5>Autoavaliação:</h5>
                                <table>
                                    <tr>
                                        <td><img class="profilePhoto" style="border-radius: 100%; width: 50px; height: 50px; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}"></td>
                                        <td><a href="/profile/{{$user->id}}">{{$user->name}} - {{$user->uniNumber}}</a></td>
                                        <td>
                                            <div class="rating-{{$user->id}}" style="display:inline-flex;">
                                                <i class="fa fa-star" aria-hidden="true" id="s1"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s2"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s3"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s4"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s5"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <h5>Heteroavaliação</h5>
                                    @else
                                <table>
                                    <tr>
                                        <td><img class="profilePhoto" style="border-radius: 100%; width: 50px; height: 50px; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}"></td>
                                        <td><a href="/profile/{{$user->id}}">{{$user->name}} - {{$user->uniNumber}}</a></td>
                                        <td>
                                            <div class="rating-{{$user->id}}" style="display:inline-flex;">
                                                <i class="fa fa-star" aria-hidden="true" id="s1"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s2"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s3"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s4"></i>
                                                <i class="fa fa-star" aria-hidden="true" id="s5"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    {{ Form::hidden('project', $project->idProject) }}
                                </table>
                                    <script>
                                        @foreach($eval as $ev)
                                            @for($i=0;$i<=$ev->grade;$i++)
                                                $('div.rating-{{$ev->receiver}} #s{{$i}}').css('color','#ffce52');
                                            @endfor
                                        @endforeach
                                        var rating=0;
                                        $('div.rating-{{$user->id}} #s1').click(function(){
                                            $('div.rating-{{$user->id}} .fa-star').css("color","black");
                                            $('div.rating-{{$user->id}} #s1').css("color","#ffce52");
                                            rating=1;
                                        });
                                        $('div.rating-{{$user->id}} #s2').click(function(){
                                            $('div.rating-{{$user->id}} .fa-star').css("color","black");
                                            $('div.rating-{{$user->id}} #s1, div.rating-{{$user->id}} #s2').css("color","#ffce52");
                                            rating=2;
                                        });
                                        $('div.rating-{{$user->id}} #s3').click(function(){
                                            $('div.rating-{{$user->id}} .fa-star').css("color","black");
                                            $('div.rating-{{$user->id}} #s1, div.rating-{{$user->id}} #s2,div.rating-{{$user->id}} #s3').css("color","#ffce52");
                                            rating=3;
                                        });
                                        $('div.rating-{{$user->id}} #s4').click(function(){
                                            $('div.rating-{{$user->id}} .fa-star').css("color","black");
                                            $('div.rating-{{$user->id}} #s1,div.rating-{{$user->id}} #s2,div.rating-{{$user->id}} #s3,div.rating-{{$user->id}} #s4').css("color","#ffce52");
                                            rating=4;
                                        });
                                        $('div.rating-{{$user->id}} #s5').click(function(){
                                            $('div.rating-{{$user->id}} .fa-star').css("color","black");
                                            $('div.rating-{{$user->id}} #s1,div.rating-{{$user->id}} #s2,div.rating-{{$user->id}} #s3,div.rating-{{$user->id}} #s4, div.rating-{{$user->id}} #s5').css("color","#ffce52");
                                            rating=5;
                                        });
                                        $('div.rating-{{$user->id}} .fa-star').on('click',function() {

                                            $.ajax({
                                                url: "/student/project/{{$project->idProject}}",
                                                method: "POST",
                                                data: {
                                                    'group': {{$idGroup}},
                                                    'receiver': {{$user->id}},
                                                    'grade': rating,
                                                    'submission': 'studentsEvaluation',
                                                    '_token': $('input[name=_token]').val()
                                                },
                                                datatype: 'JSON'
                                            });
                                        });
                                        $('#submitEval').click(function() {
                                            $('.StudentsEvaluation').hide();
                                            $('.submitEval').addClass('d-none');
                                            $('#submitted').removeClass('d-none');
                                            $('#modalSubmitEvaluations').modal('hide');
                                            $.ajax({
                                                url: "/student/project/{{$project->idProject}}",
                                                method: "POST",
                                                data: {
                                                    'group': {{$idGroup}},
                                                    'receiver': {{$user->id}},
                                                    'grade': rating,
                                                    'status': 'submitted',
                                                    'submission': 'studentsEvaluationSubmission',
                                                    '_token': $('input[name=_token]').val()
                                                },
                                                datatype: 'JSON'
                                            });
                                        });
                                    </script>
                                    {{-- Modal Submit Evaluations --}}
                                    <div class="modal fade" id="modalSubmitEvaluations" aria-labelledby="modalSubmitEvaluations" aria-hidden="true" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.submitEvals')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>{{__('gx.sureSubmitEval')}}</h5>
                                                    <p>{{__('gx.makeChangesEvals')}}</p>
                                                    <button type="button" class="btn btn-success float-right" id="submitEval">{{__('gx.yes')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    {!! Form::close() !!}
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-primary submitEval float-right pt-2" data-toggle="modal" data-target="#modalSubmitEvaluations">{{__('gx.submit')}}</button>
                            <div class="alert alert-success alert-dismissible fade show d-none" id="submitted">
                                <strong>{{__('gx.success!')}}</strong> {{__('gx.evalSentSucc')}}
                            </div>
                        @endif
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

    #textarea-notes{
        width: 100%;
        height: 100%;
        resize: none;
        background-color: #ffe680;
        border: none;
    }
    #textarea-notes:focus{
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
        font-size: 1.7vh;
    }
    @media screen and (max-width: 800px){
        .grid-container > div {
            font-size: 1vh;
        }
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
    .fixed_header{
        height: 75%;
        table-layout: fixed;
        border: none;

    }

    .fixed_header tbody{
        display:block;
        width: 100%;
        overflow: auto;
        height: 40vh;
    }

    .fixed_header thead tr {
        display: block;
    }


    .fixed_header th{
        padding: 5px;
        text-align: center;
        width: 485px;
    }
    .fixed_header td {
        padding: 8px;
        text-align: left;
        table-layout: fixed;
    }
    .select{
        background-color: #e2e2e2;
    }
    .close{
        opacity: 1;
    }
    #delete {
        height: 25px;
        width: 25px;
        background-color: red;
        border-radius: 50%;
        display:inline-block;
        color:white;
    }
    #download {
        height: 25px;
        width: 25px;
        background-color: white;
        border-radius: 50%;
        display:inline-block;
        color: green;
    }
    /*form#dropzone.dropzone.dz-clickable {
        padding-bottom: 0px;
        padding-left: 0px;
        padding-top: 10px;
        padding-right: 0px;
        border-top-width: 0px;
        border-left-width: 0px;
        border-bottom-width: 0px;
        border-right-width: 0px;
        margin-bottom: 40px;
        width: 100px;
        height: 100px;
        min-height: 120px;
        background-color: transparent;
        border: 3px dotted black;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        opacity:0.5;
        z-index:2;
    }*/
    .file{
        cursor:pointer;
    }
    .timer {
        font-size: 1.30em;
        font-weight: 100;
        color: navy;
        display: inline-block;
        min-width: 45px;
    }

    .timer div {
        display: inline-block;
        min-width: 45px;
    }

    .timer div span {
        color: black;
        display: block;
        font-size: .30em;
        font-weight: 400;
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

    $('#textarea-notes').change( function() {
        datastring = {'notes':$('#textArea').val(), 'group': $('input[name=group]').val(), 'submission': $('#notesForm input[name=submission]').val(), '_token': $('input[name=_token]').val()}
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
            /*$(this).find("#download").css("display","none");
            $(this).find("#delete").css("display","none");*/
        }else{
            $(this).addClass('select');
            /*$(this).find('#download').css("display","inline-block");
            $(this).find('#delete').css("display","inline-block");*/
            $('#submitFile').removeAttr('disabled');
            }
        if($('.select').length == 0){
            $('#submitFile').attr('disabled','disabled');
        }
        });

    /*$(".file").hover(function() {
        $(this).find('#download').css("display","inline-block");
        $(this).find('#delete').css("display","inline-block");
    }, function() {
        if($($(this).find("figure i")).hasClass('select')){
            $(this).find('#download').css("display","inline-block");
            $(this).find('#delete').css("display","inline-block");
        }
        else{
            $(this).find("#download").css("display","none");
            $(this).find("#delete").css("display","none");
        }
    });*/

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
            var x = $(this).clone().removeClass('select').find('#filename').css('display','block').css('padding','5px').css('font-size','20px').attr('class', 'text-left').wrap('<p/>').parent().html();
            $('#modalSubmitFile .filesSelected').append(x);
        });
        $('input[name="filesSubmit"]').val(f);
    });

    $("#modalSubmitFile").on("hidden.bs.modal", function () {
        $('#modalSubmitFile .filesSelected').empty();
    });
    function updateTimer2{{$project->idProject}}() {
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

        if (d<0 || (d==0 && h==0 && m==0 && s==0)) {
            document.getElementById("timer2-{{$project->idProject}}").innerHTML = '<div class="ml-2">{{__("gx.finished")}}</div>';
        } else if (d==0 && h==0 && m==0) {
            document.getElementById("timer2-{{$project->idProject}}").innerHTML = '<div>' + s + '<span>{{__("gx.seconds")}}</span></div>';
        } else if (d==0) {
            document.getElementById("timer2-{{$project->idProject}}").innerHTML =
                '<div>' + h + '<span>{{__("gx.hours")}}</span></div>' +
                '<div>' + m + '<span>{{__("gx.minutes")}}</span></div>' +
                '<div>' + s + '<span>{{__("gx.seconds")}}</span></div>';
        } else {
            document.getElementById("timer2-{{$project->idProject}}").innerHTML =
                '<div>' + d + '<span>{{__("gx.days")}}</span></div>' +
                '<div>' + h + '<span>{{__("gx.hours")}}</span></div>' +
                '<div>' + m + '<span>{{__("gx.minutes")}}</span></div>';
        }
    }
    updateTimer2{{$project->idProject}}();
    setInterval('updateTimer2{{$project->idProject}}()', 1000);

    subjectYear = '{{$subject->academicYear}}';
    currentYear = sessionStorage.getItem("currentYear").replace("\\","");

    if(subjectYear != currentYear){
        console.log(subjectYear);
        console.log(currentYear);
        $(".stopYear").prop('disabled', true);
    }




</script>
@endsection
