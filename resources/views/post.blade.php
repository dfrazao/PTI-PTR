@extends('layouts.app')
@section('content')
<div class="container-fluid pl-5 pr-5 pb-2 mt-3">
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a style="color:#2c3fb1;" href="/student/project/{{$project->idProject}}#forum">{{$subject->subjectName}} - {{$project->name}} Forum</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$announcement->title}}</li>
        </ol>
    </nav>
    <h2 class="pb-2">{{$subject ->subjectName}} - {{$project->name}}</h2>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <style>
            .nav-tabs .nav-link.active{
                background-color: #ededed;
                border-color:#ededed;
            }
            .nav-tabs .nav-link{
                color: #2c3fb1;
            }
        </style>
        <li class="nav-item">
            <a class="nav-link" href="/student/project/{{$project->idProject}}#content">Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/student/project/{{$project->idProject}}#schedule">Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="noticias-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="noticias" aria-selected="true">Forum</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent" style="background-color: #ededed; height: 75vh; ">
        <div class="container-fluid tab-pane fade ml-0 mr-0" id="content" role="tabpanel" aria-labelledby="conteudo-tab" style="background-color: #ededed;"></div>
        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab"></div>
        <div class="tab-pane fade active show" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <div class="container pb-3 rounded px-5 pt-3">
                <div class="container-xl-fluid mt-3 pl-5 pr-5 pb-2">
                    <header class="header row mb-3">
                        <div class="mr-3">
                            <img class="editable img-responsive" style="border-radius: 100%; height: 50px; width: 50px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="/storage/profilePhotos/{{$poster->photo}}">
                        </div>
                        <div>
                            <h5>{{$announcement->title}}</h5>
                            <h6>By: <a href="/profile/{{$poster->id}}">{{$poster->name}}</a><small> - Posted on {{$announcement->date}}</small></h6>
                        </div>
                    </header>
                    <p>{{$announcement->body}}</p>
                    @if(Auth::user()->id == $poster->id)
                        <button type="button" class="btn btn-success">Edit</button>

                        {{--{!!Form::open(['route' => ['PostController@destroy', $project->idProject, $announcement->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}--}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
