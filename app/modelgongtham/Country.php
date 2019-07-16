<?php

namespace App\modelgongtham;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  protected $table = 'country';
    public function explace() {
            return $this->hasMany('App\modelgongtham\explace','id');
    }
}
