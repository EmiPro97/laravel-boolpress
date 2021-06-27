<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Relations with posts
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
