<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Construct extends Model
{
    protected $table = "constructs";
    protected $fillable = [
        'status_id', 'publish_date','folder_id'
    ];

    public function translate($local){
        return $this->hasMany('App\ConstructTranslation','construct_id')->where('local',$local)->first();
    }

    public function translateDefault(){
        $language = Language::where('default',1)->first();
        return $this->hasMany('App\ConstructTranslation','construct_id')->where('local',$language->abbreviation)->first();
    }

    public function translationSave(){
        return $this->hasMany('App\ConstructTranslation','construct_id');
    }

    public function status(){
        return $this->belongsTo('App\DefaultStatus', 'status_id');
    }
}
