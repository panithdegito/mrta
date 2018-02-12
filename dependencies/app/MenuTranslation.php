<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    protected $table = "menu_translations";
    protected $fillable = [
        'menu_id','local','name'
    ];
}
