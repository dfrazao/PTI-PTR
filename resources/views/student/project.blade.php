@extends('layouts.app')
@section('content')
<head>
    <title>Project</title>
</head>
<div class="container-fluid pl-5 pr-5 pb-2 mt-3">
    @include('layouts.messages')
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$subject->subjectName}} - {{$project->name}}</li>
        </ol>
    </nav>
    <h2 class="pb-2">{{$subject ->subjectName}} - {{$project->name}}</h2>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="conteudo-tab" data-toggle="tab" href="#content" role="tab" aria-controls="conteudo" aria-selected="false">Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="horario-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="horario" aria-selected="false">Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="noticias-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="noticias" aria-selected="false">Forum</a>
        </li>
        <li class="rightbutton ml-auto">
            <button type="submit" class="btn btn-sm mr-2 d-none" id= 'newMeeting' data-toggle="modal" data-target="#modalCreateMeeting" style="width: 20vh;background: #2c3fb1; color: white;">New Meeting</button><button type="submit" class="btn btn-sm bg-danger" style="width: 20vh;color: white;">Leave Group</button>

        </li>
    </ul>

    <div class="tab-content" id="myTabContent" style="min-height: 75vh; background-color: #ededed;">
        <div class="container-fluid tab-pane fade ml-0 mr-0" id="content" role="tabpanel" aria-labelledby="content-tab">
            <div class="row rounded" style="height: 80vh;">
                <div class="col mt-3 ml-3 rounded" style="background-color: #c6c6c6; position: relative;">
                    <div class="container-fluid d-flex flex-row mt-3" >
                        <figure class="text-center mr-4"><i class="fas fa-folder fa-4x" style="color: #ffce52;"></i><figcaption>proj1-v1.zip</figcaption></figure>
                        <figure class="text-center mr-4"><i class="fas fa-folder fa-4x" style="color: #ffce52;"></i><figcaption>proj1-v1.zip</figcaption></figure>
                        <figure class="text-center mr-4"><i class="fas fa-folder fa-4x" style="color: #ffce52;"></i><figcaption>proj1-v1.zip</figcaption></figure>
                        <button type="submit" class="btn btn-sm mb-2 mr-2" style="width:20vh;background: #2c3fb1; color: white; position: absolute; bottom: 0px; right: 0px;">Submeter</button>
                    </div>
                </div>
                <div class="col col mt-3 rounded">
                    <div class="container-fluid rounded text-center h-100 pt-2" style="background-color: #c6c6c6; height: 30vh;">
                        <h5>Documentação </h5>
                        <p> Enunciado </p>
                    </div>
                </div>
                <div class="col col mt-3 pl-0 rounded">
                    <div class="container-fluid rounded pt-2 h-100 notes" style="background-color: #ffe680; " >
                        <h5 class="text-center">Notas</h5>
                        {!! Form::open(['action' => ['StudentProjectsController@store', $project -> idProject], 'method' => 'POST', 'id'=>'myform']) !!}
                        @csrf
                        {{Form::textarea('notes', $notes, ['class' => 'form-control', 'id'=>'textArea', 'rows'=>'17'])}}
                        {{Form::hidden('group',$idGroup)}}
                        {{Form::hidden('submission','notes')}}
                        {{Form::submit('Submit', ['class'=>'btn btn-primary d-none', 'id'=>'notesButton'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="row rounded mb-5">
                <div class="container-fluid rounded mx-3 mt-3 p-2" style="background-color: #c6c6c6; position: relative;">
                    <div class="form-group mb-0">
                        <div class="table-fixed">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>Tarefa</th>
                                    <th>Responsável</th>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Tempo Gasto</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $t)
                                    <tr id="{{$t -> idTask}}-show">

                                        <td>{{$t->description}}</td>
                                        <td>{{$t->responsible}}</td>
                                        <td>{{$t->beginning}}</td>
                                        <td>{{$t->end}}</td>
                                        <td>@if(!is_null($t->duration) && $t->duration > 1)
                                                {{$t->duration}} days
                                            @elseif(!is_null($t->duration) && $t->duration <= 1)
                                                1 day
                                            @endif
                                        </td>
                                        <td class="float-right pr-0"><button style="width: 10vh" type="button" class="btn btn-sm btn-success editTask mr-md-2">Editar</button><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete-{{$t->idTask}}">Delete</button></td>
                                    </tr>
                                    <tr class="d-none" id="{{$t->idTask}}-edit">
                                        @csrf
                                        {!!Form::open(['action' => ['StudentProjectsController@update', $project -> idProject], 'method' => 'POST'])!!}
                                            <td class="form-group">
                                                {{Form::text('description', $t->description, ['class' => 'form-control'])}}
                                            </td>
                                            <td class="form-group">
                                                {{ Form::text('responsible', $t->responsible ,['class' => 'form-control']) }}
                                            </td>
                                            <td class="form-group">
                                                {{ Form::date('beginning', $t->beginning ,['class' => 'form-control']) }}
                                            </td>
                                            <td class="form-group">
                                                {{ Form::date('end', $t->end ,['class' => 'form-control']) }}
                                            </td>
                                            <td class="form-group"></td>

                                            {{Form::hidden('task', $t->idTask) }}
                                            {{Form::hidden('group', $t-> idGroup)}}
                                            {{Form::hidden('_method','PUT')}}

                                            <td class="form-group float-right pr-0">{{Form::Submit('Save', ['class'=>'btn btn-sm mr-2 btn-success', 'style'=>"width: 10vh", 'id'=>'Save'])}}<button type="button" class="btn btn-sm btn-danger editTask">Cancel</button></td>
                                        {!! Form::close() !!}
                                    </tr>
                                    {{-- Modal Delete Task --}}
                                    <div class="modal fade" id="modalDelete-{{$t->idTask}}" aria-labelledby="modalDelete-{{$t->idTask}}" aria-hidden="true" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Delete Task</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Are you sure you want to delete this task?</h5>
                                                    {!!Form::open(['action' => ['StudentProjectsController@destroy', $project->idProject], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                    {{Form::hidden('task', $t->idTask) }}
                                                    {!!Form::close()!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid pt-3" style="position: relative">
                            <button type="button" class="btn btn-sm open_modal" id="{{$idGroup}}" style="width:20vh;background: #2c3fb1; color: white;position: absolute; bottom: 0px; right: 0px;">New Task</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Create Task --}}
        <div class="modal fade" id="modalCreateTask" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">New Task</h4>
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
                            {{ Form::text('responsible', '',['class' => 'form-control', 'placeholder' => 'Responsible for the task']) }}
                        </div>
                        <div class="form-group">
                            {{Form::label('beginning', 'Beginning')}}
                            {{ Form::date('beginning','',['class' => 'form-control']) }}
                        </div>
                        {{ Form::hidden('group', $idGroup) }}
                        {{ Form::hidden('project', $project->idProject) }}
                        {{ Form::hidden('subject', $subject->subjectName) }}
                        {{Form::hidden('submission','task')}}

                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab" style=" position: relative">
            <div class="grid-container">
                <div></div>
                <div>Segunda</div>
                <div>Terça</div>
                <div>Quarta</div>
                <div>Quinta</div>
                <div>Sexta</div>
                <div>Sábado</div>
                <div>Domingo</div>
                <div style="border: 1px solid black;">8:00h-9:00h</div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">9:00h-10:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">10:00h-11:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">11:00h-12:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">12:00h-13:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">13:00h-14:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">14:00h-15:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">15:00h-16:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">16:00h-17:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;">17:00h-18:00h</div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
                <div style="border-bottom: 1px solid black; border-right: 1px solid black;"></div>
            </div>
            <div class="container p-3">
                <div class="row">
                    <div class="col-xs-3 mx-auto">
                        André
                        <span class="border bg-primary align-middle "></span>
                    </div>
                    <div class="col-xs-3 mx-auto">
                        António
                        <span class="border bg-success align-middle "></span>
                    </div>
                    <div class="col-xs-3 mx-auto">
                        Diogo
                        <span class="border bg-info align-middle "></span>
                    </div>
                    <div class="col-xs-3 mx-auto">
                        Guilherme
                        <span class="border bg-warning align-middle "></span>
                    </div>
                    <div class="col-xs-3 mx-auto">
                        João
                        <span class="border bg-danger align-middle "></span>
                    </div>
                    <div class="col-xs-3 mx-auto">
                        Tiago
                        <span class="border bg-secondary align-middle "></span>
                    </div>
                    <div class="col-xs-3 mx-auto">
                        Vasco
                        <span class="border bg-dark align-middle "></span>
                    </div>
                </div>
            </div>
            <div class="container-fluid rounded text-center pt-2 h-100 px-0">
                <h5>Reuniões</h5>
                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Beginning</th>
                        <th>Place</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meeting as $m)
                        <tr>
                            <td>{{$m->idMeeting}}</td>
                            <td>{{$m->description}}</td>
                            <td>{{$m->date}}</td>
                            <td>{{$m->hour}}</td>
                            <td>{{$m->place}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Modal Create Meeting --}}
        <div class="modal fade" id="modalCreateMeeting" aria-labelledby="modalCreateMeeting" aria-hidden="true" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Create new meeting</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!!Form::open(['action' => ['StudentProjectsController@store', $project->idProject], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                        <div class="form-group">
                            {{Form::label('description', 'Meeting description')}}
                            {{Form::text('description', '', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('place', 'Meeting place')}}
                            {{Form::text('place', '', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('date', 'Meeting date')}}
                            {{Form::date('date', '',['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{Form::label('time', 'Meeting beginning')}}
                            {{ Form::time('time','',['class' => 'form-control']) }}
                        </div>
                        {{ Form::hidden('group', $idGroup) }}
                        {{ Form::hidden('project', $project->idProject) }}
                        {{ Form::hidden('subject', $subject->subjectName) }}
                        {{Form::hidden('submission','meeting')}}
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <button type="button" class="p-2 mt-3 mr-3 btn btn-md btn-primary float-right" data-toggle="modal" data-target="#modalCreatePost" style="background-color: #2c3fb1; border-color: #2c3fb1;">Create Post</button>

            <div class="container rounded pb-3 pt-3">
                <div class="table-responsive-xl">
                    <table class="table bg-white rounded" style="text-align:center;">
                        <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Author</th>
                            <th>Responses</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($posts) > 0)
                            @for($i = 0; $i < count($posts); $i++)
                                <tr>
                                    <td style="vertical-align: middle;"><a href="/student/project/{{$project->idProject}}/post/{{$posts[$i]->idAnnouncement}}">{{$posts[$i]->title}}</a></td>
                                    <td style="vertical-align: middle;">
                                        <a href="/profile/{{$userPoster[$i]->id }}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="/storage/profilePhotos/{{ $userPoster[$i]->photo}}"><span style="vertical-align: middle;"> {{$userPoster[$i]->name}}</span></a>
                                    </td>
                                    <td style="vertical-align: middle;">{{$numberComments[$i]}}</td>
                                    <td style="vertical-align: middle;">{{$posts[$i]->date}}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td colspan="4"><h5>No posts found</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <span>Showing {{$p->firstItem()}} to {{$p->lastItem()}} of {{$p->total()}} posts</span>
                        {{$p->links()}}
                    </div>
                </div>

                {{--Modal Create Post--}}
                <div class="modal fade" id="modalCreate Post" tabindex="-1" role="dialog">
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
                                    {{Form::label('title', 'Title')}}
                                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('body', 'Body')}}
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
    </div>
</div>
<style>
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
    .notes{

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
        font-size: 10px;
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

</style>
<script>
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

    $('#myTab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
        if($(this).attr('id') == "horario-tab"){

            $('#newMeeting').removeClass('d-none');
        }
        else{
            $('#newMeeting').addClass('d-none');
        }
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    if(hash === ''){
        hash = '#content';
    }
    $('#myTab a[href="' + hash + '"]').tab('show');

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



</script>
@endsection
