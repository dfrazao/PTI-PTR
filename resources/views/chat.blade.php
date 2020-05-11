@extends('layouts.app')
@section('content')

   <div class="container-md" id="testee" style="width: 500px;position: relative;
z-index: 1; margin-right: 15px;margin-top: 5px;
            background:white;
            border-radius:6px;
            border: 1px #a5b2cb solid;
            display: none;
            ">
       <div class="row">
           <div class="col-md-4 nopadding">
               <div class="user-wrapper">
                   <div id="search" style="margin: 10px;">
                       <input type="text" placeholder="Search" class="form-control" id="searchinput" name="searchinput" style="font-size:12px; ">
                   </div>
                   <ul class="users">
                       @foreach($users as $user)
                           <li class="user" id="{{ $user->id }}" name="{{ $user->name }}">
                               <div class="media">
                                   <div class="media-left">
                                       <img src="{{Storage::url('profilePhotos/'.$user->photo)}}" alt="" class="media-object">
                                   </div>

                                   <div class="media-body">
                                       <p class="name" style="font-size: 12px;">{{ $user->name }}</p>
                                       {{--<p class="email">{{ $user->email }}</p>--}}
                                   </div>
                               </div>
                           </li>
                       @endforeach
                   </ul>
               </div>
           </div>
           <script type="text/javascript">
               $('#searchinput').on('keyup',function(){
                   $value=$('#searchinput').val();
                   $.ajax({
                       type : 'get',
                       url : '{{URL::to('search')}}',
                       data:{'search':$value},
                       success:function(data){
                           $('.users').html(data);
                       }
                   });
               })
           </script>
           <script type="text/javascript">
               $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
           </script>
           <div class="col-md-8 nopadding">
               <div id="name">
                   <p></p>
               </div>
               <div id="messages">

               </div>

           <div class="input-text" style="display: none; margin: 10px;">
               <div class="input-group mb-3">
                   <input type="text" name="message" maxlength="500" class="form-control">

                   <div class="input-group-append">
                       <button class="btn btn-outline-primary send_btn"><i class="fas fa-location-arrow"></i></button>

                   </div>
               </div>

           </div>

           </div>
       </div>
   </div>

   <style>
       /* width */
       ::-webkit-scrollbar {
           width: 7px;
       }
       /* Track */
       ::-webkit-scrollbar-track {
           background: #f1f1f1;
       }
       /* Handle */
       ::-webkit-scrollbar-thumb {
           background: #a7a7a7;
       }
       /* Handle on hover */
       ::-webkit-scrollbar-thumb:hover {
           background: #929292;
       }
       ul {
           margin: 0;
           padding: 0;
       }
       li {
           list-style: none;
       }
       .user-wrapper, .message-wrapper {
           border: 1px solid #dddddd;
           overflow-y: auto;
       }
       .user-wrapper {
           height: 500px;
       }
       .user {
           border-bottom: 1px solid #e7ebee;
           cursor: pointer;
           padding: 5px 0;
           position: relative;
           width: 100%;
       }
       .user:hover {
           background: #eeeeee;
       }
       .user:last-child {
           margin-bottom: 0;
       }
       .pending {
           position: absolute;
           left: 13px;
           top: 9px;
           background: #b600ff;
           margin: 0;
           border-radius: 50%;
           width: 18px;
           height: 18px;
           line-height: 18px;
           padding-left: 5px;
           color: #ffffff;
           font-size: 12px;
       }
       .media-left {
           margin: 0 10px;
       }
       .media-left img {
           width:40px;
           border:3px solid #fff;
           border-radius:50%;
       }
       .media-body p {
           margin: 6px 0;
           font-size: 10px;
       }
       .message-wrapper {
           padding: 10px;
           height: 400px;
           background: #ffffff;
       }
       .messages .message {
           margin-bottom: 15px;
           font-size: 12px;
       }
       .messages .message:last-child {
           margin-bottom: 0;
       }
       .received, .sent {
           width: 45%;
           overflow-wrap: break-word;
           padding: 3px 10px;
           border-radius: 10px;
       }
       .received {
           background: rgba(136, 253, 79, 0.73);
       }
       .sent {
           background: #eceff1;
           float: right;
           text-align: right;
       }
       .message p {
           margin: 5px 0;
       }
       .date {
           color: black;
           opacity: 0.8;
           font-size: 10px;
       }
       .active {
           background: #eeeeee;
       }
       .col-sm-4 {
           padding: 0;
           overflow-x: hidden;
       }
       .col-sm-8 {
           padding: 0;
       }
       .nopadding {
           padding: 0 !important;
           margin: 0 !important;
       }
       #name{
           width: 100%;
           height: 47px;
           padding: 15px 29px;
           background-color: #eceff1;
       }

       .input_msg_write input {
           background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
           border: medium none;
           color: #4c4c4c;
           font-size: 15px;
           min-height: 48px;
           width: 100%;
       }

       .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
       .msg_send_btn {
           background: #05728f none repeat scroll 0 0;
           border: medium none;
           border-radius: 50%;
           color: #fff;
           cursor: pointer;
           font-size: 17px;
           height: 33px;
           position: absolute;
           right: 0;
           top: 11px;
           width: 33px;
       }

       #name p{
           font-size: 15px;
           text-align: center;
       }

       @media screen and (max-width: 800px) {
           .container-md{
           }
           .col-md-4{
               width: 100%; /* The width is 100%, when the viewport is 800px or smaller */
               overflow-x: hidden;
           }
           .message p {
               margin: 5px 0;
               font-size: 12px;
           }
           .media-body p {
               margin: 6px 0;
               font-size: 12px;
           }
           .col-sm-4 {
               height: 300px;
           }
           .col-sm-8 {
               height: 300px;
           }
       }
   </style>

   <script src="https://js.pusher.com/6.0/pusher.min.js"></script>

   <script>
       var receiver_id = '';
       var my_id = "{{ Auth::id() }}";
       $(document).ready(function () {
           // ajax setup form csrf token
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

           // Enable pusher logging - don't include this in production
           Pusher.logToConsole = true;

           var pusher = new Pusher('ff4af21336ebee3e83fe', {
               cluster: 'eu',
           });

           var channel = pusher.subscribe('my-channel');
           channel.bind('my-event', function (data) {
               if (my_id == data.from) {
                   $('#' + data.to).click();
               } else if (my_id == data.to) {
                   if (receiver_id == data.from) {
                       // if receiver is selected, reload the selected user ...
                       $('#' + data.from).click();
                   } else {
                       // if receiver is not seleted, add notification for that user
                       var pending = parseInt($('#' + data.from).find('.pending').html());

                       if (pending) {
                           $('#' + data.from).find('.pending').html(pending + 1);
                       } else {
                           $('#' + data.from).append('<span class="pending">1</span>');
                       }
                   }
               }
           });


           $(document).on('keyup', '.input-text input', function (e) {
               var message = $(this).val();
               // check if enter key is pressed and message is not null also receiver is selected
               if (e.keyCode == 13 && message != '' && receiver_id != '') {
                   $(this).val(''); // while pressed enter text box will be empty
                   var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                   $.ajax({
                       type: "post",
                       url: "message", // need to create this post route
                       data: datastr,
                       cache: false,
                       success: function (data) {

                       },
                       error: function (jqXHR, status, err) {
                       },
                       complete: function () {
                           scrollToBottomFunc();
                       }
                   })
                   $.ajax({
                       type: "get",
                       url: "message/" + receiver_id, // need to create this route
                       data: "",
                       cache: false,
                       success: function (data) {
                           $('#messages').html(data);
                           scrollToBottomFunc();
                       }
                   });
               }
           });

           $(document).on('click', '.send_btn', function () {
               var message = $('.input-text input').val();
               // check if enter key is pressed and message is not null also receiver is selected
               if (message != '' && receiver_id != '') {
                   $('.input-text input').val(''); // while pressed enter text box will be empty
                   var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                   $.ajax({
                       type: "post",
                       url: "message", // need to create this post route
                       data: datastr,
                       cache: false,
                       success: function (data) {

                       },
                       error: function (jqXHR, status, err) {
                       },
                       complete: function () {
                           scrollToBottomFunc();
                       }
                   })
                   $.ajax({
                       type: "get",
                       url: "message/" + receiver_id, // need to create this route
                       data: "",
                       cache: false,
                       success: function (data) {
                           $('#messages').html(data);
                           scrollToBottomFunc();
                       }
                   });
               }
           });
           // make a function to scroll down auto
           function scrollToBottomFunc() {
               $('.message-wrapper').animate({
                   scrollTop: $('.message-wrapper').get(0).scrollHeight
               }, 50);
           }

           $("body").on( "click", '.user', function( event ){
               $('.user').removeClass('active');
               $(this).addClass('active');


               $(this).find('.pending').remove();
               receiver_id = $(this).attr('id');
               receiver_name = $(this).attr('name');
               $("#name").html(receiver_name);
               $.ajax({
                   type: "get",
                   url: "message/" + receiver_id, // need to create this route
                   data: "",
                   cache: false,
                   success: function (data) {
                       $('#messages').html(data);
                       scrollToBottomFunc();
                   }
               });
               $('.input-text').css("display", "block");
               $('.input-group-append').css("display", "block");
           });
       });




   </script>

@endsection

