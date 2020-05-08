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
@endsection
