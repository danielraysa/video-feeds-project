<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $guarded = [];

    public function video_owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
