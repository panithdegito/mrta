<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Language;

class Station extends Model
{
    protected $table = "stations";
    protected $fillable = [
        'code', 'kilometer_marker', 'status_id'

    ];

    public function translate($local){
        return $this->hasMany('App\StationTranslation','station_id')->where('local',$local)->first();
    }

    public function translateDefault(){
        $language = Language::where('default',1)->first();
        return $this->hasMany('App\StationTranslation','station_id')->where('local',$language->abbreviation)->first();
    }

    public function translationSave(){
        return $this->hasMany('App\StationTranslation','station_id');
    }

    public function status(){
        return $this->belongsTo('App\StationStatus','status_id');
    }
}
