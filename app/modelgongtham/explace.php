<?php

namespace App\modelgongtham;

use Illuminate\Database\Eloquent\Model;

class explace extends Model
{
    protected $table = 'explace';
  public function countrys() {
          return $this->belongsTo('App\modelgongtham\Country','id_country');
  }

  public function stitexamss() {
          return $this->hasMany('App\modelgongtham\stitexam','id_explace');
  }

  public function stitexam() {
          return $this->hasMany('App\modelgongtham\stitexam','id');
  }
}
