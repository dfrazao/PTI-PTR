<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectEnrollment extends Model
{
    public $timestamps = false;
    protected $table = 'subjectEnrollments';
    protected $primaryKey = 'idUser';

    public function User()
    {
        return $this->belongsTo('App\User','idUser');
    }

    public function Subject()
    {
        return $this->belongsTo('App\Subject','idSubject');
    }

}
