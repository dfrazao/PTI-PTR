{{--
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

</div>--}}

<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="{{ ($message->sender == Auth::id()) ? 'sent' : 'received' }}">
                    <p>{{ $message->message }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->Date)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit">
</div>


