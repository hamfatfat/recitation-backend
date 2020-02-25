<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    //
    protected $table = 'schedule';
    protected $guarded = [];
    public function recitationstep()
    {
        return $this->hasMany('App\recitationstep'); // Meaning - One Task can have multiple interactions
    }
}
