<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class steps extends Model
{
    //
    protected $table = 'steps';
    protected $guarded = [];
    protected $revisions;
    protected $schedule;
}
