@extends('layouts.app')

@section('content')

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
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
            <div id="chat-messages">
                <label>Thursday 02</label>

                <div class="message">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />
                    <div class="bubble">
                        Really cool stuff!
                        <div class="corner"></div>
                        <span>3 min</span>
                    </div>
                </div>

                <div class="message right">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" />
                    <div class="bubble">
                        Can you share a link for the tutorial?
                        <div class="corner"></div>
                        <span>1 min</span>
                    </div>
                </div>

                <div class="message">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />
                    <div class="bubble">
                        Yeah, hold on
                        <div class="corner"></div>
                        <span>Now</span>
                    </div>
                </div>

                <div class="message right">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" />
                    <div class="bubble">
                        Can you share a link for the tutorial?
                        <div class="corner"></div>
                        <span>1 min</span>
                    </div>
                </div>

                <div class="message">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />
                    <div class="bubble">
                        Yeah, hold on
                        <div class="corner"></div>
                        <span>Now</span>
                    </div>
                </div>

            </div>

            <div id="sendmessage">
                <input type="text" value="Send message..." />
                <button id="send"></button>
            </div>

        </div>
    </div>



@endsection
