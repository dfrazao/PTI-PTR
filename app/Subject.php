<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subjects";
    public $timestamps = false;
    protected $primaryKey = 'idSubject';

    public function generalSubject()
    {
        return $this->belongsTo('App\GeneralSubjects','idGeneralSubject');
    }
    public function subjectEnrollment()
    {
        return $this->hasMany('App\SubjectEnrollment');
    }
}
