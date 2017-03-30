<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelodgeDate extends Model
{
    //protected $primarykey='id';

    public function hotels () {
      return $this->hasMany(TravelodgeHotel::class, 'hotel_id', 'hotelid');
    }
}
