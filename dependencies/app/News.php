<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";
    protected $fillable = [
        'status_id','news_category_id'
    ];

    public function translate($local){
        return $this->hasMany('App\NewsTranslation','news_id')->where('local',$local)->first();
    }

    public function translateDefault(){
        $language = Language::where('default',1)->first();
        return $this->hasMany('App\NewsTranslation','news_id')->where('local',$language->abbreviation)->first();
    }

    public function translationSave(){
        return $this->hasMany('App\NewsTranslation','news_id');
    }

    public function category(){
        return $this->hasOne('App\NewsCategory','news_category_id');
    }
}
