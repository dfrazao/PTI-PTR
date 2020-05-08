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

   <div class="container-md" style="width: 500px;z-index: 9999;
            position: relative;
            background:white;
            border-radius:6px;
            border: black 1px solid;">
       <div class="row" >
           <div class="col-md-4 nopadding">
               <div class="user-wrapper">
                   <div id="search">
                       <input type="text" class="form-control" id="searchinput" name="searchinput">
                   </div>




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
               <div id="messages">
               </div>

           <div class="input-text" style="display: none;">
               <input type="text" name="message" class="form-control submit">
           </div>

           </div>
       </div>
   </div>
@endsection

