<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    //
    public function Attendance()
    {
        return $this->hasMany('App\Attendance','members_id');
    }
    public function wat()
    {
        return $this->belongsTo('App\Wat','wat_id');
    }
    public function position()
    {
        return $this->belongsTo('App\Positions','position_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Department','department_id');
    }
}
