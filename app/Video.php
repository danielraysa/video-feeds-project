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

    public function video_likes()
    {
        return $this->hasMany('App\Like');
    }

    public function video_comments()
    {
        return $this->hasMany('App\Comment');
    }
}
