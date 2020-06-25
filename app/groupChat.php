<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groupChat extends Model
{
    protected $primaryKey = 'idGroup';
    protected $table = "groupChats";
    public $timestamps = false;


}
