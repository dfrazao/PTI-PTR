<?php

namespace App\Http\Controllers;
use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
class ChatController extends Controller
{

    public function index()
    {
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        $users = DB::select("select users.id, users.name, users.photo, users.email
        from users LEFT  JOIN  chats ON users.id = chats.sender and chats.receiver = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.photo, users.email");

        return view('chat', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
//        Chat::where(['sender' => $user_id, 'receiver' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user


        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('sender', $user_id)->where('receiver', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('sender', $my_id)->where('receiver', $user_id);
        })->get();

        return view('messages.conv', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {

        $from = Auth::id();
        $to = $request->receiver_id;


        $message = $request->message;
        $data = new Chat();
        $data->sender = $from;
        $data->receiver = $to;
        $data->message = $message;
        $data->save();


    }
}
