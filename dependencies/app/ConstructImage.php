<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructImage extends Model
{
    protected $table = "construct_images";
    protected $fillable = [
        'folder_id','name'
    ];

    public function folder(){
        return $this->belongsTo('App\ConstructFolderMedia', 'folder_id');
    }
}
