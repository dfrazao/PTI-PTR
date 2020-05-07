@extends('layouts.app')
@section('content')

   {{-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <div id="chatbox">
        <div id="friendslist">
            <div id="cabecalho">
            <div id="topmenu">
                <span class="friends"></span>
                <span class="chats"></span>
                <span class="history"></span>
            </div>
            <div id="search">
                <input type="text" id="searchfield" value="Search contacts..." />
            </div>
            </div>
            <div id="friends">
                @foreach($users as $user)
                <div class="friend">
                    <div class="row" >
                        <div class="col-sm-3"><img src="{{Storage::url('profilePhotos/'.$user->photo)}}" /></div>
                        <div class="col-sm-9" >
                            <strong>{{$user->name}}</strong>
                            <p>{{$user->email}}</p></div>
                    </div>

                    <div class="status available"></div>
                </div>
                @endforeach




            </div>
        </div>

        <div id="chatview" class="p1">
            <div id="profile">

                <div id="close">
                    <div class="cy"></div>
                    <div class="cx"></div>
                </div>
                <p>Miro Badev</p>
            </div>

    </div>
--}}

   <div class="container-fluid">
       <div class="row">
           <div class="col-md-4">
               <div class="user-wrapper">
                   <ul class="users">
                       @foreach($users as $user)
                           <li class="user" id="{{ $user->id }}">
                               {{--will show unread count notification--}}


                               <div class="media">
                                   <div class="media-left">
                                       <img src="{{Storage::url('profilePhotos/'.$user->photo)}}" alt="" class="media-object">
                                   </div>

                                   <div class="media-body">
                                       <p class="name">{{ $user->name }}</p>
                                       <p class="email">{{ $user->email }}</p>
                                   </div>
                               </div>
                           </li>
                       @endforeach
                   </ul>
               </div>
           </div>

           <div class="col-md-8" id="messages">

           </div>
       </div>
   </div>
@endsection

