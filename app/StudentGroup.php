<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    protected $primaryKey = 'idStudent';
    protected $table = "studentGroups";
}
