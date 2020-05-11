@extends('layouts.app')
@section('content')
<head>
    <title>Project</title>
</head>
<div class="container-xl-fluid mt-2 pl-5 pr-5 pb-2">
    @include('layouts.messages')
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb pl-0 pb-0 mb-4 h4" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page" >{{$subject->subjectName}} - {{$project->name}}</li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="conteudo-tab" data-toggle="tab" href="#conteudo" role="tab" aria-controls="conteudo" aria-selected="true">Grupos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">Fórum</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="recursos" aria-selected="false">Recursos</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent" style="min-height: 75vh; background-color: #ededed;">
        <div class="container-fluid ml-0 mr-0 tab-pane fade active show" id="conteudo" role="tabpanel" aria-labelledby="conteudo-tab">
            <div class="row rounded " style="height: 75vh;">
                <div class="col mt-3 mb-3 ml-3 rounded center" style="background-color: #c6c6c6; position: relative;">
                    <div class="container pt-3 overflow-auto mw-80" >
                        <ul class="nav nav-pills mb-3 flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($groups as $group)
                                 <li class="nav-item mb-1 rounded" style="background-color: #d0e7ff;">
                                     <a class="nav-link " style="display:flex; align-items: center;vertical-align: middle;" id="pills-{{$group->idGroupProject}}-tab" data-toggle="pill" href="#pills-{{$group->idGroupProject}}" role="tab" aria-controls="pills-{{$group->idGroupProject}}" aria-selected="true">
                                         <h3 class="float-left mb-0 mr-2" style="vertical-align: middle;">Grupo {{$group->idGroupProject}} </h3>
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
                                                    <div class="row pb-2 " style="height: 40%;"><div class="bg-light p-2 w-100 rounded"><h5>Ficheiros</h5> </div></div>
                                                    <div class="row pb-2 " style="height: 30%;"><div class="bg-light p-2 w-100 rounded"><h5>Avaliação entre alunos</h5></div></div>
                                                    <div class="row " style="height: 30%;">
                                                        <div class=" bg-light p-2 w-100 rounded">
                                                        <h5>Avaliação final Grupo</h5>
                                                        @if ($group->grade == NULL)
                                                            <p class="mb-0">Grupo não avaliado</p>
                                                            <button type="button" class="p-2 btn btn-primary btn-md" style="position: absolute; bottom: 0; right: 0; margin-bottom: 1%; margin-right: 1%;"  data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}">Avaliar Grupo</button>
                                                            <div class="modal fade" id="modalAvaliate-{{$group->idGroup}}" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="staticBackdropLabel">Avaliação</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {!! Form::open(['action' => 'ProfessorProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                                            <div class="form-group">
                                                                                {{Form::label('grade', 'Nota do Projeto')}}
                                                                                {{Form::text('grade', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            <div class="form-group">
                                                                                {{Form::label('gradeComment', 'Comentário (opcional)')}}
                                                                                {{Form::text('gradeComment', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            {{Form::hidden('group', $group->idGroup)}}
                                                                            {{Form::hidden('option', 'grade')}}
                                                                            {{Form::hidden('project', $project->idProject)}}
                                                                            {{Form::submit('Submit', ['class'=>'btn btn-success'])}}

                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else

                                                            <p class="mb-0">Grade: {{$group->grade}}</p>
                                                            @if($group->gradeComment == NULL)
                                                                <p class="m-0">Sem Comentários</p>
                                                            @else
                                                                <p class="mb-0" >Comment: {{$group->gradeComment}}</p>
                                                            @endif
                                                            <button type="button" class="p-2 btn btn-primary btn-md float-right" style="position: absolute; bottom: 0; right: 0; margin-bottom: 1%; margin-right: 1%;" data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}" >Change Grade</button>
                                                            <div class="modal fade" id="modalAvaliate-{{$group->idGroup}}" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="staticBackdropLabel">Avaliação</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {!! Form::open(['action' => ['ProfessorProjectsController@update', $project->idProject], 'method' => 'PUT']) !!}
                                                                            <div class="form-group">
                                                                                {{Form::label('grade', 'Nota do Projeto')}}
                                                                                {{Form::text('grade', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            <div class="form-group">
                                                                                {{Form::label('gradeComment', 'Comentário(opcional)')}}
                                                                                {{Form::text('gradeComment', '', ['class' => 'form-control'])}}
                                                                            </div>
                                                                            {{Form::hidden('group', $group->idGroup)}}
                                                                            {{Form::hidden('_method','PUT')}}
                                                                            {{Form::hidden('option', 'grade')}}
                                                                            {{Form::submit('Submit', ['class'=>'btn btn-success'])}}
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
                                                <h5>Elementos</h5>
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
        <div class=" container tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">
                    <div class="row h-100 p-3">
                        <div class=" col-8 rounded bg-white w-100 p-3 h-100 mr-3" style="position: relative; width: 500px;">

                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalEdit-{{$project->idProject}}">{{__('gx.edit project')}}</button>                            <h4>Características</h4>
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
                                                {{Form::date('group formation deadline', $project->groupCreationDueDate, ['class' => 'form-control'])}}
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('deadline', trans('gx.deadline'))}}
                                                {{Form::date('deadline', $project->dueDate, ['class' => 'form-control'])}}
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
                                    </div>
                                </div>
                            </div>


                            <div class="pt-3">
                                <table class="table ">
                                    <tr >
                                        <th scope="row">Prazo de entrega</th scope="row">
                                        <td>{{$project->dueDate}}</td>
                                        <td>{{$project->dueDate}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Prazo para criação de grupos</th>
                                        <td>{{$project->groupCreationDueDate}}</td>
                                        <td>{{$project->dueDate}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nº máximo de grupos</th>
                                        <td colspan="2">{{$project->maxGroups}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nº mínimo de elementos por Grupo</th>
                                        <td colspan="2">{{$project->minElements}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nº máximo de elementos por Grupo</th>
                                        <td colspan="2">{{$project->maxElements}}</td>
                                    </tr>
                                </table>
                            </div>

                            <hr style="border-top: 4px double #8c8b8b; text-align: center;">
                            <table class="table style1">
                                <tbody>
                                <tr >
                                    <th scope="row">Número de grupos</th>
                                    <td colspan="2" >{{count($groups)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Grupos que não cumprem os requisitos</th>
                                    <td style="width: 27%">xx</td>
                                    <td><button type="button" class="btn btn-outline-primary btn-sm m-0 waves-effect">Show</button></td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class=" col rounded bg-white w-100 p-3 " style="position: relative;">
                            <h5>Documentação</h5>
                            <button type="button" class="p-2 btn btn-primary btn-md" style="position: absolute; bottom: 0; right: 0; margin-bottom: 2%; margin-right: 2%;"  data-toggle="modal">Upload Files</button>

                        </div>
                    </div>
        </div>

        <div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="noticias-tab">
            <div class="container mt-2 pb-3 rounded px-5 pt-3">
                <div class="table-responsive">
                    <table class="table bg-white" style="text-align:center;">
                        <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Author</th>
                            <th>Responses</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($announcements) > 0)
                            @for($i = 0; $i < count($announcements); $i++)
                                <tr>
                                    <td style="vertical-align: middle;"><a href="/student/project/{{$project->idProject}}/post/{{$announcements[$i]->idAnnouncement}}">{{$announcements[$i]->title}}</a></td>
                                    <td style="vertical-align: middle;">
                                        <a href="/profile/{{$userPoster[$i]->id }}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$userPoster[$i]->photo)}}"><span style="vertical-align: middle;"> {{$userPoster[$i]->name}}</span></a>
                                    </td>
                                    <td style="vertical-align: middle;">{{$numberComments[$i]}}</td>
                                    <td style="vertical-align: middle;">{{$announcements[$i]->date}}</td>
                                </tr>
                            @endfor
                        @else
                            <tr>
                                <td colspan="4"><h5>No posts found</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#pills-tab a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    if(hash === ''){
        hash = '#pills-1';
    }
    $('#pills-tab a[href="' + hash + '"]').tab('show');
</script>
<style>
    .style1 > tbody > tr:first-child > td {
        border: none;
    }
    .style1 > tbody > tr:first-child > th {
        border: none;
    }

    td {
        text-align: center;
    }
    th{
        width: 46%;
    }
</style>
@endsection
