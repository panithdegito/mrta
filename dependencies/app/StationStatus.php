<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationStatus extends Model
{
    protected $table = "station_statuses";
    protected $fillable = [
        'name'
    ];
}
