<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnouncementComment extends Model
{
    protected $table = 'announcementComments';
    protected $primaryKey = 'idAnnouncementComment';
    public $timestamps = false;
}
