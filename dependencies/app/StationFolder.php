<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationFolder extends Model
{
    protected $table = "station_folders";
    protected $fillable = [
      'name', 'station_id'
    ];

    public function station(){
        return $this->belongsTo('App\Station','station_id');
    }
}
