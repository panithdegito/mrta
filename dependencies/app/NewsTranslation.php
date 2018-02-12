<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $table = "news_translations";
    protected $fillable = [
        'news_id','local','title','content'
    ];
}
