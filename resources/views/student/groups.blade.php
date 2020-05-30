@extends('layouts.app')
@section('content')
    <head>
        <title>Groups</title>
    </head>
    <div class="container-fluid pl-5 pr-5 pb-2 mt-3">
        @include('layouts.messages')
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
                <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('gx.groups')}}</li>
                <li class="breadcrumb-item active" aria-current="page">{{$subject->subjectName}} - {{$project->name}}</li>
            </ol>
        </nav>
        <h2 class="pb-2"></h2>
        <br>
        <h1> {{__('gx.group creation')}} </h1>
        <br>
        <div class="container-fluid overflow-auto "  >
            <div class="table-responsive">
                <table class="table bg-white" style="text-align:center;">
                    <thead>
                    <tr>
                        <th>{{__('gx.group')}}</th>
                        <th>{{__('gx.nº elements')}}</th>
                        <th>{{__('gx.elements')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody style="overflow: auto;max-height: 20%">


                    @foreach($groupNumber as $groupN)
                        <tr>
                            <td>
                                {{$students_per_group[$groupN][0]->idGroupProject }}
                            </td>
                            <td>
                                {{count($students_per_group[$groupN])}}/{{$projectMaxElements}}</td>
                            <td>
                        @foreach($students_per_group[$groupN] as $studInfo)
                                    <a href="/profile/{{$studInfo->id }}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$studInfo->photo)}}"><span style="vertical-align: middle;"> {{$studInfo->name}}</span></a>


                        @endforeach


                        @if(count($students_per_group[$groupN]) == $projectMaxElements)
                                <td><button type="button" class="btn btn-danger" disabled>{{__('gx.group full')}}</button> </td>
                        @elseif(in_array($user,$studentsIdGroupValues))
                                <td><button type="button" class="btn btn-info disabled" disabled>{{__('gx.join group')}}</button> </td>
                        @else
                            <td>
                                @csrf
                                {!!Form::open(['action' => ['GroupController@update', $project -> idProject], 'method' => 'POST'])!!}
                                {!!Form::hidden('userJoin', $user)!!}
                                {!!Form::hidden('idProject', $project->idProject)!!}
                                {!!Form::hidden('idGroupJoin', $groupN)!!}
                                {!!Form::hidden('_method','PUT')!!}
                                {{Form::Submit('Join Group', ['class'=>'btn btn-info','id'=>'Join Group'])}}
                                {!!Form::close()!!}
                            </td>

                        </tr>

                        @endif
                    @endforeach



                    </tbody>
                </table>
            </div>

                <br>
                <br>

    @if(count($subjectStudentsNoGroup)==0 or $numberGroupsInsideProject == $projectMaxGroups or in_array($user,$studentsIdGroupValues))

                    <div style="padding-left:40%;margin-bottom: 20%">
                        <button type="button" class="btn btn-primary disabled" data-toggle ="modal" style="width: 11em" >{{__('gx.create group')}} </button>
                        <button  type="button" class="btn btn-info disabled" data-toggle="modal" style="width: 11em">{{__('gx.student sugestions')}}</button>
                    </div>
    @else
                    <div style="padding-left:40%;margin-bottom: 20%">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCriarGrupo" style="width: 11em">{{__('gx.create group')}}</button>
                        <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#modalSugestaoGrupo" style="width: 11em">{{__('gx.student sugestions')}}</button>
                    </div>

    @endif


    <div id="modalCriarGrupo"  class="modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.group creation')}}</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="display: inline"  >
                    <div>
                        <h5 class="pb-2" style="float: left">{{__('gx.min elements')}} : {{$projectMinElements}}</h5> <br>
                        <br>
                        <h5 class="pb-2" style="float: left">{{__('gx.max elements')}} : {{$projectMaxElements}}</h5>


                    </div>


                    @csrf
                    {!! Form::open(['action' => ['GroupController@store', $project->idProject], 'method' => 'POST']) !!}
                    {!!Form::hidden('userId', $user)!!}
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>{{__('gx.name')}}</th>
                            <th>{{__('gx.student number')}}</th>
                            <th>{{__('gx.class')}}</th>
                            <th></th>

                        </tr>
                        <tbody>
                        @foreach($subjectStudentsNoGroup as $studentInfo)
                            <tr>
                                <td>{!!Form::label('nameStudent', $studentInfo->name)!!}</td>
                                <td>{!!Form::label('uniNumber', $studentInfo->uniNumber)!!}</td>
                                <td>{!!Form::label('class', $studentInfo->class)!!}</td>
                                <td>{!!Form::checkbox('idStudent[]'.$studentInfo->id, $studentInfo->id,false)!!}</td>
                                <!-- adicionar às checkboxes class="custom-control-input"-->
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    {{Form::submit('Create Group',['class'=>'btn btn-primary'],['style'=>'display: block; margin: 0 auto'])}}
                    {{Form::hidden('project', $project->idProject)}}
                    {{Form::hidden('numberGroupsInsideProject', $numberGroupsInsideProject)}}

                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('gx.cancel')}}</button>
                    {!!Form::close()!!}
                </div>
            </div>

        </div>
    </div>
    </div>
    <div id="modalSugestaoGrupo" class="modal" tabindex="-1" role="dialog"  >
        <div class="modal-dialog modal-xl" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h2 class="modal-title">{{__('gx.student sugestions')}}</h2>
                    <p>Sorted By Average</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: inline" >
                    <table id="datatable2" class="display">
                        <thead>
                        <tr>
                            <th>{{__('gx.name')}}</th>
                            <th>{{__('gx.student number')}}</th>
                            <th>{{__('gx.class')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjectStudentsNoGroup as $studentInfo)
                            <tr>
                                <td>{{$studentInfo->name}}</td>
                                <td>{{$studentInfo->uniNumber}}</td>
                                <td>{{$studentInfo->class}}</td>
                                <td><p><a href="#"><i class="fa fa-envelope" style="font-size: 1em"></i></a></p></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('gx.close')}}</button>
                </div>
                </div>
                </div>
            </div>
        </div>







    <script>
        var $checkboxes = $('input[type=checkbox]');
        //var numElements = {!! json_encode($projectMaxElements) !!};
        $checkboxes.change(function () {
            if (this.checked) {
                if ($checkboxes.filter(':checked').length == {{$projectMaxElements}}-1) {
                    $checkboxes.not(':checked').prop('disabled', true);
                }
            } else {
                $checkboxes.prop('disabled', false);
            }
        });
    </script>


    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

    <script>$(document).ready( function () {
            $('#datatable').DataTable();
        } );</script>

    <script>$('#datatable').dataTable( {
            "columnDefs": [
                { "orderable": false, "targets": 4 }
        ]
    } );</script>


    <script>$(document).ready( function () {
            $('#datatable2').DataTable();
        } );</script>


    <script>
            $('#datatable2').dataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                "ordering": false});
    </script>


<style>
    .modal-body{
        max-height: calc(100vh - 300px);
        overflow-y: auto;
    }

    </style>


@endsection

