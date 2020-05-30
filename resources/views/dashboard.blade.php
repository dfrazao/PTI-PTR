@extends('layouts.app')
@section('content')
<head>
    <title>Dashboard</title>
</head>
<div class="container-xl-fluid mt-4 pl-5 pr-5 pb-2" style="position: relative;">
    @include('layouts.messages')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="dropdown float-right">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #2c3fb1; border-color: #2c3fb1;">
            Ano Letivo
        </button>
        <div class="dropdown-menu" id="dropdown" aria-labelledby="dropdownMenu" style="z-index: 1;">
            @foreach($academicYears  as $academicYear)
                <a class="dropdown-item" id="{{$academicYear->academicYear}}-tab">{{$academicYear->academicYear}}</a>
            @endforeach
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 pl-0 pb-0 pt-0 h3" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page">{{__('gx.dashboard')}}</li>
        </ol>
    </nav>
    <div class="row mb-3 rounded h-100" style="height: 90vh; background-color: #ededed;">

        <div class="col" style="max-width: 400px;">
            <div class="container">
                <button type="button" class="previous btn btn-default btn-lg" style="text-align: center;width: 100%; color:#2c3fb1">
                    <span class="fas fa-chevron-up"></span>
                </button>
                <div class="rounded mt-2" style="background-color: #c6c6c6;">
                    <h3 class="month1 pt-1" style="text-align: center;"></h3>
                    <div class="table-responsive-xl rounded" style="background-color: #c6c6c6;">
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

        <div class="col pl-0">
            <div class="overflow-auto rounded pb-2">
                <h3 class="pt-3 pl-2 mb-0">{{__('gx.subjects')}}</h3>
                <div class="tab-content" id="myTabContent" style="min-height: 75vh;">
                    @foreach($academicYears  as $academicYear)
                        <div class="years overflow-auto p-0 mr-2 ml-2 d-none" id="{{$academicYear->academicYear}}" style="max-height: 75vh;">
                            <?php
                                $subjectYear = $subjects->whereIn('academicYear', $academicYear->academicYear);

                                $first1 = Carbon\Carbon::today()->subYears(1)->month(8)->day(1);
                                $second1 = Carbon\Carbon::today()->month(7)->day(31)->hour(23)->minute(59)->second(59);
                                $first2 = Carbon\Carbon::today()->month(8)->day(1);
                                $second2 = Carbon\Carbon::today()->addYears(1)->month(7)->day(31);

                                if (Carbon\Carbon::today()->between($first1, $second1)) {
                                    $currentYear = $first1->year . '/' . $second1->year;
                                } else if (Carbon\Carbon::today()->between($first2, $second2)) {
                                    $currentYear = $first2->year . '/' . $second2->year;
                                }
                            ?>
                            @if(count($subjectYear) > 0)
                                @foreach($subjectYear as $subject)

                                    <div class="overflow-auto p-2 mt-2 rounded cadeira" type="button" id="{{$subject->idSubject}}" style="background-color: #c6c6c6;">
                                        <h4 class="mt-2 pl-2 float-left">{{$subject->subjectName}}</h4>
                                        <button style="color:#2c3fb1" type="button" class="btn btn-default btn-lg float-right" id="button-{{$subject->idSubject}}">
                                            <span class="fas fa-plus"></span>
                                        </button>
                                    </div>

                                    <div class="overflow-hidden rounded-bottom doff" id="{{$subject->idSubject}}-groups" style="display: none; background-color: white;">
                                        @if(count($projects->whereIn('idSubject', $subject->idSubject)) > 0)
                                            @foreach($projects as $project)
                                                @if($subject->idSubject == $project->idSubject)
                                                    <div class="p-2 projeto" id="{{$project->idProject}}" type="button" onclick="{{(Auth::user()->role == 'student' ? (isset($project->group) == True ? 'window.location.href = "/student/project/"+id;':'window.location.href = "/student/project/"+id+"/groups";'): 'window.location.href = "/professor/project/"+id;')}}" style="display: flex;justify-content: space-between;align-items: center;">
                                                        @if(Auth::user()->role == 'student')
                                                            <p class="my-1 h5" style="display:inline-block;width: 10em;">{{$project->name}}</p>
                                                            <div style="display: flex;text-align: center;align-items: center;"><i class='far fa-lg fa-users float-left'></i><div id="timer1-{{$project->idProject}}" class="timer"></div></div>
                                                            <div style="display: flex;text-align: center;align-items: center;"><i class='far fa-lg fa-file-alt float-left'></i><div id="timer2-{{$project->idProject}}" class="timer"></div></div>
                                                            <script>
                                                                function updateTimer1{{$project->idProject}}() {
                                                                    future = Date.parse("{{$project->groupCreationDueDate}}");
                                                                    now = new Date();
                                                                    diff = future - now;

                                                                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                                                    hours = Math.floor(diff / (1000 * 60 * 60));
                                                                    mins = Math.floor(diff / (1000 * 60));
                                                                    secs = Math.floor(diff / 1000);

                                                                    d = days;
                                                                    h = hours - days * 24;
                                                                    m = mins - hours * 60;
                                                                    s = secs - mins * 60;

                                                                    if (d<0 || (d==0 && h==0 && m==0 && s==0)){
                                                                        document.getElementById("timer1-{{$project->idProject}}").innerHTML = '<div class="ml-2">Terminado</div>';
                                                                    }else if (d==0 && h==0 && m==0){
                                                                        document.getElementById("timer1-{{$project->idProject}}").innerHTML = '<div>' + s + '<span>seconds</span></div>';
                                                                    } else if (d==0){
                                                                        document.getElementById("timer1-{{$project->idProject}}")
                                                                            .innerHTML =
                                                                            '<div>' + h + '<span>hours</span></div>' +
                                                                            '<div>' + m + '<span>minutes</span></div>' +
                                                                            '<div>' + s + '<span>seconds</span></div>';
                                                                    }
                                                                    else{
                                                                        document.getElementById("timer1-{{$project->idProject}}")
                                                                            .innerHTML =
                                                                            '<div>' + d + '<span>days</span></div>' +
                                                                            '<div>' + h + '<span>hours</span></div>' +
                                                                            '<div>' + m + '<span>minutes</span></div>';
                                                                    }
                                                                }
                                                                function updateTimer2{{$project->idProject}}() {
                                                                    future = Date.parse("{{$project->dueDate}}");
                                                                    now = new Date();
                                                                    diff = future - now;

                                                                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                                                    hours = Math.floor(diff / (1000 * 60 * 60));
                                                                    mins = Math.floor(diff / (1000 * 60));
                                                                    secs = Math.floor(diff / 1000);

                                                                    d = days;
                                                                    h = hours - days * 24;
                                                                    m = mins - hours * 60;
                                                                    s = secs - mins * 60;

                                                                    if (d<0 || (d==0 && h==0 && m==0 && s==0)){
                                                                        document.getElementById("timer2-{{$project->idProject}}").innerHTML = '<div class="ml-2">Terminado</div>';
                                                                    }else if (d==0 && h==0 && m==0){
                                                                        document.getElementById("timer2-{{$project->idProject}}").innerHTML = '<div>' + s + '<span>seconds</span></div>';
                                                                    } else if (d==0){
                                                                        document.getElementById("timer2-{{$project->idProject}}")
                                                                            .innerHTML =
                                                                            '<div>' + h + '<span>hours</span></div>' +
                                                                            '<div>' + m + '<span>minutes</span></div>' +
                                                                            '<div>' + s + '<span>seconds</span></div>';
                                                                    }
                                                                    else{
                                                                        document.getElementById("timer2-{{$project->idProject}}")
                                                                            .innerHTML =
                                                                            '<div>' + d + '<span>days</span></div>' +
                                                                            '<div>' + h + '<span>hours</span></div>' +
                                                                            '<div>' + m + '<span>minutes</span></div>';
                                                                    }
                                                                }
                                                                updateTimer1{{$project->idProject}}();
                                                                //setInterval('updateTimer1{{$project->idProject}}()', 1000);
                                                                updateTimer2{{$project->idProject}}();
                                                                //setInterval('updateTimer2{{$project->idProject}}()', 1000);
                                                            </script>
                                                            @if(isset($project->group))
                                                                <a type="button" class="btn btn-sm btn-success" href="/student/project/{{$project->idProject}}" style="background-color: #2c3fb1; border-color: #2c3fb1;width: 10em;">{{__('gx.group')}} {{$project->group}}</a>
                                                            @else
                                                                <a type="button" class="btn btn-sm btn-success" href="/student/project/{{$project->idProject}}/groups" style="width: 10em;">{{__('gx.join/create group')}}</a>
                                                            @endif
                                                        @elseif(Auth::user()->role == 'professor')
                                                            <h5 class="mt-1 mb-1"><a style="color:#2c3fb1;" href="/professor/project/{{$project->idProject}}">{{$project->name}}</a></h5>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if (Auth::user()->role == 'professor' and $academicYear->academicYear == $currentYear)
                                                <button style="background-color:#2c3fb1;color: #fff;" type="button" class="btn btn-sm float-right m-2 open_modal" id="{{$subject->idSubject}}">{{__('gx.create project')}}</button>
                                            @endif
                                        @else
                                            @if (Auth::user()->role == 'professor' and $academicYear->academicYear == $currentYear)
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>

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
                        {{Form::label('group formation deadline', trans('gx.group formation deadline'))}}
                        {{Form::text('group formation deadline', null, ['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker1-dp', 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker1-dp'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('deadline', trans('gx.deadline'))}}
                        {{Form::text('deadline', null, ['class' => 'form-control datetimepicker-input', 'id' => 'datetimepicker2-dp', 'data-toggle' => 'datetimepicker', 'data-target' => '#datetimepicker2-dp'])}}
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
                <script>
                    $(function() {$( "#datetimepicker1-dp" ).datetimepicker({
                        minDate: moment().format('YYYY-MM-DD HH:mm'),
                        date: moment().format('YYYY-MM-DD HH:mm'),
                        locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                        icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                    });});
                    $(function() {$( "#datetimepicker2-dp" ).datetimepicker({
                        minDate: moment().format('YYYY-MM-DD HH:mm'),
                        date: moment().format('YYYY-MM-DD HH:mm'),
                        locale: "{{ str_replace('_', '-', app()->getLocale()) }}",
                        icons: {time: "fa fa-clock", date: "fa fa-calendar", up: "fa fa-arrow-up", down: "fa fa-arrow-down"}
                    });});
                    $("#datetimepicker1").on("change.datetimepicker", function (e) {
                        $('#datetimepicker2').datetimepicker('minDate', e.date);
                    });
                    $("#datetimepicker2").on("change.datetimepicker", function (e) {
                        $('#datetimepicker1').datetimepicker('maxDate', e.date);
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<style>
    table {
        table-layout: fixed;
    }
    .month1, .month2 {
        color: #2c3fb1;
    }
    tr {
        line-height: 37px;
        min-height: 37px;
        height: 37px;
    }
    .today, .project-deadline, .project-group-deadline, .project-meeting {
        font-weight: 500;
        border-radius: 100%;
        box-shadow: 0 5px 10px -5px rgba(0, 0, 0, .75);
    }
    .project-deadline, .project-group-deadline, .project-meeting {
        background-color: #2c3fb1;
        color: white;
        opacity: 0.9;
    }
    .past {
        opacity: 0.5;
    }
    .today {
        background-color: white;
        opacity: 1 !important;
        color: #2c3fb1;
    }
    .tooltip {
    }
    .tooltip .tooltip-inner {
        min-width: 215px;
        max-width: 300px;
    }
    .arrow {
    }
    .separator {
        border-top: 1px solid white; !important
    }

    .timer {
        font-size: 1.30em;
        font-weight: 100;
        color: navy;
        display: inline-block;
        min-width: 45px;
    }

    .timer div {
        display: inline-block;
        min-width: 45px;
    }

    .timer div span {
        color: black;
        display: block;
        font-size: .50em;
        font-weight: 400;
    }
</style>
<script>
    $('#dropdown a').click(function(e) {
        oldYear = sessionStorage.getItem("year");
        $("#"+oldYear).addClass("d-none");
        selected = $(this).attr('id').split("-")[0]
        $("#dropdownMenu").html(selected);
        $("#"+selected.replace("/","\\/")).removeClass("d-none");
        sessionStorage.setItem("year", selected.replace("/","\\/"));
    });

    // on load of the page: switch to the currently selected tab
    if (sessionStorage.getItem("year") === null) {
        var year;
        first1 = moment().subtract(1, 'y').month(8);
        second1 = moment().month(7).day(31);
        first2 = moment().month(8);
        second2 = moment().add(1, 'y').month(7).day(31);
        if (moment().isBetween(first1, second1)) {
            year = first1.year() + '\\/' + second1.year();
        } else if (moment().isBetween(first2, second2)) {
            year = first2.year() + '\\/' + second2.year();
        }
        $("#"+year).removeClass("d-none");
        sessionStorage.setItem("year", year);
        $("#dropdownMenu").html(year.replace("\\",""));
    } else {
        year = sessionStorage.getItem("year");
        $("#"+year).removeClass("d-none");
        $("#dropdownMenu").html(year.replace("\\",""));
    }

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
            $("table.month1-cal tr > td").removeClass("past today project-deadline project-group-deadline project-meeting");
            $("table.month2-cal tr > td").removeClass("past today project-deadline project-group-deadline project-meeting");
            $("table.month1-cal tr > td").removeAttr("data-toggle data-placement data-container data-html data-original-title title");
            $("table.month2-cal tr > td").removeAttr("data-toggle data-placement data-container data-html data-original-title title");
            this.monthDiv.innerText = this.monthString;
            this.nextMonthDiv.innerText = this.nextMonthString;

            let events = [ [[[],[]],[[],[]]] , [[[],[]],[[],[]]] , [[],[]] , [[],[]] ];
            let deadlineMonthYear;
            let groupDeadlineMonthYear;
            @foreach($projects as $project)
                deadlineMonthYear = moment('{{$project->dueDate}}').format('MMMM YYYY');
            groupDeadlineMonthYear = moment('{{$project->groupCreationDueDate}}').format('MMMM YYYY');
            if (deadlineMonthYear == this.monthString) {
                events[0][0][0].push(moment('{{$project->dueDate}}').format('YYYY-MM-DD'));
                events[0][0][1].push(['{{$project->name}}','{{$project->dueDate}}','{{\App\Subject::find($project->idSubject)->subjectName}}']);
            } else if (deadlineMonthYear == this.nextMonthString) {
                events[0][1][0].push(moment('{{$project->dueDate}}').format('YYYY-MM-DD'));
                events[0][1][1].push(['{{$project->name}}','{{$project->dueDate}}','{{\App\Subject::find($project->idSubject)->subjectName}}']);
            }
            if (groupDeadlineMonthYear == this.monthString) {
                events[1][0][0].push(moment('{{$project->groupCreationDueDate}}').format('YYYY-MM-DD'));
                events[1][0][1].push(['{{$project->name}}','{{$project->groupCreationDueDate}}','{{\App\Subject::find($project->idSubject)->subjectName}}']);
            } else if (groupDeadlineMonthYear == this.nextMonthString) {
                events[1][1][0].push(moment('{{$project->groupCreationDueDate}}').format('YYYY-MM-DD'));
                events[1][1][1].push(['{{$project->name}}','{{$project->groupCreationDueDate}}','{{\App\Subject::find($project->idSubject)->subjectName}}']);
            }
                @endforeach

            let meetingMonthYear;
            @foreach($meetings as $m)
                meetingMonthYear = moment('{{$m->date}}').format('MMMM YYYY');
            if (meetingMonthYear == this.monthString) {
                events[2][0].push(moment('{{$m->date}}').format('YYYY-MM-DD'));
                events[2][1].push(['{{$m->description}}', '{{$m->place}}', '{{$m->date}}', '{{$m->hour}}', '{{$m->project}}', '{{$m->subject}}']);
            } else if (meetingMonthYear == this.nextMonthString) {
                events[3][0].push(moment('{{$m->date}}').format('YYYY-MM-DD'));
                events[3][1].push(['{{$m->description}}', '{{$m->place}}', '{{$m->date}}', '{{$m->hour}}', '{{$m->project}}', '{{$m->subject}}']);
            }
                @endforeach

            for (let months = 0; months <= 1; months++) {
                let week = 1;
                let weekday = moment(this.calendarDays[months].first).isoWeekday();
                let start = moment(this.calendarDays[months].first).format('YYYY-MM-DD');
                let max;
                let max1;
                let day;
                for (let index = 1; index <= this.calendarDays[months].last; index++) {
                    if (weekday == 8) {
                        weekday = 1;
                        week++;
                    }
                    day = ".month"+[months+1]+"-cal .week"+week+" ."+weekday;
                    $(day).text(index);
                    $(day).attr('id', start);
                    if (start < this.today) {
                        $(day).addClass("past");
                    } else if (start == this.today) {
                        $(day).addClass("today");
                    }
                    if (events[0][months][0].length > events[1][months][0].length) {
                        max = events[0][months][0].length;
                    } else {
                        max = events[1][months][0].length;
                    }
                    for (let p = 0; p <= max; p++) {
                        if (start == events[0][months][0][p]) {
                            let event_pd = "<p class='text-left m-0'><span class='far fa-file-alt float-left'></span>&nbsp;– {{__('gx.deadline')}}</p><p class='text-left m-0'><span class='far fa-book'></span>&nbsp;– "+events[0][months][1][p][2]+" - "+events[0][months][1][p][0]+"</p><p class='text-left m-0'><span class='far fa-calendar-alt'></span>&nbsp;– "+events[0][months][1][p][1]+"</p>";
                            if ($(day).hasClass("project-deadline") || $(day).hasClass("project-group-deadline") || $(day).hasClass("project-meeting")) {
                                event_pd = $(day).attr("data-original-title") + '<hr class="m-1 separator">' + event_pd;
                            } else {
                                $(day).attr('data-toggle', 'tooltip');
                                $(day).attr('data-placement', 'right');
                                $(day).attr('data-container', 'body');
                                $(day).attr('data-html', 'true');
                            }
                            $(day).addClass("project-deadline");
                            $(day).attr('data-original-title', event_pd);
                        }
                        if (start == events[1][months][0][p]) {
                            let event_pgd = "<p class='text-left m-0'><span class='far fa-users float-left'></span>&nbsp;– {{__('gx.group formation deadline')}}</p><p class='text-left m-0'><span class='far fa-book'></span>&nbsp;– "+events[1][months][1][p][2]+" - "+events[1][months][1][p][0]+"</p><p class='text-left m-0'><span class='far fa-calendar-alt'></span>&nbsp;– "+events[1][months][1][p][1]+"</p>";
                            if ($(day).hasClass("project-deadline") || $(day).hasClass("project-group-deadline") || $(day).hasClass("project-meeting")) {
                                event_pgd = $(day).attr("data-original-title") + '<hr class="m-1 separator">' + event_pgd;
                            } else {
                                $(day).attr('data-toggle', 'tooltip');
                                $(day).attr('data-placement', 'right');
                                $(day).attr('data-container', 'body');
                                $(day).attr('data-html', 'true');
                            }
                            $(day).addClass("project-group-deadline");
                            $(day).attr('data-original-title', event_pgd);
                        }
                    }
                    if (events[months+2][0].length > events[months+2][1].length) {
                        max1 = events[months+2][0].length;
                    } else {
                        max1 = events[months+2][1].length;
                    }
                    for (let m = 0; m <= max1; m++) {
                        if (start == events[months+2][0][m]) {
                            let event_pm = "<p class='text-left m-0'><span class='far fa-handshake float-left'></span>&nbsp;– {{__('gx.meeting')}}</p><p class='text-left m-0'><span class='far fa-book'></span>&nbsp;– "+events[months+2][1][m][5]+" - "+events[months+2][1][m][4]+"</p><p class='text-left m-0'><span class='far fa-map-marker-alt'></span>&nbsp;– "+events[months+2][1][m][1]+"</p><p class='text-left m-0'><span class='far fa-calendar-alt'></span>&nbsp;– "+events[months+2][1][m][2]+"&nbsp;"+events[months+2][1][m][3]+"</p>";
                            if ($(day).hasClass("project-deadline") || $(day).hasClass("project-group-deadline") || $(day).hasClass("project-meeting")) {
                                event_pm = $(day).attr("data-original-title") + '<hr class="m-1 separator">' + event_pm;
                            } else {
                                $(day).addClass("project-meeting");
                                $(day).attr('data-toggle', 'tooltip');
                                $(day).attr('data-placement', 'right');
                                $(day).attr('data-container', 'body');
                                $(day).attr('data-html', 'true');
                            }
                            $(day).attr('data-original-title', event_pm);
                        }
                    }
                    start = moment(start).add(1, 'day').format('YYYY-MM-DD');
                    weekday++;
                }
            }

            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        }
    }

    const cal = new Calendar();
    cal.init();

</script>
@endsection

