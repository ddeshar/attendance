<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wat extends Model
{
    //
    protected $table = 'wat';
    public function members()
    {
        return $this->hasOne('App\MemBers','id');
    }


}
