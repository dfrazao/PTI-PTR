<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectEnrollment extends Model
{
    public $timestamps = false;
    protected $table = 'subjectEnrollments';
    protected $primaryKey = 'idUser';
}
