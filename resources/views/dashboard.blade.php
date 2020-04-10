@extends('layouts.app')
@section('content')
<div class="container-xl-fluid mt-3 pl-5 pr-5 pb-2 ">
    @include('layouts.messages')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h3>Dashboard</h3>
    <div class="row mt-3 rounded h-100" style="height: 90vh; background-color: #ededed;">
        <div class="col-sm-4">
            <div class="container" >
                <button type="button" class="previous btn btn-default btn-lg" style="text-align: center;width: 100%; color:#2c3fb1">
                    <span class="fas fa-chevron-up"></span>
                </button>
                <div class="rounded mt-2" style="background-color: #c6c6c6;">
                    <h3 class="month1 pt-1" style="text-align: center;"></h3>
                    <div class="table-responsive-xl" style="background-color: #c6c6c6;">
                        <table class="month1-cal table table-sm table-borderless" style="text-align: center;">
                            <thead>
                            <tr>
                                <th scope="col">M</th>
                                <th scope="col">T</th>
                                <th scope="col">W</th>
                                <th scope="col">T</th>
                                <th scope="col">F</th>
                                <th scope="col">S</th>
                                <th scope="col">S</th>
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
                                <th scope="col">M</th>
                                <th scope="col">T</th>
                                <th scope="col">W</th>
                                <th scope="col">T</th>
                                <th scope="col">F</th>
                                <th scope="col">S</th>
                                <th scope="col">S</th>
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

        <div class="col-sm-8">
            <div class="overflow-auto rounded">
                <h3 class="pt-3 pl-3">Subjects</h3>
                <div class="container overflow-auto mw-80" style="max-height: 75vh;">
                    @if(count($subjects) > 0)
                        @foreach($subjects as $subject)

                            <div class="container overflow-auto p-2 mt-3 rounded" style="background-color: #c6c6c6;">
                                <h4 class="mt-2 pl-2 float-left">{{$subject->subjectName}}</h4>
                                <button style="color:#2c3fb1" type="button" class="cadeira btn btn-default btn-lg float-right" id="{{$subject->idSubject}}">
                                    <span class="fas fa-plus"></span>
                                </button>
                            </div>

                            <div class="container overflow-hidden  rounded-bottom doff" id="{{$subject->idSubject}}-groups" style="display: none; background-color: white;">
                                @if(count($projects->whereIn('idSubject', $subject->idSubject)) > 0)
                                    @foreach($projects as $project)
                                        @if($subject->idSubject == $project->idSubject)
                                            <h5 class="p-2">
                                                @if(Auth::user()->role == 'student')
                                                    <a style="color:#2c3fb1;" href="/student/project/{{$project->idProject}}">{{$project->name}}</a>
                                                @elseif(Auth::user()->role == 'professor')
                                                    <a style="color:#2c3fb1;" href="/professor/project/{{$project->idProject}}">{{$project->name}}</a>
                                                    <button type="button" class="btn btn-secondary float-right open_modalEdit" id="{{$project->idProject}}">Edit</button>
                                                @endif
                                            </h5>
                                        @endif
                                    @endforeach
                                @else
                                    <h5 class="p-2">No projects found</h5>
                                @endif
                                @if (Auth::user()->role == 'professor')
                                    <button style="background-color:#2c3fb1" type="button" class="btn float-right m-2 open_modal" id="{{$subject->idSubject}}">Create Project</button>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p>No subjects found</p>
                    @endif
                </div>
                <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Cadeiras Antigas</button>
            </div>
        </div>
    </div>

    {{--    Modal Edit--}}

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Edit Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['ProfessorProjectsController@update',0], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'formEdit']) !!}
                    <div class="form-group">
                        {{Form::label('title', 'Name')}}
                        {{Form::text('title', $project->name, ['class' => 'form-control', 'placeholder' => 'Country'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('deadline', 'Deadline')}}
                        {{Form::date('deadline', $project->dueDate, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('deadline', 'Group Formation Deadline')}}
                        {{Form::date('group formation deadline', $project->groupCreationDueDate, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('number of elements', 'No. of Members')}}
                        {{Form::selectRange('number of elements', $project->maxElements, 10)}}
                    </div>
                    <div class="form-group">
                        {{Form::label('announcement', 'Announcement')}}
                        {{Form::file('')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('documentation', 'Documentation')}}
                        {{Form::file('')}}
                    </div>
                    {{ Form::hidden('project', "project") }}


                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

{{--    Modal Create--}}
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">New Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'ProfessorProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::label('title', 'Name')}}
                            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Project Name'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('deadline', 'Deadline')}}
                            {{ Form::date('deadline', null,['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{Form::label('deadline', 'Group Formation Deadline')}}
                            {{ Form::date('group formation deadline', null,['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{Form::label('number of elements', 'No. of Members')}}
                            {{Form::selectRange('number_of_elements', 1, 10)}}
                        </div>
                        <div class="form-group">
                            {{Form::label('announcement', 'Announcement')}}
                            {{Form::file('')}}
                        </div>
                        <div class="form-group">
                            {{Form::label('documentation', 'Documentation')}}
                            {{Form::file('')}}
                        </div>
                        {{ Form::hidden('subject', "subject") }}

                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

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
                    $("#" + id).children().addClass('fa-minus').removeClass('fa-plus');
                    $("#" + id + "-groups").slideDown(400);
                } else {
                    $("#" + id + "-groups").addClass( "doff" );
                    $("#" + id).children().addClass('fa-plus').removeClass('fa-minus');
                    $("#" + id + "-groups").slideUp(400);
                }
            });

            $(".open_modal").click(function(){
                $('input[name="subject"]').val($(this).attr("id"));
                $('#modalCreate').modal('show');
            });

            $(".open_modalEdit").click(function(){
                var projectId = $(this).attr("id");
                $('input[name="project"]').val(projectId);
                $('#modalEdit').modal('show');
                $('#formEdit').attr('action', function(i, value){
                    return value + projectId;
                });
                console.log($('#modalEdit').attr('action'));
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
                $("table.month1-cal tr > td").removeClass("today");
                $("table.month2-cal tr > td").removeClass("today");
                this.monthDiv.innerText = this.monthString;
                this.nextMonthDiv.innerText = this.nextMonthString;

                for (let months = 0; months <= 1; months++) {
                    let week = 1;
                    let weekday = moment(this.calendarDays[months].first).isoWeekday();
                    let start = moment(this.calendarDays[months].first).format('YYYY-MM-DD');
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
                        start = moment(start).add(1, 'day').format('YYYY-MM-DD');
                        weekday++;
                    }
                }
            }
        }

        const cal = new Calendar();
        cal.init();

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
        .today  {
            font-weight: 800;
            color: #2c3fb1;
            background-color: white;
            border-radius: 100%;

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

