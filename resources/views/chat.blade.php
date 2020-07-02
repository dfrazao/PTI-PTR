<div class="container-md" id="este" style="position: fixed">
   <div class="row" id="esteheader">
       <div class="col p-0">
           <div id="draggable-title" class="rounded-left">
               Chat
               <button type="button" onclick="chat()" class="close" aria-label="Close" style="position: absolute; top: 8px; right: 10px;">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
       </div>
   </div>

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
                            <a class="nav-link active" id="tabusers" data-toggle="tab" href="#users"><i class="far fa-user" ></i> </a>
                        </li>
                        @if(Auth::check() == true)
                        @if(Auth::user()->role != "professor")

                        <li class="nav-item">
                            <a class="nav-link" id="tabgroups" data-toggle="tab" href="#groups" > <i class="far fa-users"></i></a>
                        </li>
                            @endif
                        @endif

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="users" class=" tab-pane active">
                            <ul class="users">
                                @foreach( $users as $ele)
                                    @if($ele['isread'] == 0 && $ele['sender'] !=  Auth::user()->id)
                                        <li class='user' id='{{ $ele['sender'] }}' name=''>
                                            <span class='pending'></span>
                                            <input type='hidden' id="name{{ $ele['sender'] }}" name='custId' value='{{ $ele['name'] }}'>
                                            <input type='hidden' id="entity" name='entity' value='person'>

                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="{{Storage::url('profilePhotos/'.$ele['photo'])}}" alt="" class="media-object">
                                                </div>
                                                <div class="media-body">
                                                    <p class="name" style="font-size: 12px;">{{ $ele['name'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($ele['isread'] == 0 && $ele['sender'] ==  Auth::user()->role)
                                        <li class='user' id='{{ $ele['sender'] }}' name=''>
                                            <input type='hidden' id="name{{ $ele['sender'] }}" name='custId' value='{{ $ele['name'] }}'>
                                            <input type='hidden' id="entity" name='entity' value='person'>
                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="{{Storage::url('profilePhotos/'.$ele['photo'])}}" alt="" class="media-object">
                                                </div>
                                                <div class="media-body">
                                                    <p class="name" style="font-size: 12px;">{{ $ele['name'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @elseif($ele['isread'] == 1 )
                                        <li class='user' id='{{ $ele['sender'] }}' name=''>

                                            <input type='hidden' id="name{{ $ele['sender'] }}" name='custId' value='{{ $ele['name'] }}'>
                                            <input type='hidden' id="entity" name='entity' value='person'>
                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="{{Storage::url('profilePhotos/'.$ele['photo'])}}" alt="" class="media-object">
                                                </div>
                                                <div class="media-body">
                                                    <p class="name" style="font-size: 12px;">{{ $ele['name'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div id="groups" class="tab-pane fade"><br>
                            <ul class="groups">
                                @foreach ($collection as $col )
                                    @if($col['idGroup'] == 'n')
                                        <li >
                                            <div class="media">
                                                <div class="media-body">
                                                    <div style="padding: 10px; text-align: center; ">
                                                    <p><i class="fal fa-exclamation"></i> Atenção</p>
                                                    <p>Sem conversas de grupo iniciadas</p>
                                                    <p>Pesquise os seus grupos</p>
                                                    <p>Ex: Por cadeira / projeto / grupo</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                    <li class='group' id='group{{ $col['idGroup'] }}' name=''>
                                        <input type='hidden' id="namegroup{{ $col['idGroup'] }}" name='custId' value='{{ $col['projectName'] }}'>
                                        <input type='hidden' id="entity" name='entity' value='group'>
                                        <div class="media">
                                            <div class="media-body">
                                                <p>{{ $col['cadeira'] }} </p>
                                                <p><i>{{ $col['projectName'] }}</i></p>
                                                <p class="name">Group {{ $col['idGroupProject'] }}</p>
                                                <p class="email"></p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 nopadding">

            <div id="name">
                <p>Chat</p>
            </div>

            <div id="messages">
            </div>

            <div class="input-text mb-0" style="display: none; margin: 10px; text-align: start">
                <div class="input-group" style="padding-bottom: 10px">
                    <input type="text" name="message" autocomplete="off" maxlength="500" class="form-control rounded-left" id="message" data-emoji-input="unicode" data-emojiable="true">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary send_btn"><i class="fas fa-location-arrow"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<script>
    dragElement(document.getElementById("este"));

    function dragElement(elmnt) {
        if (sessionStorage.getItem('chat-pos') === null) {
            elmnt.style.left = (10) + "px";
            elmnt.style.top = (85) + "px";
        } else {
            elmnt.style.left = (sessionStorage.getItem('chat-pos').split(';')[0]) + "px";
            elmnt.style.top = (sessionStorage.getItem('chat-pos').split(';')[1]) + "px";
        }
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            // stop moving when mouse button is released:
            document.onmouseup = null;
            document.onmousemove = null;
            sessionStorage.setItem('chat-pos', $("#este").position().left+';'+$("#este").position().top)
        }
    }
</script>--}}
<style>
    #este {
        position: fixed;
        right: 10%;
        top: 10%;
        z-index: 9;
        background-color: #f1f1f1;
        border: 1px solid #d3d3d3;
        text-align: center;
    }
    #esteheader {
        z-index: 10;
    }
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
        height: 500px;
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
    .group {
        border-bottom: 1px solid #e7ebee;
        cursor: pointer;
        padding: 5px 0;
        position: relative;
        width: 100%;
    }
    .group:hover {
        background: #eeeeee;
    }
    .group:last-child {
        margin-bottom: 0;
    }
    .pending {
        position: absolute;
        left: 10px;
        top: 7px;
        background: #ff505f;
        margin: 0;
        border-radius: 50%;
        width: 12px;
        height: 12px;
        line-height: 18px;
        padding-left: 5px;
        color: #ffffff;
        font-size: 12px;
    }
    .pending_nav {
        position: absolute;
        left: 20px;
        top: 7px;
        background: #ff505f;
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
        margin-left:10px;
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
        float: left;
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
        padding: 10px 29px;
        background: rgb(255,255,255);
        background: linear-gradient(90deg, rgb(232,240,248) 0%, rgb(202, 223, 246) 66%, rgba(56,152,255,0.30015756302521013) 100%);
    }
    #draggable-title {
        padding: 10px 0px;
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
    #este{
        width: 450px;
        position: absolute;
        z-index: 4;
        background:white;
        border-radius: 6px;
        border: 1px rgba(0, 123, 255, 0.78) solid;
        display: none;

    }
    @media screen and (max-width: 500px) {
        #este {
            position: fixed;
            width: 90%;
            right: 5%;
        }

        .user-wrapper {
            height: 150px;
            border-right: 1px solid #dddddd;
        }

        .message-wrapper {
            height: 150px;
        }
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
    @media screen and (max-width: 800px) {
        #este {
            position: fixed;
            width: 70%;
            right: 15%;
        }

        .user-wrapper {
            height: 300px;
            border-right: 1px solid #dddddd;
        }

        .message-wrapper {
            height: 300px;
        }
    }
</style>

<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script type="text/javascript">



    $( ".nav-link" ).click(function() {
        $('#name').hide();
        $('#messages').hide();
        $('.input-text').hide();
        $('#searchinput').val(null);
        {{--$.ajax({--}}
        {{--type : 'get',--}}
        {{--url : '{{URL::to('search')}}',--}}
        {{--data:{'search':$value,'entity':entity},--}}
        {{--success:function(data){--}}
        {{--$('.groups').html(data);--}}
        {{--}--}}
        {{--});--}}
    });
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    var receiver_id = '';
    var entity = '';
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
                data:{'search':$value,'entity':data.entity},

                success:function(oi){
                    if(entity == "person"){
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
                    }else{
                        $('.groups').html(oi);
                        if (my_id == data.from) {
                            $('#group' + data.group_id).click();
                        } else{
                            if (receiver_id == data.group_id) {
                                $('#group' + data.group_id).click();
                            } else {
                                $('#chat_button').append('<span class="pending_nav"></span>');
                            }
                        }
                    }
                }
            });
        });
        var mes = $("#message").emojioneArea({
            searchPlaceholder: "",
            events: {
                keyup: function (editor, event) {
                    if(event.which == 13){
                        event.preventDefault();
                        var message = $('#message').data("emojioneArea").getText();
                        if (message != '' && entity != '') {
                            $('#message').data("emojioneArea").setText("");
                            var datastr = "receiver_id=" + receiver_id + "&message=" + message + "&entity=" + entity ;
                            $.ajax({
                                type: "post",
                                url: "message",
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
                                    if(entity == "person"){
                                        $.ajax({
                                            type : 'get',
                                            url : '{{URL::to('search')}}',
                                            data:{'search':$value,'entity':entity},
                                            success:function(oi){
                                                $('.users').html(oi);
                                            }
                                        });
                                    }else if(entity == "group"){
                                        $.ajax({
                                            type : 'get',
                                            url : '{{URL::to('search')}}',
                                            data:{'search':$value,'entity':entity},
                                            success:function(oi){
                                                $('.groups').html(oi);
                                            }
                                        });
                                    }
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
            $('#name').show();
            $('#messages').show();
            receiver_id = $(this).attr('id');
            var n = receiver_id.toString();
            receiver_name = $('#'+'name'+n).val();
            entity = $(this).find('#entity').val();
            $("#name").text(receiver_name);
            $.ajax({
                type: "get",
                url: "/message/" + entity + "/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
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
    $("body").on( "click", '.group', function( event ){
        $('.group').removeClass('chat-active');
        $(this).addClass('chat-active');
        $(this).find('.pending').remove();
        receiver_id = $(this).attr('id');
        $('#name').show();
        $('#messages').show();
        var n = receiver_id.toString();
        group_name = $('#name'+n).val();
        entity = $(this).find('#entity').val();
        $("#name").text(group_name);
        receiver_id = receiver_id.split('group').join('');
        $.ajax({
            type: "get",
            url: "/message/" + entity + "/" + receiver_id, // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                $('#messages').html(data);
                scrollToBottomFunc();
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
    $(document).on('click', '.send_btn', function () {
        var message = $('.input-text input').val();
        if (message != '' && entity != '') {
            $('#message').data("emojioneArea").setText("");
            var datastr = "receiver_id=" + receiver_id + "&message=" + message + "&entity=" + entity ;
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
                        data:{'search':$value,'entity':entity},
                        complete:function(data){
                            scrollToBottomFunc();
                            $('#searchinput').val(null);
                            $value=$('#searchinput').val();
                            if(entity == "person"){
                                $.ajax({
                                    type : 'get',
                                    url : '{{URL::to('search')}}',
                                    data:{'search':$value,'entity':entity},
                                    success:function(oi){
                                        $('.users').html(oi);
                                    }
                                });
                            }else if(entity == "group"){
                                $.ajax({
                                    type : 'get',
                                    url : '{{URL::to('search')}}',
                                    data:{'search':$value,'entity':entity},
                                    success:function(oi){
                                        $('.groups').html(oi);
                                    }
                                });
                            }
                        }
                    });
                    var mes = $("#message").emojioneArea({
                        searchPlaceholder: "",
                        pickerPosition: "bottom",
                        filtersPosition: "bottom",
                        events: {
                            keyup: function (editor, event) {
                                if(event.which == 13){
                                    event.preventDefault();
                                    var message = $('#message').data("emojioneArea").getText();
                                    if (message != '' && entity != '') {
                                        $('#message').data("emojioneArea").setText("");
                                        var datastr = "receiver_id=" + receiver_id + "&message=" + message + "&entity=" + entity ;
                                        $.ajax({
                                            type: "post",
                                            url: "message",
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
                                                if(entity == "person"){
                                                    $.ajax({
                                                        type : 'get',
                                                        url : '{{URL::to('search')}}',
                                                        data:{'search':$value,'entity':entity},
                                                        success:function(oi){
                                                            $('.users').html(oi);
                                                        }
                                                    });
                                                }else if(entity == "group"){
                                                    $.ajax({
                                                        type : 'get',
                                                        url : '{{URL::to('search')}}',
                                                        data:{'search':$value,'entity':entity},
                                                        success:function(oi){
                                                            $('.groups').html(oi);
                                                        }
                                                    });
                                                }
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
        const tabusers = document.querySelector("#tabusers");
        tem = tabusers.classList.contains("active");
        if(tem == true){
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value,'entity':"person"},
                success:function(data){
                    $('.users').html(data);

                }
            });
        }else{
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value,'entity':"group"},
                success:function(data){
                    $('.groups').html(data);
                }
            });
        }
    })
</script>
