<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationFolderImage extends Model
{
    protected $table = "station_folder_images";
    protected $fillable = [
        'folder_id', 'location', 'description'
    ];

    public function folder(){
        return $this->belongsTo('App\StationFolder','folder_id');
    }
}
