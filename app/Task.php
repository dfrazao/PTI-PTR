<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'idGroup';
    protected $table = 'tasks';
    public $timestamps = false;
}
