<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    //
    public function members()
    {
        return $this->hasOne('App\MemBers','id');
    }
}
