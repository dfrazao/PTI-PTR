<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chats";
    protected $fillable = ['sender', 'receiver', 'message', 'Date'];
    public $timestamps = false;
}
