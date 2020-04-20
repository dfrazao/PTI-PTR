<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'idCourse';
    protected $table = "courses";
    public $timestamps = false;
}
