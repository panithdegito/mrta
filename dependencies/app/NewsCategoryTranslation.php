<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryTranslation extends Model
{
    protected $table = "news_category_translations";
    protected $fillable = [
        'news_category_id', 'local', 'name'
    ];
}
