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
            <a class="nav-link" id="noticias-tab" data-toggle="tab" href="#noticias" role="tab" aria-controls="noticias" aria-selected="false">Noticias</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="recursos" aria-selected="false">Recursos</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class=" container-xl tab-pane fade show active" id="conteudo" role="tabpanel" aria-labelledby="conteudo-tab">
            <div class="row rounded " style="background-color: #ededed; height: 75vh;">
                <div class="col mt-3 ml-3 rounded center" style="background-color: #c6c6c6; height: 87%; position: relative;">
                    <div class="container overflow-auto mw-80" >
                        <div class="container p-2 rounded">
                            <h5>Grupos</h5>
                        </div>
                        <ul class="nav nav-pills mb-3 flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($groups as $group)
                                 <li class="nav-item mb-1">
                                     <a class="nav-link border border-dark " style="display:flex; align-items: center;vertical-align: middle;" id="pills-{{$group->idGroup}}e-tab" data-toggle="pill" href="#pills-{{$group->idGroup}}" role="tab" aria-controls="pills-{{$group->idGroup}}" aria-selected="true">
                                         <h3 class="float-left mb-0 mr-2" style="vertical-align: middle;">{{$group->idGroupProject}} </h3>
                                         @foreach(\App\StudentsGroup::all()->where('idGroup', '==', $group->idGroup) as $sg)
                                             <span>{{ \App\User::find($sg->idStudent)->name}}</span>
                                         @endforeach
                                     </a>
                                 </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-7 mt-3 rounded" style="height: 87%;width: 100%;">
                    <div class="container-fluid rounded h-100 pt-3 pl-4" style="background-color: #c6c6c6;">
                        <h5>Ficheiros </h5>
                        <div class="container-fluid d-flex flex-row mt-3" >
                            <div class="tab-content" id="pills-tabContent">
                                @foreach($groups as $group)
                                    <div class="tab-pane fade" id="pills-{{$group->idGroup}}" role="tabpanel" aria-labelledby="pills-{{$group->idGroup}}-tab">{{$group->idGroup}}
                                        <h3>Grade</h3>
                                        @if ($group->grade == NULL)
                                            <span>Ainda nao foi avaliado</span>
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
                                            <span>{{$group->grade}}</span>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">

            <div class="row mt-2" style="height: 75vh;">

                <div class="col-sm-5">
                    <div class="container bg-light rounded h-100">
                        <h4>Últimos Anúncios</h4>
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

        <div class="tab-pane fade" id="noticias" role="tabpanel" aria-labelledby="noticias-tab">
            <div class="container mt-2 pb-3 rounded px-5 pt-3">
                <div class="table-responsive">
                    <table class="table bg-white" style="text-align:center;">
                        <thead>
                        <tr>
                            <th>Tópico</th>
                            <th>Iniciado por</th>
                            <th>Respostas</th>
                            <th>Últimas mensagens</th>
                            <th>Criada</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Notas</td>
                            <td>Anna</td>
                            <td>0</td>
                            <td>xxx</td>
                            <td>yyy</td>
                        </tr>
                        <tr>
                            <td>exame</td>
                            <td>Alex vidal</td>
                            <td>1</td>
                            <td>ccc</td>
                            <td>bbb</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
