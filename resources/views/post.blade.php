@extends('layouts.app')
@section('content')
<head>
    <title>Post</title>
</head>
<div class="container-fluid pl-4 pr-4 pb-2 mt-3">
    @include('layouts.messages')
    <nav id="breadcrumb" aria-label="breadcrumb" >
        <ol id="breadcrumb" class="breadcrumb pl-0 pb-0 mb-4 h3" style="background-color:white; ">
            <li id="bc1" class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
            @if (Auth::user()->role == 'professor')
                <li class="breadcrumb-item" aria-current="page"><a style="color:#2c3fb1;" href="/professor/project/{{$project->idProject}}#forum">{{$subject->subjectName}} - {{$project->name}}</a></li>
            @elseif (Auth::user()->role == 'student')
                <li id="bc2" class="breadcrumb-item" aria-current="page"><a style="color:#2c3fb1;" href="/student/project/{{$project->idProject}}#forum">{{$subject->subjectName}} - {{$project->name}} - Group {{\App\Group::find($idGroup)->idGroupProject}}</a></li>
            @endif
            <li id="bc3" class="breadcrumb-item" aria-current="page">{{$announcement->title}}</li>
        </ol>
    </nav>

<style>
        @media screen and (max-width: 750px){
            #breadcrumb {
                font-size: 3vh;
                margin:0 auto;
                list-style:none;
            }
            #bc1 {
                margin-left: 33%;
            }
            #bc2 {
                margin-left: 10%; !important;
            }
            #bc3 {
                margin-left: 40%; !important;
            }
        }
    </style>

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

            <li class="nav-item">
                <a class="nav-link" id="submission-tab" data-toggle="tab" href="/student/project/{{$project->idProject}}#submission">{{__('gx.submission')}}</a>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="myTabContent" style="background-color: #ededed; min-height: 75vh; ">
        <div class="container-fluid tab-pane fade ml-0 mr-0" id="content" role="tabpanel" aria-labelledby="conteudo-tab" style="background-color: #ededed;"></div>
        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab"></div>
        <div class="tab-pane fade active show" id="forum" role="tabpanel" aria-labelledby="forum-tab">
            <div class="container pb-3 rounded px-3 pt-3">
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
                    <div id="text_post">
                        {!!$announcement->body!!}
                    </div>
                    <style>
                        @media screen and (max-width: 500px) {
                            #text_post{
                                margin-left: 0px; !important;
                            }
                        }
                    </style>
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
                                <div class="modal-body modal-body-post">
                                    {!! Form::open(['action' => ['PostController@reply', $project -> idProject], 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {{Form::label('comment', trans('gx.comment'))}}
                                        {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Body'])}}
                                    </div>
                                    {{ Form::hidden('announcement', $announcement->idAnnouncement) }}

                                    <div class="demo-update__controls">
                                        <span class="demo-update__words"></span>
                                        <svg class="demo-update__chart" viewbox="0 0 40 40" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                                            <circle stroke="hsl(0, 0%, 93%)" stroke-width="3" fill="none" cx="20" cy="20" r="17" />
                                            <circle class="demo-update__chart__circle" stroke="hsl(202, 92%, 59%)" stroke-width="3" stroke-dasharray="134,534" stroke-linecap="round" fill="none" cx="20" cy="20" r="17" />
                                            <text class="demo-update__chart__characters" x="50%" y="50%" dominant-baseline="central" text-anchor="middle"></text>
                                        </svg>
                                    </div>

                                    {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-success update__send'])}}

                                    {!! Form::close() !!}
                                </div>
                                <script>
                                    const maxCharacters = 800;
                                    const container = document.querySelector( '.modal-body-post' );
                                    const progressCircle = document.querySelector( '.demo-update__chart__circle' );
                                    const charactersBox = document.querySelector( '.demo-update__chart__characters' );
                                    const wordsBox = document.querySelector( '.demo-update__words' );
                                    const circleCircumference = Math.floor( 2 * Math.PI * progressCircle.getAttribute( 'r' ) );
                                    const sendButton = document.querySelector( '.update__send' );

                                    ClassicEditor
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
                                            language: '{{ str_replace('_', '-', app()->getLocale()) }}',
                                            licenseKey: '',
                                            wordCount: {
                                                onUpdate: stats => {
                                                    // Prints the current content statistics.
                                                    //console.log( `Characters: ${ stats.characters }\nWords: ${ stats.words }` );

                                                    const charactersProgress = stats.characters / maxCharacters * circleCircumference;
                                                    const isLimitExceeded = stats.characters > maxCharacters;
                                                    const isCloseToLimit = !isLimitExceeded && stats.characters > maxCharacters * .8;
                                                    const circleDashArray = Math.min( charactersProgress, circleCircumference );

                                                    // Set the stroke of the circle to show how many characters were typed.
                                                    progressCircle.setAttribute( 'stroke-dasharray', `${ circleDashArray },${ circleCircumference }` );

                                                    // Display the number of characters in the progress chart. When the limit is exceeded,
                                                    // display how many characters should be removed.
                                                    if ( isLimitExceeded ) {
                                                        charactersBox.textContent = `-${ stats.characters - maxCharacters }`;
                                                    } else {
                                                        charactersBox.textContent = stats.characters;
                                                    }

                                                    wordsBox.textContent = `{{__('gx.words in the post')}}: ${ stats.words }`;

                                                    // If the content length is close to the character limit, add a CSS class to warn the user.
                                                    container.classList.toggle( 'demo-update__limit-close', isCloseToLimit );

                                                    // If the character limit is exceeded, add a CSS class that makes the content's background red.
                                                    container.classList.toggle( 'demo-update__limit-exceeded', isLimitExceeded );

                                                    // If the character limit is exceeded, disable the send button.
                                                    sendButton.toggleAttribute( 'disabled', isLimitExceeded );

                                                }
                                            }
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
                                    <div class="modal-body modal-body-post">
                                        {!! Form::open(['action' => ['PostController@update', $project -> idProject, $announcement->idAnnouncement], 'method' => 'PUT']) !!}
                                        <div class="form-group">
                                            {{Form::label('title', trans('gx.title'))}}
                                            {{Form::text('title', $announcement->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('body', trans('gx.body'))}}
                                            {{Form::textarea('body', $announcement->body, ['class' => 'form-control', 'placeholder' => 'Body'])}}
                                        </div>

                                        <div class="demo-update__controls">
                                            <span class="demo-update__words"></span>
                                            <svg class="demo-update__chart" viewbox="0 0 40 40" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                                                <circle stroke="hsl(0, 0%, 93%)" stroke-width="3" fill="none" cx="20" cy="20" r="17" />
                                                <circle class="demo-update__chart__circle" stroke="hsl(202, 92%, 59%)" stroke-width="3" stroke-dasharray="134,534" stroke-linecap="round" fill="none" cx="20" cy="20" r="17" />
                                                <text class="demo-update__chart__characters" x="50%" y="50%" dominant-baseline="central" text-anchor="middle"></text>
                                            </svg>
                                        </div>

                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::submit(trans('gx.submit')), ['class'=>'btn btn-success update__send']}}

                                        {!! Form::close() !!}
                                    </div>
                                    <script>
                                        const maxCharacters = 800;
                                        const container = document.querySelector( '.modal-body-post' );
                                        const progressCircle = document.querySelector( '.demo-update__chart__circle' );
                                        const charactersBox = document.querySelector( '.demo-update__chart__characters' );
                                        const wordsBox = document.querySelector( '.demo-update__words' );
                                        const circleCircumference = Math.floor( 2 * Math.PI * progressCircle.getAttribute( 'r' ) );
                                        const sendButton = document.querySelector( '.update__send' );

                                        ClassicEditor
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
                                                language: '{{ str_replace('_', '-', app()->getLocale()) }}',
                                                licenseKey: '',
                                                wordCount: {
                                                    onUpdate: stats => {
                                                        // Prints the current content statistics.
                                                        //console.log( `Characters: ${ stats.characters }\nWords: ${ stats.words }` );

                                                        const charactersProgress = stats.characters / maxCharacters * circleCircumference;
                                                        const isLimitExceeded = stats.characters > maxCharacters;
                                                        const isCloseToLimit = !isLimitExceeded && stats.characters > maxCharacters * .8;
                                                        const circleDashArray = Math.min( charactersProgress, circleCircumference );

                                                        // Set the stroke of the circle to show how many characters were typed.
                                                        progressCircle.setAttribute( 'stroke-dasharray', `${ circleDashArray },${ circleCircumference }` );

                                                        // Display the number of characters in the progress chart. When the limit is exceeded,
                                                        // display how many characters should be removed.
                                                        if ( isLimitExceeded ) {
                                                            charactersBox.textContent = `-${ stats.characters - maxCharacters }`;
                                                        } else {
                                                            charactersBox.textContent = stats.characters;
                                                        }

                                                        wordsBox.textContent = `{{__('gx.words in the post')}}: ${ stats.words }`;

                                                        // If the content length is close to the character limit, add a CSS class to warn the user.
                                                        container.classList.toggle( 'demo-update__limit-close', isCloseToLimit );

                                                        // If the character limit is exceeded, add a CSS class that makes the content's background red.
                                                        container.classList.toggle( 'demo-update__limit-exceeded', isLimitExceeded );

                                                        // If the character limit is exceeded, disable the send button.
                                                        sendButton.toggleAttribute( 'disabled', isLimitExceeded );

                                                    }
                                                }
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

    /*.demo-update {
        border: 1px solid var(--ck-color-base-border);
        border-radius: var(--ck-border-radius);
        box-shadow: 2px 2px 0px hsla( 0, 0%, 0%, 0.1 );
        margin: 1.5em 0;
        padding: 1em;
    }

    .demo-update h3 {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 .5em;
        padding: 0;
    }

    .demo-update .ck.ck-editor__editable_inline {
        border: 1px solid hsla( 0, 0%, 0%, 0.15 );
        transition: background .5s ease-out;
        min-height: 6em;
        margin-bottom: 1em;
    }*/

    .demo-update__controls {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .demo-update__chart {
        margin-right: 1em;
    }

    .demo-update__chart__circle {
        transform: rotate(-90deg);
        transform-origin: center;
    }

    .demo-update__chart__characters {
        font-size: 13px;
        font-weight: bold;
    }

    .demo-update__words {
        flex-grow: 1;
        opacity: .5;
    }

    .demo-update__limit-close .demo-update__chart__circle {
        stroke: hsl( 30, 100%, 52% );
    }

    .demo-update__limit-exceeded .ck.ck-editor__editable_inline {
        background: hsl( 0, 100%, 97% );
    }

    .demo-update__limit-exceeded .demo-update__chart__circle {
        stroke: hsl( 0, 100%, 52% );
    }

    .demo-update__limit-exceeded .demo-update__chart__characters {
        fill: hsl( 0, 100%, 52% );
    }
</style>
@endsection
