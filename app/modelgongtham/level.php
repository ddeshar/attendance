<?php

namespace App\modelgongtham;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    protected $table = 'level';
  public function stitexam() {
          return $this->hasMany('App\modelgongtham\stitexam','id');
  }
}
