<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralTranslation extends Model
{
    protected $table = "general_translations";
    protected $fillable = [
        'general_id','local','title','description','keyword'
    ];
}
