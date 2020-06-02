@extends('layouts.app')
@section('content')
<head>
    <title>Post</title>
</head>
<div class="container-fluid pl-5 pr-5 pb-2 mt-3">
    @include('layouts.messages')
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 h3" style="background-color:white; ">
            <li class="breadcrumb-item" aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
            @if (Auth::user()->role == 'professor')
                <li class="breadcrumb-item" aria-current="page"><a style="color:#2c3fb1;" href="/professor/project/{{$project->idProject}}#forum">{{$subject->subjectName}} - {{$project->name}}</a></li>
            @elseif (Auth::user()->role == 'student')
                <li class="breadcrumb-item" aria-current="page"><a style="color:#2c3fb1;" href="/student/project/{{$project->idProject}}#forum">{{$subject->subjectName}} - {{$project->name}}</a></li>
            @endif
            <li class="breadcrumb-item" aria-current="page">{{$announcement->title}}</li>
        </ol>
    </nav>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @if (Auth::user()->role == 'professor')
            <li class="nav-item">
                <a class="nav-link" href="/professor/project/{{$project->idProject}}#characteristics">{{__('gx.characteristics')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/professor/project/{{$project->idProject}}#groups">{{__('gx.groups')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="forum-tab" data-toggle="tab" href="#forum" role="tab">{{__('gx.forum')}}</a>
            </li>
        @elseif (Auth::user()->role == 'student')
            <li class="nav-item">
                <a class="nav-link" href="/student/project/{{$project->idProject}}#content">{{__('gx.content')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/student/project/{{$project->idProject}}#schedule">{{__('gx.schedule')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="forum-tab" data-toggle="tab" href="#forum" role="tab">{{__('gx.forum')}}</a>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="myTabContent" style="background-color: #ededed; min-height: 75vh; ">
        <div class="container-fluid tab-pane fade ml-0 mr-0" id="content" role="tabpanel" aria-labelledby="conteudo-tab" style="background-color: #ededed;"></div>
        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab"></div>
        <div class="tab-pane fade active show" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <div class="container pb-3 rounded px-5 pt-3">
                <div class="container-xl-fluid mt-3 p-3 rounded" style="background-color: white;">
                    <header class="header row mb-3 pl-3">
                        <div class="mr-3">
                            <img class="editable img-responsive" style="border-radius: 100%; height: 50px; width: 50px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$poster->photo)}}">
                        </div>
                        <div>
                            <h5>{{$announcement->title}}</h5>
                            <h6>By: <a href="/profile/{{$poster->id}}">{{$poster->name}}</a><small> - {{__('gx.posted on')}} {{$announcement->date}}</small></h6>
                        </div>
                    </header>
                    <hr>
                    <div>
                        {!!$announcement->body!!}
                    </div>
                    <hr>
                    <button type="button" class="btn" data-toggle="modal" data-target="#modalComment" style="background: #2c3fb1;color: white;">{{__('gx.reply')}}</button>
                    <div class="modal fade" id="modalComment" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.new comment')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['action' => ['PostController@reply', $project -> idProject], 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {{Form::label('comment', trans('gx.comment'))}}
                                        {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Body'])}}
                                    </div>
                                    {{ Form::hidden('announcement', $announcement->idAnnouncement) }}

                                    {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success'])}}

                                    {!! Form::close() !!}
                                </div>
                                <script>ClassicEditor
                                        .create( document.querySelector( '#comment' ), {
                                            toolbar: {
                                                items: [
                                                    'heading',
                                                    '|',
                                                    'fontSize',
                                                    'fontFamily',
                                                    'fontColor',
                                                    'fontBackgroundColor',
                                                    'highlight',
                                                    'bold',
                                                    'italic',
                                                    'underline',
                                                    'strikethrough',
                                                    'link',,
                                                    '|',
                                                    'undo',
                                                    'redo',
                                                    '|',
                                                    'indent',
                                                    'outdent',
                                                    '|',
                                                    'bulletedList',
                                                    'numberedList',
                                                    '|',
                                                    'blockQuote',
                                                    'code',
                                                    'codeBlock'
                                                ]
                                            },
                                            language: 'en',
                                            licenseKey: '',
                                        } )
                                        .then( editor => {
                                            window.editor = editor;
                                        } )
                                        .catch( error => {
                                            console.error( 'Oops, something gone wrong!' );
                                            console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
                                            console.warn( 'Build id: ce7zysryrfsm-xck2pu5o5swz' );
                                            console.error( error );
                                        } );
                                </script>
                                <style>
                                    .ck-editor__editable_inline {
                                        min-height: 40vh;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->id == $poster->id and count($comments) == 0)
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEdit">{{__('gx.edit')}}</button>
                        {{--Modal Edit--}}
                        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.edit post')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['action' => ['PostController@update', $project -> idProject, $announcement->idAnnouncement], 'method' => 'PUT']) !!}
                                        <div class="form-group">
                                            {{Form::label('title', trans('gx.title'))}}
                                            {{Form::text('title', $announcement->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('body', trans('gx.body'))}}
                                            {{Form::textarea('body', $announcement->body, ['class' => 'form-control', 'placeholder' => 'Body'])}}
                                        </div>

                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::submit(trans('gx.submit')), ['class'=>'btn btn-success'])}}

                                        {!! Form::close() !!}
                                    </div>
                                    <script>ClassicEditor
                                            .create( document.querySelector( '#body' ), {
                                                toolbar: {
                                                    items: [
                                                        'heading',
                                                        '|',
                                                        'fontSize',
                                                        'fontFamily',
                                                        'fontColor',
                                                        'fontBackgroundColor',
                                                        'highlight',
                                                        'bold',
                                                        'italic',
                                                        'underline',
                                                        'strikethrough',
                                                        'link',,
                                                        '|',
                                                        'undo',
                                                        'redo',
                                                        '|',
                                                        'indent',
                                                        'outdent',
                                                        '|',
                                                        'bulletedList',
                                                        'numberedList',
                                                        '|',
                                                        'blockQuote',
                                                        'code',
                                                        'codeBlock'
                                                    ]
                                                },
                                                language: 'en',
                                                licenseKey: '',
                                            } )
                                            .then( editor => {
                                                window.editor = editor;
                                            } )
                                            .catch( error => {
                                                console.error( 'Oops, something gone wrong!' );
                                                console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
                                                console.warn( 'Build id: ce7zysryrfsm-xck2pu5o5swz' );
                                                console.error( error );
                                            } );
                                    </script>
                                    <style>
                                        .ck-editor__editable_inline {
                                            min-height: 40vh;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">{{__('gx.delete')}}</button>
                        <div class="modal fade" id="modalDelete" aria-labelledby="modalDelete" aria-hidden="true" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.delete post')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>{{__('gx.areyousuredeletethispost')}}</h5>
                                        {!!Form::open(['action' => ['PostController@destroy', $project->idProject, $announcement->idAnnouncement], 'method' => 'POST'])!!}
                                        {{Form::hidden('option', 'post')}}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit(trans('gx.delete'), ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if(count($comments) > 0)
                    @for($i = 0; $i < count($comments); $i++)
                        <div class="container-xl-fluid mt-3 ml-5 p-3 rounded" style="background-color: white;">
                            <header class="header row mb-3 pl-3">
                                <div class="mr-3">
                                    <img class="editable img-responsive" style="border-radius: 100%; height: 50px; width: 50px; object-fit: cover;vertical-align: middle;" alt="Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$commenters[$i]->photo)}}">
                                </div>
                                <div>
                                    <h5>{{__('gx.re')}}: {{$announcement->title}}</h5>
                                    <h6>{{__('gx.by')}}: <a href="/profile/{{$commenters[$i]->id}}">{{$commenters[$i]->name}}</a><small> - {{__('gx.posted on')}} {{$comments[$i]->date}}</small></h6>
                                </div>
                            </header>
                            <hr>
                            <div>
                                {!!$comments[$i]->comment!!}
                            </div>
                            @if(Auth::user()->id == $commenters[$i]->id)
                                <hr>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteComment-{{$comments[$i]->idAnnouncementComment }}">{{__('gx.delete')}}</button>
                                <div class="modal fade" id="modalDeleteComment-{{$comments[$i]->idAnnouncementComment }}" aria-labelledby="modalDeleteComment-{{$comments[$i]->idAnnouncementComment }}" aria-hidden="true" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">{{__('gx.delete comment')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{__('gx.areyousuredeletethiscomment')}}</h5>
                                                {!!Form::open(['action' => ['PostController@destroy', $project->idProject, $announcement->idAnnouncement], 'method' => 'POST'])!!}
                                                {{Form::hidden('option', 'comment')}}
                                                {{Form::hidden('comment', $comments[$i]->idAnnouncementComment)}}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit(trans('gx.delete'), ['class' => 'btn btn-danger'])}}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
<style>
    .nav-tabs .nav-link.active{
        background-color: #ededed;
        border-color:#ededed;
    }
    .nav-tabs .nav-link{
        color: #2c3fb1;
    }
</style>
@endsection
