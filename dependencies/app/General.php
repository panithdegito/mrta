<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Language;

class General extends Model
{
    protected $table = "generals";
    protected $fillable = [

    ];

    public function translate($local){
        return $this->hasMany('App\GeneralTranslation','general_id')->where('local',$local)->first();
    }

    public function translateDefault(){
        $language = Language::where('default',1)->first();
        return $this->hasMany('App\GeneralTranslation','general_id')->where('local',$language->abbreviation)->first();
    }

    public function translationSave(){
        return $this->hasMany('App\GeneralTranslation','general_id');
    }
}
