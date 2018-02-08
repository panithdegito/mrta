<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultStatus extends Model
{
    protected $table = "default_statuses";
    protected $fillable = [
        'name'
    ];
}
