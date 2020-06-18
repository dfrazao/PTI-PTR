
   <div class="container-md" id="testee" style="
            width: 450px;
            position: fixed;
            z-index: 4;
            right: 1em;
            margin-top: -0.5em;
            background:white;
            border-radius: 6px;
            border: 1px rgba(0, 123, 255, 0.78) solid;
            display: none;
            -webkit-box-shadow: 10px 10px 6px -2px rgba(211,216,222,1);
            -moz-box-shadow: 10px 10px 6px -2px rgba(211,216,222,1);
            box-shadow: 10px 10px 6px -2px rgba(211,216,222,1);
            ">
       <div class="row">
           <div id="col-md-4" class="col-md-4 nopadding">
               <div class="user-wrapper">


                   <div id="search" style="margin: 10px;">
                       <div class="input-group input-group-sm" >
                           <input class="form-control py-1" type="text" placeholder="Search" id="searchinput" name="searchinput">
                           <span class="input-group-append">
                                <button class="btn btn-outline-primary btn-sm" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                       </div>
                       {{--<input type="text" placeholder="Search" class="form-control" id="searchinput" name="searchinput" style="font-size:12px; ">--}}
                   </div>
                   <div class="    ">
                       <!-- Nav tabs -->
                       <ul class="nav nav-tabs nav-justified">
                           <li class="nav-item">
                               <a class="nav-link active" data-toggle="tab" href="#users"><i class="far fa-user" ></i> </a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" data-toggle="tab" href="#groups"> <i class="far fa-users"></i></a>
                           </li>

                       </ul>

                       <!-- Tab panes -->
                       <div class="tab-content">
                           <div id="users" class=" tab-pane active"><br>
                               <ul class="users">
                                   @if(count($isread) != 0)
                                       @for($i = 0; $i < count($arr_users); $i++)
                                           @foreach( $isread as $ele)
                                               @if ($tem == 0 && $arr_users[$i]->id == $ele)
                                                   <li class='user' id='{{ $arr_users[$i]->id }}' name=''>
                                                       <span class='pending'></span>
                                                       <input type='hidden' id="name{{ $arr_users[$i]->id }}" name='custId' value='{{ $arr_users[$i]->name }}'>
                                                       <div class="media">
                                                           <div class="media-left">
                                                               <img src="{{Storage::url('profilePhotos/'.$arr_users[$i]->photo)}}" alt="" class="media-object">
                                                           </div>
                                                           <div class="media-body">
                                                               <p class="name" style="font-size: 12px;">{{ $arr_users[$i]->name }}</p>
                                                           </div>
                                                       </div>
                                                   </li>
                                               @else
                                                   <li class='user' id='{{ $arr_users[$i]->id }}' name=''>
                                                       <input type='hidden' id="name{{ $arr_users[$i]->id }}" name='custId' value='{{ $arr_users[$i]->name }}'>
                                                       <div class="media">
                                                           <div class="media-left">
                                                               <img src="{{Storage::url('profilePhotos/'.$arr_users[$i]->photo)}}" alt="" class="media-object">
                                                           </div>
                                                           <div class="media-body">
                                                               <p class="name" style="font-size: 12px;">{{ $arr_users[$i]->name }}</p>
                                                           </div>
                                                       </div>
                                                   </li>
                                               @endif
                                           @endforeach
                                       @endfor
                                   @else
                                       @for($i = 0; $i < count($arr_users); $i++)
                                           <li class='user' id='{{ $arr_users[$i]->id }}' name=''>
                                               <input type='hidden' id="name{{ $arr_users[$i]->id }}" name='custId' value='{{ $arr_users[$i]->name }}'>
                                               <div class="media">
                                                   <div class="media-left">
                                                       <img src="{{Storage::url('profilePhotos/'.$arr_users[$i]->photo)}}" alt="" class="media-object">
                                                   </div>
                                                   <div class="media-body">
                                                       <p class="name" style="font-size: 12px;">{{ $arr_users[$i]->name }}</p>
                                                   </div>
                                               </div>
                                           </li>
                                       @endfor
                                   @endif
                               </ul>
                           </div>
                           <div id="groups" class="tab-pane fade"><br>
                               <ul class="groups">
                                   @foreach ($arr_groups as $group )
                                       <li class='user' id='{{ $group }}' name=''>
                                           <input type='hidden' id="name" name='custId' value='{{ $group }}'>

                                           <div class="media">
                                               <div class="media-left">
                                                   {{--<img src="{{Storage::url('profilePhotos/'.$arr_users[$i]->photo)}}" alt="" class="media-object">--}}
                                               </div>

                                               <div class="media-body">
                                                   <p class="name" style="font-size: 12px;">{{ $group }}</p>
                                                   <p class="email"></p>
                                               </div>
                                           </div>
                                       </li>
                                   @endforeach
                               </ul>
                           </div>
                       </div>
                   </div>


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
                   <p>Chat</p>
               </div>
               <div id="messages">

               </div>

           <div class="input-text" style="display: none; margin: 10px;">
               <div class="input-group mb-3">
                   <input type="text"  name="message" autocomplete="off"   maxlength="500" class="form-control" id="message" data-emoji-input="unicode" data-emojiable="true">
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
           width: 10px;}
       ::-webkit-scrollbar-track {
           background: #f1f1f1;
           border-radius: 5px;
       }

       /* Handle */
       ::-webkit-scrollbar-thumb {
           background-color: #fff;
           border-radius: 5px;
           border: 1px solid rgba(0, 123, 255, 0.78);
       }

       /* Handle on hover */
       ::-webkit-scrollbar-thumb:hover {
           background: rgba(0, 123, 255, 0.78);

       }

       ul {
           margin: 0;
           padding: 0;
       }

       li {
           list-style: none;
       }

       .user-wrapper, .message-wrapper {
           overflow-y: auto;
       }

       .user-wrapper {
           height: 100%;
           border-right: 1px solid #dddddd;

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
           left: 20px;
           top: 7px;
           background: #b600ff;
           margin: 0;
           border-radius: 50%;
           width: 10px;
           height: 10px;
           line-height: 18px;
           padding-left: 5px;
           color: #ffffff;
           font-size: 12px;
       }
       .pending_nav {
           position: absolute;
           left: 20px;
           top: 7px;
           background: #b600ff;
           margin: 0;
           border-radius: 50%;
           width: 10px;
           height: 10px;
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
           height:40px;
           border-radius: 100%; object-fit: cover;
           border:2px solid #fff ;

       }
       .media-body p {
           margin: 6px 0;
           font-size: 12px;
       }
       .message-wrapper {
           padding: 10px;
           height: 400px;
           background: #ffffff;
       }
       .messages .message {
           margin-bottom: 15px;
           font-size: 14px;
       }
       .messages .message:last-child {
           margin-bottom: 0;
       }
       .received, .sent {
           max-width: 82.5%;
           overflow-wrap: break-word;
           padding: 3px 10px;
           border-radius: 10px;
       }
       .received {
           background: rgba(0, 123, 255, 0.78);
           color: #ffffff;
       }
       .sent {
           background: #eceff1;
           float: right;
           text-align: right;
       }
       .message p {
           margin: 5px 0;
       }
       .sent .date {
           color: black;
           opacity: 0.9;
           font-size: 10px;
       }
       .received .date {
           color: white;
           opacity: 0.9;
           font-size: 10px;
       }
       .chat-active {
           background: #3898ff26;
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
           background: rgb(255,255,255);
           background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(154,188,224,0.4542191876750701) 66%, rgba(56,152,255,0.30015756302521013) 100%);
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
           #col-md-4{
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
           Pusher.logToConsole = false;

           var pusher = new Pusher('ff4af21336ebee3e83fe', {
               cluster: 'eu',
               authEndpoint: '/pusher/auth',
               encrypted: true,
               forceTLS: true,
               auth: {
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               }

           });


           var channel = pusher.subscribe('private-my-channel');
           channel.bind('my-event', function (data) {
               $('#searchinput').val(null);
               $value=$('#searchinput').val();
               $.ajax({
                   type : 'get',
                   url : '{{URL::to('search')}}',
                   data:{'search':$value},
                   success:function(oi){
                       $('.users').html(oi);
                       if (my_id == data.from) {
                           $('#' + data.to).click();
                       } else if (my_id == data.to) {
                           if (receiver_id == data.from) {
                               // if receiver is selected, reload the selected user ...
                               $('#' + data.from).click();

                           } else {
                               $('#chat_button').append('<span class="pending_nav"></span>');


                           }
                       }
                   }
               });




           });


           var mes = $("#message").emojioneArea({
               searchPlaceholder: "",
               pickerPosition: "bottom",
               filtersPosition: "bottom",
               events: {
                   keyup: function (editor, event) {
                       if(event.which == 13){
                           event.preventDefault(); // < ---------- preventDefault
                           var message = $('#message').data("emojioneArea").getText();
                           // check if enter key is pressed and message is not null also receiver is selected
                           if (message != '' && receiver_id != '') {
                               $('#message').data("emojioneArea").setText(""); // this work
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
                                       $('#searchinput').val(null);
                                       $value=$('#searchinput').val();
                                       $.ajax({
                                           type : 'get',
                                           url : '{{URL::to('search')}}',
                                           data:{'search':$value},
                                           success:function(data){
                                               $('.users').html(data);
                                           }
                                       });
                                   }
                               })
                           }
                       }
                   },
               }
           });


           $("body").on( "click", '.user', function( event ){
               $('.user').removeClass('chat-active');
               $(this).addClass('chat-active');
               $(this).find('.pending').remove();
               receiver_id = $(this).attr('id');
               var n = receiver_id.toString();
               receiver_name = $('#'+'name'+n).val();
               $("#name").text(receiver_name);
               $.ajax({
                   type: "get",
                   url: "/message/" + receiver_id, // need to create this route
                   data: "",
                   cache: false,
                   success: function (data) {
                       $('#messages').html(data);
                       scrollToBottomFunc();

                       // Retrieve
                       var num = sessionStorage.getItem("not");
                       if (num > 0){
                           var novo = num -1;
                           sessionStorage.setItem("not", novo);
                       }else{
                           $('.pending_nav').remove();
                       }
                   }
               });
               $('.input-text').css("display", "block");
               $('.input-group-append').css("display", "block");


           });
       });


       $(document).on('click', '.send_btn', function () {
           var message = $('.input-text input').val();
           if (message != '' && receiver_id != '') {
               $('#message').data("emojioneArea").setText(""); // this work
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
                       $('#searchinput').val(null);
                       $value=$('#searchinput').val();
                       $.ajax({
                           type : 'get',
                           url : '{{URL::to('search')}}',
                           data:{'search':$value},
                           success:function(data){
                               $('.users').html(data);
                           }
                       });

                       var mes = $("#message").emojioneArea({
                           searchPlaceholder: "",
                           pickerPosition: "bottom",
                           filtersPosition: "bottom",
                           events: {
                               keyup: function (editor, event) {
                                   if(event.which == 13){
                                       event.preventDefault(); // < ---------- preventDefault
                                       var message = $('#message').data("emojioneArea").getText();
                                       // check if enter key is pressed and message is not null also receiver is selected
                                       if (message != '' && receiver_id != '') {
                                           $('#message').data("emojioneArea").setText(""); // this work
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
                                                   $('#searchinput').val("");
                                               }
                                           })
                                       }
                                   }
                               },

                           }
                       });
                   }
               })
           }
       });

       // make a function to scroll down auto
       function scrollToBottomFunc() {
           $('.message-wrapper').animate({
               scrollTop: $('.message-wrapper').get(0).scrollHeight
           }, 0);
       }

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

