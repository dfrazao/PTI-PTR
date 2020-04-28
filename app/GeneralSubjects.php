<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSubjects extends Model
{
    protected $primaryKey = 'idGeneralSubject';
    protected $table = "generalSubjects";

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

}
