<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="{{ ($message->sender == Auth::id()) ? 'sent' : 'received' }}">
                    <?php
                    $usernot = \App\User::find($message->sender);
                    ?>
                    <p style="font-size: 10px;">{{ $usernot->name }}</p>
                    <p>{{ $message->message }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->Date)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>
