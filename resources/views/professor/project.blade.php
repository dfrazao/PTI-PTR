@extends('layouts.app')
@section('content')
<head>
    <title>Project</title>
</head>
<div class="mt-3 container-xl">
    @include('layouts.messages')
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$subject->subjectName}} - {{$project->name}}</li>
        </ol>
    </nav>
    <h2 class="pb-2">{{$subject->subjectName}} - {{$project->name}}</h2>

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
                <div class="col mt-3 ml-3 rounded center" style="background-color: #c6c6c6; height: 87%; position: relative;">
                    <div class="container overflow-auto mw-80" >
                        <div class="container p-2 rounded">
                            <h5>Grupos</h5>
                        </div>
                        <ul class="nav nav-pills mb-3 flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($groups as $group)
                                 <li class="nav-item mb-1">
                                     <a class="nav-link border border-dark " style="display:flex; align-items: center;vertical-align: middle;" id="pills-{{$group->idGroup}}e-tab" data-toggle="pill" href="#pills-{{$group->idGroup}}" role="tab" aria-controls="pills-{{$group->idGroup}}" aria-selected="true">
                                         <h3 class="float-left mb-0 mr-2" style="vertical-align: middle;">Grupo {{$group->idGroupProject}} </h3>
                                     </a>
                                 </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-8 mt-3 rounded" style="height: 87%;width: 100%;">
                    <div class="container-fluid rounded h-100 pt-3 pl-4" style="background-color: #c6c6c6;">
                        <div class="tab-content h-100" id="pills-tabContent">
                            @foreach($groups as $group)
                                <div class="container tab-pane fade h-100" id="pills-{{$group->idGroup}}" role="tabpanel" aria-labelledby="pills-{{$group->idGroup}}-tab">
                                        <div class="row h-50">
                                            <div class="col-9">
                                                    <div class="row h-50"><h5>Ficheiros</h5></div>
                                                    <div class="row"><h5>Avaliação entre alunos</h5></div>

                                            </div>
                                            <div class="col-3">
                                                <h5>Elementos</h5>
                                                @foreach(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup) as $sg)
                                                    <p>{{ \App\User::find($sg->idStudent)->name}}</p>
                                                @endforeach
                                            </div>

                                        </div>
                                    <div class="row h-25">
                                        <h5>Avaliação final Grupo</h5>
                                        @if ($group->grade == NULL)
                                            <p>Grupo não avaliado</p>
                                            <button type="button" class="p-2 btn btn-primary btn-md float-right" style="position: absolute; right:4%; bottom:3%;" data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}" style="background-color: #2c3fb1; border-color: #2c3fb1;">Avaliar Grupo</button>
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
                                            <p>Grade: {{$group->grade}}</p><br>
                                            @if($group->gradeComment == NULL)
                                                <p>Sem Comentários</p>
                                            @else
                                                <p>Comment: {{$group->gradeComment}}</p>
                                            @endif
                                            <button type="button" class="p-2 btn btn-primary btn-md float-right" style="position: absolute; right:4%; bottom:3%;" data-toggle="modal" data-target="#modalAvaliate-{{$group->idGroup}}" style="background-color: #2c3fb1; border-color: #2c3fb1;">Change Grade</button>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab" style=" position: relative">
            <div class="row mt-2" style="height: 75vh;">
                <div class="col-sm-5">
                    <div class="container bg-light rounded h-100">
                        <h4>Últimos Anúncios</h4>
                        @if(count($announcements) > 0)
                            @for($i = 0; $i < count($announcements); $i++)
                                <div class="container-xl-fluid mt-3 p-3 rounded" style="background-color: white;">
                                    <header class="header row mb-3 pl-3">
                                        <div class="mr-3">
                                            <a href="/profile/{{$userPoster[$i]->id }}">
                                                <img class="editable img-responsive" style="border-radius: 100%; height: 50px; width: 50px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$userPoster[$i]->photo)}}">
                                            </a>
                                        </div>
                                        <div>
                                            <h5><a href="/student/project/{{$project->idProject}}/post/{{$announcements[$i]->idAnnouncement}}">{{$announcements[$i]->title}}</a></h5>
                                            <h6>By: <a href="/profile/{{$userPoster[$i]->id }}">{{$userPoster[$i]->name}}</a><small> - Posted on {{$announcements[$i]->date}}</small></h6>
                                        </div>
                                    </header>
                                </div>
                            @endfor
                        @else
                            <tr>
                                <td colspan="4"><h5>No posts found</h5></td>
                            </tr>
                        @endif

                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="overflow-auto bg-light rounded h-50" style="position: relative;">
                        <h3 class="pt-3 pl-3">Ficheiros</h3>
                        <p>Enunciado v1</p>
                        <p>Enunciado v2</p>
                        <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Upload Ficheiros</button>
                    </div>
                    <div class="overflow-auto bg-light rounded h-50 border-top">
                        <h3 class="pt-3 pl-3">Recursos</h3>
                        <p>Lista de Exercícios</p>
                        <p>Horários da disciplina</p>
                        <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Upload Recursos</button>
                    </div>
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
@endsection
