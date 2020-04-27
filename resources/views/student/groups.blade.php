@extends('layouts.app')
@section('content')
    <style>

        tbody {
            display:block;
            height:25em;
            overflow:auto;
        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
        }
        thead {
            width: calc( 100% - 1em )
        }

    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container-fluid bg-light" >
        @include('layouts.messages')
        <br>
        <h1> Criação de Grupos</h1>
        <br>
        <div class="container-fluid overflow-auto "  >
            <div class="table-responsive">
                <table class="table bg-white" style="text-align:center;">
                    <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Nº Elementos</th>
                        <th>Elementos</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody style="overflow: auto;max-height: 20%">


                    @foreach($groupNumber as $groupN)
                        <tr>
                            <td>
                                {{$groupN}}
                            </td>
                            <td>@foreach($students_per_group[$groupN] as $studInfo)
                                    {{count($students_per_group[$groupN])}}
                                @endforeach/{{$projectMaxElements}}</td>
                            <td>
                        @foreach($students_per_group[$groupN] as $studInfo)
                                <p>{{$studInfo->name}} | {{$studInfo->uniNumber}} </p>
                        @endforeach
                            <td > <a href="#"><i class="fa fa-plus" style="font-size: 3em"></i></a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

    <div style="padding-left:40%;margin-bottom: 20%">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCriarGrupo">Criar Grupo</button>
    <button style="margin-left: 10%" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalSugestaoGrupo">Sugestões Alunos</button>
    </div>

    <div id="modalCriarGrupo" class="modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Criar Grupo</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" >
                        <h5 class="pb-2">Adicionar alunos</h5>
                        <table class="table bg-white" style="text-align:left;">
                        <tbody style="overflow: auto;max-height: 20%">
                        @csrf
                        {!! Form::open(['action' => ['GroupController@store', $project->idProject], 'method' => 'POST']) !!}
                        @foreach($subjectStudentsNoGroup as $studentInfo)
                            <tr><td>
                                    <div class="form-check form-check" >
                                        {!!Form::label('nameStudent', $studentInfo->name)!!}
                                        {!!Form::label('uniNumber', $studentInfo->uniNumber)!!}
                                        {!!Form::label('class', $studentInfo->class)!!}
                                        {!!Form::hidden ('class', $studentInfo->id)!!}
                                        {!!Form::checkbox('idStudent', $studentInfo->id)!!}
                                    </div>
                                </td></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Criar Grupo',['class'=>'btn btn-success'],['style'=>'display: block; margin: 0 auto'])}}
                    {{Form::hidden('project', $project->idProject)}}
                    {{Form::hidden('numberGroupsInsideProject', $numberGroupsInsideProject)}}

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    {!!Form::close()!!}
                </div>
            </div>

        </div>
    </div>

    <div id="modalSugestaoGrupo" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-lg" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Students sugestions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="table-responsive">
                        <table class="table bg-white" style="text-align:left;">
                            <tbody style="overflow: auto;max-height: 20%">
                            @foreach($subjectStudentsNoGroup as $studentInfo)
                                <tr><td><p>{{$studentInfo->name}} |
                                        {{$studentInfo->uniNumber}} |
                                        {{$studentInfo->class}} <a href="#"><i class="fa fa-envelope" style="font-size: 1em"></i></a>
                                        </p></td></tr>
                            @endforeach
                            </tbody>
                        </table>


                        <br>

                </div>
                </div>
            </div>
        </div>
    </div>
    </div>



@endsection
