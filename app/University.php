<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $primaryKey = 'idUniversity';
    protected $table = "universities";
    public $timestamps = false;

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

}
