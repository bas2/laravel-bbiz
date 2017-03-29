<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelodgeHotel extends Model
{
    //protected $primaryKey='id';

    public function date() {
      return $this->belongsTo(TravelodgeDate::class);
    }
}
