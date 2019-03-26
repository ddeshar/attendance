<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model{
    protected $fillable = ['members_id', 'date','time'];
    protected $primaryKey = 'id'; // id set primaryKey
    protected $table = 'attendance';
    public $timestamps = false;

    public function members()
    {
        return $this->belongsTo('App\Members','id');
    }
}
