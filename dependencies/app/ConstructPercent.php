<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructPercent extends Model
{
    protected $table = "construct_percents";
    protected $fillable = [
        'percent'
    ];
}
