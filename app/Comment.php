<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = [];

    public function comment_owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
