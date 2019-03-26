<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function members()
    {
        return $this->hasOne('App\MemBers','id');
    }
}
