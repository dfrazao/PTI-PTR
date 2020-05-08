@extends('layouts.app')
@section('content')
<head>
    <title>Dashboard</title>
</head>
<div class="container-xl-fluid mt-4 pl-5 pr-5 pb-2">
    @include('layouts.messages')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2>{{__('gx.dashboard')}}</h2>
    <div class="row mt-3 rounded h-100" style="height: 90vh; background-color: #ededed;" >

        <div class="col-sm-4" style="z-index: 10">
            <div class="container">
                <button type="button" class="previous btn btn-default btn-lg" style="text-align: center;width: 100%; color:#2c3fb1">
                    <span class="fas fa-chevron-up"></span>
                </button>
                <div class="rounded mt-2" style="background-color: #c6c6c6;">
                    <h3 class="month1 pt-1" style="text-align: center;"></h3>
                    <div class="table-responsive-xl" style="background-color: #c6c6c6;">
                        <table class="month1-cal table table-sm table-borderless" style="text-align: center;">
                            <thead>
                            <tr>
                                <th scope="col">{{__('gx.monday')}}</th>
                                <th scope="col">{{__('gx.tuesday')}}</th>
                                <th scope="col">{{__('gx.wednesday')}}</th>
                                <th scope="col">{{__('gx.thursday')}}</th>
                                <th scope="col">{{__('gx.friday')}}</th>
                                <th scope="col">{{__('gx.saturday')}}</th>
                                <th scope="col">{{__('gx.sunday')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="week1">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week2">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week3">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week4">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week5">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week6">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="rounded" style="background-color: #c6c6c6;">
                    <h3 class="month2 pt-1" style="text-align: center;"></h3>
                    <div class="table-responsive-xl" >
                        <table class="month2-cal table table-sm table-borderless" style="text-align: center;width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">{{__('gx.monday')}}</th>
                                <th scope="col">{{__('gx.tuesday')}}</th>
                                <th scope="col">{{__('gx.wednesday')}}</th>
                                <th scope="col">{{__('gx.thursday')}}</th>
                                <th scope="col">{{__('gx.friday')}}</th>
                                <th scope="col">{{__('gx.saturday')}}</th>
                                <th scope="col">{{__('gx.sunday')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="week1">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week2">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week3">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week4">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week5">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            <tr class="week6">
                                <td class="1"></td>
                                <td class="2"></td>
                                <td class="3"></td>
                                <td class="4"></td>
                                <td class="5"></td>
                                <td class="6"></td>
                                <td class="7"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="next btn btn-default btn-lg" style="text-align: center;width: 100%; color:#2c3fb1;">
                    <span class="fas fa-chevron-down"></span>
                </button>
            </div>
        </div>

        <div class="col-sm-8" style="z-index: 10">
            <div class="overflow-auto rounded pb-2">
                <h3 class="pt-3 pl-3">{{__('gx.subjects')}}</h3>
                <div class="container overflow-auto mw-80" style="max-height: 75vh;">
                    @if(count($subjects) > 0)
                        @foreach($subjects as $subject)

                            <div class="container overflow-auto p-2 mt-3 rounded cadeira" type="button" id="{{$subject->idSubject}}" style="background-color: #c6c6c6;">
                                <h4 class="mt-2 pl-2 float-left">{{$subject->subjectName}}</h4>
                                <button style="color:#2c3fb1" type="button" class="btn btn-default btn-lg float-right" id="button-{{$subject->idSubject}}">
                                    <span class="fas fa-plus"></span>
                                </button>
                            </div>

                            <div class="container overflow-hidden  rounded-bottom doff" id="{{$subject->idSubject}}-groups" style="display: none; background-color: white;">
                                @if(count($projects->whereIn('idSubject', $subject->idSubject)) > 0)
                                    @foreach($projects as $project)
                                        @if($subject->idSubject == $project->idSubject)
                                            <div class="p-2 align-items-center">
                                                @if(Auth::user()->role == 'student')
                                                    @if(isset($project->group))
                                                        <button type="button" class="btn btn-sm btn-success float-right" href="/student/project/{{$project->idProject}}" style="background-color: #2c3fb1; border-color: #2c3fb1;">{{__('gx.group')}} {{$project->group}}</button>
                                                        <h5 class="mt-1 mb-1"><a style="color:#2c3fb1;" href="/student/project/{{$project->idProject}}">{{$project->name}}</a> {{$project->dueDate}}</h5>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success float-right" href="/student/project/{{$project->idProject}}/groups">{{__('gx.join/create group')}}</button>
                                                        <h5 class="mt-1 mb-1"><a style="color:#2c3fb1;" href="/student/project/{{$project->idProject}}/groups">{{$project->name}}</a> {{$project->groupCreationDueDate}}</h5>
                                                    @endif

                                                @elseif(Auth::user()->role == 'professor')
                                                    <button type="button" class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#modalDelete-{{$project->idProject}}">{{__('gx.delete project')}}</button>
                                                    <button type="button" class="btn btn-sm btn-success mr-2 float-right" data-toggle="modal" data-target="#modalEdit-{{$project->idProject}}">{{__('gx.edit project')}}</button>
                                                    <h5 class="mt-1 mb-1"><a style="color:#2c3fb1;" href="/professor/project/{{$project->idProject}}">{{$project->name}}</a></h5>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                    @if (Auth::user()->role == 'professor')
                                        <button style="background-color:#2c3fb1;color: #fff;" type="button" class="btn btn-sm float-right m-2 open_modal" id="{{$subject->idSubject}}">{{__('gx.create project')}}</button>
                                    @endif
                                @else
                                    @if (Auth::user()->role == 'professor')
                                        <button style="background-color:#2c3fb1;color: #fff;" type="button" class="btn btn-sm float-right m-2 open_modal" id="{{$subject->idSubject}}">{{__('gx.create project')}}</button>
                                    @endif
                                    <h5 class="p-2">{{__('gx.no projects found')}}</h5>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p>{{__('gx.no subjects found')}}</p>
                    @endif
                </div>
                <button type="button" class="p-2 btn btn-primary btn-md float-right mt-3 mr-3" style="background-color: #2c3fb1; border-color: #2c3fb1;">Cadeiras Antigas</button>
            </div>
        </div>
    </div>

    {{--Modal Edit--}}

    @if(count($subjects) > 0)
        @foreach($subjects as $subject)
            @if(count($projects->whereIn('idSubject', $subject->idSubject)) > 0)
                @foreach($projects as $project)
                    @if($subject->idSubject == $project->idSubject)
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
                                        <div class="form-group">
                                            {{Form::label('documentation', trans('gx.documentation'))}}
                                            {{Form::file('documentation')}}
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
                                        {{Form::submit(trans('gx.delete'), ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif

    {{--Modal Create--}}
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.new project')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'ProfessorProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('title', trans('gx.name'))}}
                        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => trans('gx.project name')])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('deadline', trans('gx.group formation deadline'))}}
                        {{ Form::date('group formation deadline', null,['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{Form::label('deadline', trans('gx.deadline'))}}
                        {{ Form::date('deadline', null,['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{Form::label('minNumber', trans('gx.minimum no. of members'))}}
                        {{Form::selectRange('minNumber', 1, 10)}}
                    </div>
                    <div class="form-group">
                        {{Form::label('maxNumber', trans('gx.maximum no. of members'))}}
                        {{Form::selectRange('maxNumber', 1, 10)}}
                    </div>
                    <div class="form-group">
                        {{Form::label('documentation', trans('gx.documentation'))}}
                        {{Form::file('documentation')}}
                    </div>
                    {{Form::hidden('subject', "subject")}}
                    {{Form::hidden('option', 'project')}}

                    {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success'])}}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            $(".cadeira").click(function(){
                id = $(this).attr('id');
                if ($("#" + id + "-groups").hasClass( "doff" )) {
                    $("#" + id + "-groups").removeClass( "doff" );
                    $("#button-" + id).children().addClass('fa-minus').removeClass('fa-plus');
                    $("#" + id + "-groups").slideDown(400);
                } else {
                    $("#" + id + "-groups").addClass( "doff" );
                    $("#button-" + id).children().addClass('fa-plus').removeClass('fa-minus');
                    $("#" + id + "-groups").slideUp(400);
                }
            });

            $(".open_modal").click(function(){
                $('input[name="subject"]').val($(this).attr("id"));
                $('#modalCreate').modal('show');
            });

        });

        class Calendar {

            constructor() {
                this.monthDiv = document.querySelector('.month1');
                this.nextMonthDiv = document.querySelector('.month2');
                this.prevDiv = document.querySelector('.previous');
                this.nextDiv = document.querySelector('.next');
            }

            init() {
                this.month = [];
                this.month.push(moment(), moment().add(1, 'months'));

                this.today = moment().startOf('day').format('YYYY-MM-DD');

                this.nextDiv.addEventListener('click', _ => {this.addMonth();});
                this.prevDiv.addEventListener('click', _ => {this.removeMonth();});

                this.update();
            }

            update() {
                this.monthString = this.month[0].clone().format('MMMM YYYY');
                this.nextMonthString = this.month[1].clone().format('MMMM YYYY');

                this.calendarDays = [];
                this.calendarDays.push({
                    first: this.month[0].clone().startOf('month'),
                    last: this.month[0].clone().endOf('month').date() },
                    {
                    first: this.month[1].clone().startOf('month'),
                    last: this.month[1].clone().endOf('month').date() });

                this.draw();
            }

            addMonth() {
                this.month[0].add(1, 'month');
                this.month[1].add(1, 'month');
                this.update();
            }

            removeMonth() {
                this.month[0].subtract(1, 'month');
                this.month[1].subtract(1, 'month');
                this.update();
            }

            draw() {
                $('table.month1-cal tr > td').empty()
                $('table.month2-cal tr > td').empty()
                $("table.month1-cal tr > td").removeClass("today project-deadline project-group-deadline");
                $("table.month2-cal tr > td").removeClass("today project-deadline project-group-deadline");
                this.monthDiv.innerText = this.monthString;
                this.nextMonthDiv.innerText = this.nextMonthString;

                let projects = [ [[],[]] , [[],[]] ];
                let deadlineMonthYear;
                let groupDeadlineMonthYear;
                @foreach($projects as $project)
                deadlineMonthYear = moment('{{$project->dueDate}}').format('MMMM YYYY');
                groupDeadlineMonthYear = moment('{{$project->groupCreationDueDate}}').format('MMMM YYYY');
                if (deadlineMonthYear == this.monthString) {
                    projects[0][0].push(moment('{{$project->dueDate}}').format('YYYY-MM-DD'));
                } else if (deadlineMonthYear == this.nextMonthString) {
                    projects[0][1].push(moment('{{$project->dueDate}}').format('YYYY-MM-DD'));
                }
                if (groupDeadlineMonthYear == this.monthString) {
                    projects[1][0].push(moment('{{$project->groupCreationDueDate}}').format('YYYY-MM-DD'));
                } else if (groupDeadlineMonthYear == this.nextMonthString) {
                    projects[1][1].push(moment('{{$project->groupCreationDueDate}}').format('YYYY-MM-DD'));
                }
                @endforeach

                for (let months = 0; months <= 1; months++) {
                    let week = 1;
                    let weekday = moment(this.calendarDays[months].first).isoWeekday();
                    let start = moment(this.calendarDays[months].first).format('YYYY-MM-DD');
                    let max;
                    for (let index = 1; index <= this.calendarDays[months].last; index++) {
                        if (weekday == 8) {
                            weekday = 1;
                            week++;
                        }
                        $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).text(index);
                        $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).attr('id',start);
                        if (start == this.today) {
                            $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).addClass("today");
                        }
                        if (projects[0][months].length > projects[1][months].length) {
                            max = projects[0][months].length;
                        } else {
                            max = projects[1][months].length;
                        }
                        for (let p = 0; p <= max; p++) {
                            if (start == projects[0][months][p]) {
                                $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).addClass("project-deadline");
                            }
                            if (start == projects[1][months][p]) {
                                $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).addClass("project-group-deadline");
                                $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).attr('data-toggle', 'tooltip');
                                $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).attr('data-placement', 'right');
                                $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).attr('data-container', 'body');
                                $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).attr('title', "teste");
                            }
                        }
                        start = moment(start).add(1, 'day').format('YYYY-MM-DD');
                        weekday++;
                    }
                }
            }
        }

        const cal = new Calendar();
        cal.init();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            })
        })

    </script>
    <style>
        table {
            table-layout: fixed;
        }
        tr {
            line-height: 37px;
            min-height: 37px;
            height: 37px;
        }
        .today, .project-deadline, .project-group-deadline, .project-meeting {
            font-weight: 800;
            color: #2c3fb1;
            border-radius: 100%;
        }
        .today  {
            background-color: white;
        }
        .project-deadline {
            background-color: red;
        }
        .project-group-deadline {
            background-color: green;
        }
        .project-meeting {
            background-color: yellow;
        }
        .selected {
            background-color: #2196f3;
            box-shadow: 0 5px 10px -5px rgba(0, 0, 0, 0.75);
            border-radius: 50%;
            color: #111;
        }
    </style>
</div>
@endsection

