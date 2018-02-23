<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationTranslation extends Model
{
    protected $table = "station_translations";
    protected $fillable = [
      'station_id', 'local', 'name'
    ];
}
