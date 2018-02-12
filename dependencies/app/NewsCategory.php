<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = "news_categories";
    protected $fillable = [
    ];

    public function translate($local){
        return $this->hasMany('App\NewsCategoryTranslation','news_category_id')->where('local',$local)->first();
    }

    public function translateDefault(){
        $language = Language::where('default',1)->first();
        return $this->hasMany('App\NewsCategoryTranslation','news_category_id')->where('local',$language->abbreviation)->first();
    }

    public function translationSave(){
        return $this->hasMany('App\NewsCategoryTranslation','news_category_id');
    }
}
