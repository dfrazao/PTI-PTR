<?php

namespace App\Http\Controllers;
use App\Chat;
use App\groupChat;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Pusher\PusherException;

class ChatController extends Controller
{

    public function index()
    {
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();
        $my_id = Auth::id();
        // count how many message are unread from the selected user
        /*$users = DB::select("select users.id, users.name, users.photo, users.email
        from users LEFT  JOIN  chats ON users.id = chats.sender and chats.receiver = " . Auth::id() . "
        where users.id != " . $my_id . "
        group by users.id, users.name, users.photo, users.email");*/


        $mu = DB::table('chats')
            ->where('sender', '=', $my_id)
            ->orWhere('receiver', '=', $my_id)
            ->orderBy('Date', 'desc')
            ->pluck('receiver');
        $unique = [];
        foreach ($mu as $m){
            array_push($unique, $m);
        }
        $mu = array_unique($unique);
        $arr_users = [];
        foreach ($mu as $m){
            $user_m = User::find($m);
            array_push($arr_users, $user_m);
        }

        $groupChat = groupChat::all();

        return view('chat')->with('arr_users', $arr_users)->with('groupChat', $groupChat);
    }

    public function getMessage($user_id)
    {

        $my_id = Auth::id();

        // Make read all unread message
        DB::table('chats')
            ->where('sender', '=', $user_id)
            ->where('receiver', '=', $my_id)
            ->update(['isread' => 1]);

        // Get all message from selected user


        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('sender', $user_id)->where('receiver', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('sender', $my_id)->where('receiver', $user_id);
        })->get();

        return view('messages.conv', ['messages' => $messages]);
    }

    public function getChatMessage($user_id)
    {

        $my_id = Auth::id();

        // Make read all unread message
        //Chat::where(['sender' => $user_id, 'receiver' => $my_id])->update(['isread' => 1]);

        // Get all message from selected user


        $messages = groupChat::all()->where('sender', "=",$my_id);

        return view('messages.groupChat', ['messages' => $messages]);
    }

    public function authorizeUser(Request $request){
        if(!Auth::check()){
            return new Response('Forbidden', 403);
        }

        // pusher
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
    }

    public function sendMessage(Request $request)
    {
        if(!Auth::check()){
            return new Response('Forbidden', 403);
        }

        $from = Auth::id();
        $to = $request->receiver_id;
        $user_notification =  DB::table('users')
                    ->where('id', '=', $from)
                    ->value('name');

        $message = $request->message;


        // pusher
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to, 'username' => $user_notification, 'message' => $message]; // sending from and to user id when pressed enter

        $pusher->trigger('private-my-channel', 'my-event', $data);


        $data = new Chat();
        $data->sender = $from;
        $data->receiver = $to;
        $data->message = $message;
        $data->isread = 0; // message will be unread when sending message
        $data->save();
    }
}
