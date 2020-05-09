@extends('layouts.app')
@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"/>
        <title>Groups</title>
    </head>
    <div class="container-fluid pl-5 pr-5 pb-2 mt-3">
        @include('layouts.messages')
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
                <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Groups</li>
                <li class="breadcrumb-item active" aria-current="page">{{$subject->subjectName}} - {{$project->name}}</li>
            </ol>
        </nav>
        <h2 class="pb-2"></h2>
        <br>
        <h1> Groups Creation </h1>
        <br>
        <div class="container-fluid overflow-auto "  >
            <div class="table-responsive">
                <table class="table bg-white" style="text-align:center;">
                    <thead>
                    <tr>
                        <th>Group</th>
                        <th>Nº Elements</th>
                        <th>Elements</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody style="overflow: auto;max-height: 20%">


                    @foreach($groupNumber as $groupN)
                        <tr>
                            <td>
                                {{$groupN}}
                            </td>
                            <td>
                                {{count($students_per_group[$groupN])}}/{{$projectMaxElements}}</td>
                            <td>
                        @foreach($students_per_group[$groupN] as $studInfo)
                                    <a href="/profile/{{$studInfo->id }}"><img class="editable img-responsive" style="border-radius: 100%; height: 30px; width: 30px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$studInfo->photo)}}"><span style="vertical-align: middle;"> {{$studInfo->name}}</span></a>


                        @endforeach

                            <!--------------------------------------------------------------->



                        @if(count($students_per_group[$groupN]) == $projectMaxElements)
                                <td><button type="button" class="btn btn-danger" disabled>Group Full</button> </td>
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

    @if(count($subjectStudentsNoGroup)>0)
                    <div style="padding-left:40%;margin-bottom: 20%">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCriarGrupo">Create Group</button>
                        <button style="margin-left: 5%" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalSugestaoGrupo">Students Sugestions</button>
                    </div>
    @else
                    <div style="padding-left:40%;margin-bottom: 20%">
                        <button type="button" class="btn btn-primary disabled" data-toggle="modal" >Create Group</button>
                        <button style="margin-left: 5%" type="button" class="btn btn-info disabled" data-toggle="modal" >Students Sugestions</button>
                    </div>

    @endif


    <div id="modalCriarGrupo" class="modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Group Creation</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" >
                        <h5 class="pb-2">Add students to group</h5>
                        <p class="pb-2">Group capacity : {{$projectMaxElements}}</p>
                        <table class="table bg-white" style="text-align:left;">
                        <tbody style="overflow: auto;max-height: 20%">
                        @csrf
                        {!! Form::open(['action' => ['GroupController@store', $project->idProject], 'method' => 'POST']) !!}
                        {!!Form::hidden('userId', $user)!!}

                        @foreach($subjectStudentsNoGroup as $studentInfo)
                            <tr><td>
                                    <div class="form-check form-check" >
                                        {!!Form::label('nameStudent', $studentInfo->name)!!}
                                        {!!Form::label('uniNumber', $studentInfo->uniNumber)!!}
                                        {!!Form::label('class', $studentInfo->class)!!}
                                        {!!Form::checkbox('idStudent[]'.$studentInfo->id, $studentInfo->id)!!}
                                    </div>
                                </td></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::submit('Create Group',['class'=>'btn btn-success'],['style'=>'display: block; margin: 0 auto'])}}
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
                    <h2 class="modal-title">Students sugestions</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <!--<div class="table-responsive">
                        <table class="table bg-white" style="text-align:left;">
                            <tbody style="overflow: auto;max-height: 20%">
                            @foreach($subjectStudentsNoGroup as $studentInfo)
                                <tr><td><p> {{$studentInfo->name}}|{{$studentInfo->uniNumber}} |{{$studentInfo->class}} <a href="#"><i class="fa fa-envelope" style="font-size: 1em"></i></a></p></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>-->
                        <table id="datatable" class="display">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Student Number</th>
                                <th>Class</th>
                                <th>Average</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjectStudentsNoGroup as $studentInfo)
                                <tr>
                                    <td>{{$studentInfo->name}}</td>
                                    <td>{{$studentInfo->uniNumber}}</td>
                                    <td>{{$studentInfo->class}}</td>
                                    <td>{{$studentInfo->average}}</td>
                                    <td><p><a href="#"><i class="fa fa-envelope" style="font-size: 1em"></i></a></p></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
                </div>
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



@endsection

