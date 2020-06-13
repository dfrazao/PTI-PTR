
<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="{{ ($message->sender == Auth::id()) ? 'sent' : 'received' }}">
                    <p>{{ $message->message }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->Date)) }}</p>
                    <script>
                        sessionStorage.setItem("not", {{$notification_chat}});
                    </script>
                </div>
            </li>
        @endforeach
    </ul>
</div>




