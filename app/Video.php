<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Video extends Model
{
    //
    protected $guarded = [];

    public function video_url()
    {
        if(file_exists(asset('storage/'.$this->path))){
            return asset('storage/'.$this->path);
        }
        else{
            return Storage::disk('s3')->url($this->path);
        }
    }

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
