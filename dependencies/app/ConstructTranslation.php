<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructTranslation extends Model
{
    protected $table = "construct_translations";
    protected $fillable = [
        'construct_id','local','title','content'
    ];
}
