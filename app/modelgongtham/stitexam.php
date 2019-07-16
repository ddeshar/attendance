<?php

namespace App\modelgongtham;

use Illuminate\Database\Eloquent\Model;

class stitexam extends Model
{
  protected $table = 'stitexam';
  public function explacess() {
          return $this->belongsTo('App\modelgongtham\explace','id');
  }
  public function explace() {
          return $this->belongsTo('App\modelgongtham\explace','id_explace');
  }
  public function level() {
          return $this->belongsTo('App\modelgongtham\level','id_level');
  }
}
