<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menus";
    protected $fillable = [
        'link','ordering','subordering','childof'
    ];
    public function translate($local){
        return $this->hasMany('App\MenuTranslation','menu_id')->where('local',$local)->first();
    }

    public function translateDefault(){
        $language = Language::where('default',1)->first();
        return $this->hasMany('App\MenuTranslation','menu_id')->where('local',$language->abbreviation)->first();
    }

    public function translationSave(){
        return $this->hasMany('App\MenuTranslation','menu_id');
    }
}
