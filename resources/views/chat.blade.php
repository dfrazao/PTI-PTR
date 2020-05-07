@extends('layouts.app')
@section('content')

{{--    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
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
    </div>--}}


   <!------ Include the above in your HEAD tag ---------->


   <!------ Include the above in your HEAD tag ---------->



       <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
       <style>

           #frame {
               display:none;
               width: 75%;
               min-width: 360px;
               max-width: 1000px;
               height: 72vh;
               min-height: 300px;
               max-height: 720px;
               background: #E6EAEA;
           }
           @media screen and (max-width: 360px) {
               #frame {
                   width: 100%;
                   height: 100vh;
               }
           }
           #frame #sidepanel {
               float: left;
               min-width: 280px;
               max-width: 340px;
               width: 40%;
               height: 100%;
               background: #2c3e50;
               color: #f5f5f5;
               overflow: hidden;
               position: relative;
           }

           @media screen and (max-width: 735px) {
               #frame #sidepanel {
                   width: 58px;
                   min-width: 58px;
               }
           }

           #frame #sidepanel #search {
               padding-top : 3%;
               width: 100%; !important;
               background: #2c3e50; !important;
               border-top: 1px solid #32465a;
               border-bottom: 1px solid #32465a;
               font-weight: 300;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #search {
                   display: none;
               }
           }
           #frame #sidepanel #search label {
               position: absolute;
               margin: 10px 0 0 20px;
           }
           #frame #sidepanel #search input {
               font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
               padding: 10px 0 10px 46px;
               width: 100%;
                   border: none;
                   background: #32465a;
               color: #f5f5f5;
           }
           #frame #sidepanel #search input:focus {
               outline: none;
               background: #435f7a;
           }
           #frame #sidepanel #search input::-webkit-input-placeholder {
               color: #f5f5f5;
           }
           #frame #sidepanel #search input::-moz-placeholder {
               color: #f5f5f5;
           }
           #frame #sidepanel #search input:-ms-input-placeholder {
               color: #f5f5f5;
           }
           #frame #sidepanel #search input:-moz-placeholder {
               color: #f5f5f5;
           }
           #frame #sidepanel #contacts {
               height: 100%;
               overflow-y: scroll;
               overflow-x: hidden;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #contacts {
                   height: calc(100% - 149px);
                   overflow-y: scroll;
                   overflow-x: hidden;
               }
               #frame #sidepanel #contacts::-webkit-scrollbar {
                   display: none;
               }
           }
           #frame #sidepanel #contacts.expanded {
               height: calc(100% - 334px);
           }
           #frame #sidepanel #contacts::-webkit-scrollbar {
               width: 8px;
               background: #2c3e50;
           }
           #frame #sidepanel #contacts::-webkit-scrollbar-thumb {
               background-color: #243140;
           }
           #frame #sidepanel #contacts ul li.contact {
               position: relative;
               padding: 10px 0 15px 0;
               font-size: 0.9em;
               cursor: pointer;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #contacts ul li.contact {
                   padding: 6px 0 46px 8px;
               }
           }
           #frame #sidepanel #contacts ul li.contact:hover {
               background: #32465a;
           }
           #frame #sidepanel #contacts ul li.contact.active {
               background: #32465a;
               border-right: 5px solid #435f7a;
           }
           #frame #sidepanel #contacts ul li.contact.active span.contact-status {
               border: 2px solid #32465a !important;
           }
           #frame #sidepanel #contacts ul li.contact .wrap {
               width: 88%;
               margin: 0 auto;
               position: relative;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #contacts ul li.contact .wrap {
                   width: 100%;
               }
           }
           #frame #sidepanel #contacts ul li.contact .wrap span {
               position: absolute;
               left: 0;
               margin: -2px 0 0 -2px;
               width: 10px;
               height: 10px;
               border-radius: 50%;
               border: 2px solid #2c3e50;
               background: #95a5a6;
           }
           #frame #sidepanel #contacts ul li.contact .wrap span.online {
               background: #2ecc71;
           }
           #frame #sidepanel #contacts ul li.contact .wrap span.away {
               background: #f1c40f;
           }
           #frame #sidepanel #contacts ul li.contact .wrap span.busy {
               background: #e74c3c;
           }
           #frame #sidepanel #contacts ul li.contact .wrap img {
               width: 40px;
               border-radius: 50%;
               float: left;
               margin-right: 10px;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #contacts ul li.contact .wrap img {
                   margin-right: 0px;
               }
           }
           #frame #sidepanel #contacts ul li.contact .wrap .meta {
               padding: 5px 0 0 0;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #contacts ul li.contact .wrap .meta {
                   display: none;
               }
           }
           #frame #sidepanel #contacts ul li.contact .wrap .meta .name {
               font-weight: 600;
           }
           #frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
               margin: 5px 0 0 0;
               padding: 0 0 1px;
               font-weight: 400;
               white-space: nowrap;
               overflow: hidden;
               text-overflow: ellipsis;
               -moz-transition: 1s all ease;
               -o-transition: 1s all ease;
               -webkit-transition: 1s all ease;
               transition: 1s all ease;
           }
           #frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
               position: initial;
               border-radius: initial;
               background: none;
               border: none;
               padding: 0 2px 0 0;
               margin: 0 0 0 1px;
               opacity: .5;
           }
           #frame #sidepanel #bottom-bar {
               position: absolute;
               width: 100%;
               bottom: 0;
           }
           #frame #sidepanel #bottom-bar button {
               float: left;
               border: none;
               width: 50%;
               padding: 10px 0;
               background: #32465a;
               color: #f5f5f5;
               cursor: pointer;
               font-size: 0.85em;
               font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #bottom-bar button {
                   float: none;
                   width: 100%;
                   padding: 15px 0;
               }
           }
           #frame #sidepanel #bottom-bar button:focus {
               outline: none;
           }
           #frame #sidepanel #bottom-bar button:nth-child(1) {
               border-right: 1px solid #2c3e50;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #bottom-bar button:nth-child(1) {
                   border-right: none;
                   border-bottom: 1px solid #2c3e50;
               }
           }
           #frame #sidepanel #bottom-bar button:hover {
               background: #435f7a;
           }
           #frame #sidepanel #bottom-bar button i {
               margin-right: 3px;
               font-size: 1em;
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #bottom-bar button i {
                   font-size: 1.3em;
               }
           }
           @media screen and (max-width: 735px) {
               #frame #sidepanel #bottom-bar button span {
                   display: none;
               }
           }
           #frame .content {
               float: right;
               width: 60%;
               height: 100%;
               overflow: hidden;
               position: relative;
           }
           @media screen and (max-width: 735px) {
               #frame .content {
                   width: calc(100% - 58px);
                   min-width: 300px !important;
               }
           }
           @media screen and (min-width: 900px) {
               #frame .content {
                   width: calc(100% - 340px);
               }
           }
           #frame .content .contact-profile {
               width: 100%;
               height: 60px;
               line-height: 60px;
               background: #f5f5f5;
           }
           #frame .content .contact-profile img {
               width: 40px;
               border-radius: 50%;
               float: left;
               margin: 9px 12px 0 9px;
           }
           #frame .content .contact-profile p {
               float: left;
           }
           #frame .content .contact-profile .social-media {
               float: right;
           }
           #frame .content .contact-profile .social-media i {
               margin-left: 14px;
               cursor: pointer;
           }
           #frame .content .contact-profile .social-media i:nth-last-child(1) {
               margin-right: 20px;
           }
           #frame .content .contact-profile .social-media i:hover {
               color: #435f7a;
           }
           #frame .content .messages {
               height: auto;
               min-height: calc(100% - 93px);
               max-height: calc(100% - 93px);
               overflow-y: scroll;
               overflow-x: hidden;
           }
           @media screen and (max-width: 735px) {
               #frame .content .messages {
                   max-height: calc(100% - 105px);
               }
           }
           #frame .content .messages::-webkit-scrollbar {
               width: 8px;
               background: transparent;
           }
           #frame .content .messages::-webkit-scrollbar-thumb {
               background-color: rgba(0, 0, 0, 0.3);
           }
           #frame .content .messages ul li {
               display: inline-block;
               clear: both;
               float: left;
               margin: 15px 15px 5px 15px;
               width: calc(100% - 25px);
               font-size: 0.9em;
           }
           #frame .content .messages ul li:nth-last-child(1) {
               margin-bottom: 20px;
           }
           #frame .content .messages ul li.sent img {
               margin: 6px 8px 0 0;
           }
           #frame .content .messages ul li.sent p {
               background: #435f7a;
               color: #f5f5f5;
           }
           #frame .content .messages ul li.replies img {
               float: right;
               margin: 6px 0 0 8px;
           }
           #frame .content .messages ul li.replies p {
               background: #f5f5f5;
               float: right;
           }
           #frame .content .messages ul li img {
               width: 22px;
               border-radius: 50%;
               float: left;
           }
           #frame .content .messages ul li p {
               display: inline-block;
               padding: 10px 15px;
               border-radius: 20px;
               max-width: 205px;
               line-height: 130%;
           }
           @media screen and (min-width: 735px) {
               #frame .content .messages ul li p {
                   max-width: 300px;
               }
           }
           #frame .content .message-input {
               position: absolute;
               bottom: 0;
               width: 100%;
               z-index: 99;
           }
           #frame .content .message-input .wrap {
               position: relative;
           }
           #frame .content .message-input .wrap input {
               font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
               float: left;
               border: none;
               width: calc(100% - 90px);
               padding: 11px 32px 10px 8px;
               font-size: 0.8em;
               color: #32465a;
           }
           @media screen and (max-width: 735px) {
               #frame .content .message-input .wrap input {
                   padding: 15px 32px 16px 8px;
               }
           }
           #frame .content .message-input .wrap input:focus {
               outline: none;
           }
           #frame .content .message-input .wrap .attachment {
               position: absolute;
               right: 60px;
               z-index: 4;
               margin-top: 10px;
               font-size: 1.1em;
               color: #435f7a;
               opacity: .5;
               cursor: pointer;
           }
           @media screen and (max-width: 735px) {
               #frame .content .message-input .wrap .attachment {
                   margin-top: 17px;
                   right: 65px;
               }
           }
           #frame .content .message-input .wrap .attachment:hover {
               opacity: 1;
           }
           #frame .content .message-input .wrap button {
               float: right;
               border: none;
               width: 50px;
               padding: 12px 0;
               cursor: pointer;
               background: #32465a;
               color: #f5f5f5;
           }
           @media screen and (max-width: 735px) {
               #frame .content .message-input .wrap button {
                   padding: 16px 0;
               }
           }
           #frame .content .message-input .wrap button:hover {
               background: #435f7a;
           }
           #frame .content .message-input .wrap button:focus {
               outline: none;
           }
       </style>
   <!--

   A concept for a chat interface.

   Try writing a new message! :)


   Follow me here:
   Twitter: https://twitter.com/thatguyemil
   Codepen: https://codepen.io/emilcarlsson/
   Website: http://emilcarlsson.se/

   -->

   <div id="frame">
       <div id="sidepanel">
           <div id="search">
               <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
               <input type="text" placeholder="Search contacts..." />
           </div>
           <div id="contacts">
               <ul>
                   @foreach($users as $user)
                       <li class="contact">
                           <div class="wrap">
                               <span class="contact-status online"></span>
                               <img src="{{Storage::url('profilePhotos/'.$user->photo)}}" />
                               <div class="meta">
                                   <p class="name">{{$user->name}}</p>
                                   <p class="preview">{{$user->email}}.</p>
                               </div>
                           </div>
                       </li>
                   @endforeach
               </ul>
           </div>
       </div>
       <div class="content">
           <div class="contact-profile">
               <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
               <p>Harvey Specter</p>
           </div>
           <div class="messages">
               <ul>
                   <li class="sent">
                       <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                       <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
                   </li>
                   <li class="replies">
                       <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                       <p>When you're backed against the wall, break the god damn thing down.</p>
                   </li>
                   <li class="replies">
                       <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                       <p>Excuses don't win championships.</p>
                   </li>
                   <li class="sent">
                       <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                       <p>Oh yeah, did Michael Jordan tell you that?</p>
                   </li>
                   <li class="replies">
                       <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                       <p>No, I told him that.</p>
                   </li>
                   <li class="replies">
                       <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                       <p>What are your choices when someone puts a gun to your head?</p>
                   </li>
                   <li class="sent">
                       <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                       <p>What are you talking about? You do what they say or they shoot you.</p>
                   </li>
                   <li class="replies">
                       <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                       <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                   </li>
               </ul>
           </div>
           <div class="message-input">
               <div class="wrap">
                   <input type="text" placeholder="Write your message..." />
                   <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                   <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
               </div>
           </div>
       </div>
   </div>
   <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
   <script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");

       $("#profile-img").click(function() {
           $("#status-options").toggleClass("active");
       });

       $(".expand-button").click(function() {
           $("#profile").toggleClass("expanded");
           $("#contacts").toggleClass("expanded");
       });

       $("#status-options ul li").click(function() {
           $("#profile-img").removeClass();
           $("#status-online").removeClass("active");
           $("#status-away").removeClass("active");
           $("#status-busy").removeClass("active");
           $("#status-offline").removeClass("active");
           $(this).addClass("active");

           if($("#status-online").hasClass("active")) {
               $("#profile-img").addClass("online");
           } else if ($("#status-away").hasClass("active")) {
               $("#profile-img").addClass("away");
           } else if ($("#status-busy").hasClass("active")) {
               $("#profile-img").addClass("busy");
           } else if ($("#status-offline").hasClass("active")) {
               $("#profile-img").addClass("offline");
           } else {
               $("#profile-img").removeClass();
           };

           $("#status-options").removeClass("active");
       });

       function newMessage() {
           message = $(".message-input input").val();
           if($.trim(message) == '') {
               return false;
           }
           $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
           $('.message-input input').val(null);
           $('.contact.active .preview').html('<span>You: </span>' + message);
           $(".messages").animate({ scrollTop: $(document).height() }, "fast");
       };

       $('.submit').click(function() {
           newMessage();
       });

       $(window).on('keydown', function(e) {
           if (e.which == 13) {
               newMessage();
               return false;
           }
       });
       //# sourceURL=pen.js
   </script>

@endsection



