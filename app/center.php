<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class center extends Model
{
    protected $guarded = [];
    //

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_center');
    }
}
