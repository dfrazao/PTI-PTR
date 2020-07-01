<?php

namespace App\Http\Controllers;
use App\Chat;
use App\groupChat;
use App\StudentsGroup;
use App\User;
use Carbon\Traits\Date;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Pusher\PusherException;
use Carbon\Carbon;

class ChatController extends Controller
{

    public function index()
    {

        $my_id = Auth::id();

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

    public function getMessage($entity, $user_id)
    {
        dd($entity);
        if($entity === "group"){

            $my_id = Auth::id();

            $gg = groupChat::all()->where('idGroup','=',$user_id)->sortByDesc('Date')->last();
            $novo = json_decode($gg->isread,true);

            foreach ($novo as $key => $one){
                if($key == $my_id) {
                    $novo[$key] = 1;

                }
            }

            $json_product =  json_encode($novo);
            $isread_updated = groupChat::find($gg->id);
            $isread_updated->isread = $json_product;
            $isread_updated->update();


            // Get all message from selected user
            $messages = groupChat::all()->where('idGroup','=',$user_id);


            $isread = Chat::all()->where('receiver','=',$my_id)->where('isread','=',0);

            if(count($isread) > 0){
                $notification_chat = count($isread);
            }else{
                $notification_chat = 0;
            }


            return view('messages.groupChat', ['messages' => $messages, "notification_chat" => $notification_chat]);

        }else{

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


            $isread = Chat::all()->where('receiver','=',$my_id)->where('isread','=',0);

            if(count($isread) > 0){
                $notification_chat = count($isread);
            }else{
                $notification_chat = 0;
            }


            return view('messages.conv', ['messages' => $messages, "notification_chat" => $notification_chat]);
        }


    }



    public function authorizeUser(Request $request){
        if(!Auth::check()){
            return new Response('Forbidden', 403);
        }

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
        $entity = $request->entity;

        if($entity == 'person'){
            $from = Auth::id();
            $to = $request->receiver_id;
            $user_notification =  DB::table('users')
                ->where('id', '=', $from)
                ->value('name');

            $message = $request->message;
            $current_date_time = Carbon::now()->toDateTimeString();


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

            $data = ['from' => $from, 'to' => $to, 'entity' => $entity, 'username' => $user_notification, 'message' => $message]; // sending from and to user id when pressed enter

            $pusher->trigger('private-my-channel', 'my-event', $data);


            $data = new Chat();
            $data->sender = $from;
            $data->receiver = $to;
            $data->message = $message;
            $data->Date = $current_date_time;
            $data->isread = 0;
            $data->save();

        }else{
            $from = Auth::id();
            $group_id = $request->receiver_id;
            $user_notification =  DB::table('users')
                ->where('id', '=', $from)
                ->value('name');

            $message = $request->message;
            $current_date_time = Carbon::now()->toDateTimeString();

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

            $data = ['from' => $from, 'entity' => $entity, 'group_id' => $group_id, 'username' => $user_notification, 'message' => $message]; // sending from and to user id when pressed enter

            $pusher->trigger('private-my-channel', 'my-event', $data);
            $members = StudentsGroup::all()->where('idGroup','=',$group_id)->pluck('idStudent');

            foreach ($members as $one)
            {
                $array_product [$one]= 0;
           }

            $json_product =  json_encode($array_product);
            $data = new groupChat();
            $data->sender = $from;
            $data->idGroup = $group_id;
            $data->message = $message;
            $data->Date = $current_date_time;
            $data->isread = $json_product;
            $data->save();
        }


    }
}
