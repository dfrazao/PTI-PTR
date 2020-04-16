@extends('layouts.app')
@section('content')
<div class="container-fluid pl-5 pr-5 pb-2 mt-3">
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a style="color:#2c3fb1;" href="../student/project/{{$project->idProject}}">{{$subject->subjectName}} - {{$project->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$announcement->title}}</li>
        </ol>
    </nav>
    <h3 class="pb-2">{{$subject->subjectName}} - {{$project->name}}</h3>
    <div class="container pb-3 rounded px-5 pt-3">
        {{$announcement->title}}
        {{$announcement->body}}
        {{$announcement->date}}
    </div>
</div>
@endsection
