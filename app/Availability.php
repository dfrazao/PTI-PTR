<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = 'availabilities';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
